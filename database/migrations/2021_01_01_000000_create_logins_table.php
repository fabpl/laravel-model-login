<?php

use Fabpl\ModelLogin\Models\Login;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    public function up(): void
    {
        Schema::create(config('model-login.table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('guard');
            $table->nullableMorphs('model');
            $table->enum('status', [Login::STATUS_FAILED, Login::STATUS_SUCCESSFUL]);
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('model-login.table_name'));
    }
}
