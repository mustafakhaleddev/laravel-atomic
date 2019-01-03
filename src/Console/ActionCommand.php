<?php

namespace MustafaKhaled\AtomicPanel\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class ActionCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atomic:action {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new atomic action';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->hasValidNameArgument()) {
            return;
        }

        (new Filesystem)->copyDirectory(
            __DIR__ . '../../stubs/action-stubs',
            $this->fieldPath()
        );


        // Field.php replacements...
        $this->replace('{{ class }}', $this->fieldClass(), $this->fieldPath().'/action.stub');

        (new Filesystem)->move(
            $this->fieldPath().'/action.stub',
            $this->fieldPath().'/'.$this->fieldClass().'.php'
        );

        $this->info('Atomic Action Created Successfully in App/Atomic/Actions.');

    }


    /**
     * Replace the given string in the given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replace($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }


    /**
     * Determine if the name argument is valid.
     *
     * @return bool
     */
    public function hasValidNameArgument()
    {
        $name = $this->argument('name');

        if (Str::contains($name, ' ')) {
            $this->error("The name argument has spaces : `ActionName`.");

            return false;
        }

        return true;
    }


    /**
     * Get the path to the tool.
     *
     * @return string
     */
    protected function fieldPath()
    {
        return app_path('Atomic/Actions');
    }


    /**
     * Get the field's class name.
     *
     * @return string
     */
    protected function fieldClass()
    {
        return Str::studly($this->fieldName());
    }


    /**
     * Get the field's base name.
     *
     * @return string
     */
    protected function fieldName()
    {
        return $this->argument('name');
    }
}
