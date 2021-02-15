<?php

namespace Fabpl\ModelLogin\Traits;

use Fabpl\ModelLogin\Models\Login;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasLogins
{
    /**
     * Logins relation.
     *
     * @return HasMany
     */
    public function logins(): HasMany
    {
        return $this->hasMany(
            config('model-login.model'),
            'user_id',
            'id'
        );
    }

    /**
     * Successful Logins relation.
     *
     * @return HasMany
     */
    public function successful_logins(): HasMany
    {
        return $this->hasMany(
            config('model-login.model'),
            'user_id',
            'id'
        )->whereStatus(Login::STATUS_SUCCESSFUL);
    }

    /**
     * Failed Logins relation.
     *
     * @return HasMany
     */
    public function failed_logins(): HasMany
    {
        return $this->hasMany(
            config('model-login.model'),
            'user_id',
            'id'
        )->whereStatus(Login::STATUS_FAILED);
    }
}
