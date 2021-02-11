<?php

return [
    /**
     * We need to know which Eloquent model should be used to retrieve your logins. Of course, it
     * is often just the "Login" model but you may use whatever you like.
     *
     * The model you want to use as a Login model needs to extend the
     * `Fabpl\ModelLogin\Models\Login` model.
     */
    'model' => Fabpl\ModelLogin\Models\Login::class,

    /**
     * We need to know which table should be used to retrieve your logins. We have chosen a basic
     * default value but you may easily change it to any table you like.
     */
    'table_name' => 'logins',
];
