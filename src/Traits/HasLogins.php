<?php

namespace Fabpl\ModelLogin\Traits;

use Fabpl\ModelLogin\Contracts\LoginInterface;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLogins
{
    /**
     * Logins relation.
     *
     * @return MorphMany
     */
    public function logins(): MorphMany
    {
        return $this->morphMany(
            config('model-login.model'),
            'model',
            'model_type',
            'model_id',
            'id'
        );
    }

    /**
     * Successful Logins relation.
     *
     * @return MorphMany
     */
    public function successful_logins(): MorphMany
    {
        return $this->logins()->whereStatus(LoginInterface::STATUS_SUCCESSFUL);
    }

    /**
     * Failed Logins relation.
     *
     * @return MorphMany
     */
    public function failed_logins(): MorphMany
    {
        return $this->logins()->whereStatus(LoginInterface::STATUS_FAILED);
    }
}
