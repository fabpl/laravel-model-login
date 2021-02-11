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
        Login::create([
            'user_id' => $event->user->id,
            'identifier' => $event->credentials['email'] ?? null,
            'status' => Login::STATUS_SUCCESSFULL,
            'ip' => $this->request->ip(),
            'user-agent' => $this->request->userAgent()
        ]);
    }

    /**
     * @param FailedEvent $event
     */
    public function onUserLoginFailed(FailedEvent $event): void
    {
        Login::create([
            'identifier' => $event->credentials['email'] ?? null,
            'status' => Login::STATUS_FAILED,
            'ip' => $this->request->ip(),
            'user-agent' => $this->request->userAgent()
        ]);
    }
}
