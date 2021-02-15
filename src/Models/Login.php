<?php

namespace Fabpl\ModelLogin\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /** @var string */
    const STATUS_SUCCESSFUL = 'successful';

    /** @var string */
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'guard',
        'status',
        'ip',
        'user-agent',
    ];
}
