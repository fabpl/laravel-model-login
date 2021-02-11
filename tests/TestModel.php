<?php

namespace Tests;

use Fabpl\ModelLogin\Traits\HasLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TestModel extends Authenticatable
{
    use HasLogins;

    /**
     * @var string
     */
    protected $table = 'tests';

    /**
     * @var array
     */
    protected $guarded = [];
}
