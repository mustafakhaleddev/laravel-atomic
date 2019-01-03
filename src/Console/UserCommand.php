<?php

namespace MustafaKhaled\AtomicPanel\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Hash;


class UserCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atomic:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $this->info('Creating Atomic User.');
        $name = $this->ask('Name');
        $email = $this->ask('Email Address');
        $password = $this->secret('Password');
        $guard = config('AtomicPanel.guard') ?: config('auth.defaults.guard');
        $provider = config("auth.guards.{$guard}.provider");
        $model = config("auth.providers.{$provider}.model");

        (new $model)->forceFill([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ])->save();

        $this->info('User created successfully.');

    }

}
