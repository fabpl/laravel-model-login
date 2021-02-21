<?php

namespace Fabpl\ModelLogin\Models;

use Fabpl\ModelLogin\Contracts\LoginInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Login extends Model implements LoginInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'guard',
        'model_type',
        'model_id',
        'status',
        'ip',
        'user_agent',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('model-login.table_name');
    }

    /**
     * Define model relations.
     *
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo(
            'model',
            'model_type',
            'model_id',
            'id'
        );
    }
}
