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
}
