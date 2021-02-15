<?php

namespace Fabpl\ModelLogin\Subscribers;

use Fabpl\ModelLogin\Models\Login;
use Illuminate\Auth\Events\Failed as FailedEvent;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Http\Request;

class LoginSubscriber
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * LoginSubscriber constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function subscribe($events): void
    {
        $events->listen(LoginEvent::class, [$this, 'onUserLogin']);
        $events->listen(FailedEvent::class, [$this, 'onUserLoginFailed']);
    }

    /**
     * @param LoginEvent $event
     */
    public function onUserLogin(LoginEvent $event): void
    {
        if (method_exists($event->user, 'logins')) {
            Login::create([
                'user_id' => $event->user->id,
                'guard' => $event->guard,
                'status' => Login::STATUS_SUCCESSFUL,
                'ip' => $this->request->ip(),
                'user-agent' => $this->request->userAgent()
            ]);
        }
    }

    /**
     * @param FailedEvent $event
     */
    public function onUserLoginFailed(FailedEvent $event): void
    {
        if ($event->user and method_exists($event->user, 'logins')) {
            Login::create([
                'user_id' => $event->user->id,
                'guard' => $event->guard,
                'status' => Login::STATUS_FAILED,
                'ip' => $this->request->ip(),
                'user-agent' => $this->request->userAgent()
            ]);
        }
    }
}
