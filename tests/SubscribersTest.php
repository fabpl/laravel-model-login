<?php

namespace Tests;

use Fabpl\ModelLogin\Models\Login;
use Illuminate\Auth\Events\Failed as FailedEvent;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class SubscribersTest extends TestCase
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $builder = $this->app['db']->connection()->getSchemaBuilder();

        $builder->create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

        $this->model = TestModel::create(['email' => 'test@test.com', 'password' => bcrypt('secret')]);
    }

    /**
     *
     */
    public function testSuccessfulTest(): void
    {
        event(new LoginEvent('web', $this->model, false));

        $this->assertEquals(1, Login::count());
        $this->assertEquals(1, Login::whereStatus(Login::STATUS_SUCCESSFUL)->count());
        $this->assertEquals(1, $this->model->logins()->count());
        $this->assertEquals(1, $this->model->successful_logins()->count());
        $this->assertEquals(0, $this->model->failed_logins()->count());
    }

    /**
     *
     */
    public function testFailedTest(): void
    {
        event(new FailedEvent('web', $this->model, ['email' => 'test@test.com', 'password' => 'test']));

        $this->assertEquals(1, Login::count());
        $this->assertEquals(1, Login::whereStatus(Login::STATUS_FAILED)->count());
    }
}
