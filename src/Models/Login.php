<?php

namespace Fabpl\ModelLogin\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /** @var string  */
    const STATUS_SUCCESSFULL = 'successful';

    /** @var string  */
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'identifier',
        'status',
        'ip',
        'user-agent',
    ];
}
