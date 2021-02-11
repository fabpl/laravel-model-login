<?php

namespace Fabpl\ModelLogin\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model-login:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Model Login resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'model-login-migrations']);

        $this->info('Model Login resources installed.');
    }
}
