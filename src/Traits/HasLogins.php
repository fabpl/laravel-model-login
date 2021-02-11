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
            config('model-login.model', Login::class),
            'user_id',
            'id'
        );
    }

    /**
     * Failed logins relation.
     *
     * @return HasMany
     */
    public function failed_logins(): HasMany
    {
        return $this->hasMany(
            config('model-login.model', Login::class),
            'user_id',
            'id'
        )->whereStatus(Login::STATUS_FAILED);
    }

    /**
     * Successfull logins relation.
     *
     * @return HasMany
     */
    public function successfull_logins(): HasMany
    {
        return $this->hasMany(
            config('model-login.model', Login::class),
            'user_id',
            'id'
        )->whereStatus(Login::STATUS_SUCCESSFULL);
    }
}
