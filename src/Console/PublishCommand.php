<?php

namespace Fabpl\ModelLogin\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model-login:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Model Login resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Configuration...
        $this->callSilent('vendor:publish', ['--tag' => 'model-login-config']);

        // Migrations
        $this->callSilent('vendor:publish', ['--tag' => 'model-login-migrations']);

        $this->info('Model Login resources published.');
    }
}
