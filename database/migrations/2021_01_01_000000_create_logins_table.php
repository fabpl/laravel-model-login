<?php

use Fabpl\ModelLogin\Models\Login;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    /**
     *
     */
    public function up(): void
    {
        Schema::create(config('model-login.table_name', 'logins'), function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->nullable();
            $table->string('identifier')->nullable();
            $table->enum('status', [Login::STATUS_FAILED, Login::STATUS_SUCCESSFULL]);
            $table->string('ip')->nullable();
            $table->string('user-agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     *
     */
    public function down(): void
    {
        Schema::dropIfExists(config('model-login.table_name', 'logins'));
    }
}
