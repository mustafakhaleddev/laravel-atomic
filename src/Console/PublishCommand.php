<?php

namespace MustafaKhaled\AtomicPanel\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class PublishCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atomic:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishing all of the Atomic resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Atomic Vendor...');
        $this->callSilent('vendor:publish', ['--tag' => 'atomic-public', '--force' => $this->option('force'),]);
        $this->callSilent('vendor:publish', ['--tag' => 'atomic-resources', '--force' => true,]);
        $this->callSilent('vendor:publish', ['--tag' => 'atomic-config', '--force' => $this->option('force'),]);

        $this->info('Atomic Panel Published successfully.');
    }

}