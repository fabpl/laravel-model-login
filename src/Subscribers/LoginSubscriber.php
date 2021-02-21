<?php

namespace Fabpl\ModelLogin\Subscribers;

use Fabpl\ModelLogin\Contracts\LoginInterface;
use Illuminate\Auth\Events\Failed as FailedEvent;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Http\Request;

class LoginSubscriber
{
    /**
     * @var LoginInterface
     */
    protected $login;

    /**
     * @var Request
     */
    protected $request;

    /**
     * LoginSubscriber constructor.
     *
     * @param LoginInterface $login
     * @param Request $request
     */
    public function __construct(LoginInterface $login, Request $request)
    {
        $this->login = $login;
        $this->request = $request;
    }

    public function subscribe($events): void
    {
        $events->listen(LoginEvent::class, [$this, 'onLogin']);
        $events->listen(FailedEvent::class, [$this, 'onFailed']);
    }

    /**
     * @param LoginEvent $event
     */
    public function onLogin(LoginEvent $event): void
    {
        $this->login->create([
            'guard' => $event->guard,
            'model_type' => get_class($event->user),
            'model_id' => $event->user->id,
            'status' => LoginInterface::STATUS_SUCCESSFUL,
            'ip' => $this->request->ip(),
            'user_agent' => $this->request->userAgent()
        ]);
    }

    /**
     * @param FailedEvent $event
     */
    public function onFailed(FailedEvent $event): void
    {
        $attributes = [
            'guard' => $event->guard,
            'status' => LoginInterface::STATUS_FAILED,
            'ip' => $this->request->ip(),
            'user_agent' => $this->request->userAgent()
        ];

        if ($event->user) {
            $attributes['model_type'] = get_class($event->user);
            $attributes['model_id'] = $event->user->id;
        }

        $this->login->create($attributes);
    }
}
