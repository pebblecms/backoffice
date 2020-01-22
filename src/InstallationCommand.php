<?php

namespace Pebble\Backoffice;

use Illuminate\Console\Command;
use InvalidArgumentException;

class InstallationCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'pebble:backoffice
                    { type : The preset type (blade, vue) }
                    { --option=* : Pass an option to the preset command }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish backoffice front';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        if (! in_array($this->argument('type'), ['blade', 'vue'])) {
            throw new InvalidArgumentException('Invalid preset.');
        }

        $this->{$this->argument('type')}();
    }

    /**
     * Install the "blade" preset.
     *
     * @return void
     */
    protected function blade()
    {
        Presets\Blade::install();

        $this->info('Blade presets installed successfully.');
        $this->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
    }
}
