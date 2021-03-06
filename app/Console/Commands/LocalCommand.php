<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LocalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'local';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "\n";
        echo "deploying laravel... and fetching freshly baked cookies \n";
        # Turn on maintenance mode
        shell_exec('php artisan down || true');

        # Pull the latest changes from the git repository
        # git reset --hard
        # git clean -df
        echo "\n";
        echo "pulling changes from github... or somewhere else \n";
        shell_exec('git pull origin master');

        # Install/update composer dependecies
        echo "\n";
        echo "Installing and/or updating underwear drawer preferences \n";
        shell_exec('composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --quiet');

        # Run database migrations
        shell_exec('php artisan migrate');

        # Clear caches
        shell_exec('php artisan cache:clear');

        # Clear expired password reset tokens
        shell_exec('php artisan auth:clear-resets');

        # Clear and cache routes
        shell_exec('php artisan route:cache');

        # Clear and cache config
        shell_exec('php artisan config:cache');

        # Clear and cache views
        shell_exec('php artisan view:cache');

        # Install node modules
        # npm ci

        # Build assets using Laravel Mix
        shell_exec('npm run production');

        # Turn off maintenance mode
        shell_exec('php artisan up');

        echo "\n";
        echo "Done with the boring stuff, now levelling up!!! \n";
        echo "Starting webserver ... and getting coffee to dunk the cookies \n";
        echo "Have fun! \n";
        echo "..::DO NOT CLOSE THIS WINDOW, IT WIL DESTROY YOUR COMPUTER::.. \n";
        # Starting webserver
        shell_exec('php artisan serv');

        return 0;
    }
}
