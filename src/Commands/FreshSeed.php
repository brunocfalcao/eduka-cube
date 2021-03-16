<?php

namespace Eduka\Cube\Commands;

use Eduka\Abstracts\EdukaCommand;

class FreshSeed extends EdukaCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eduka-cube:fresh-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes database and seeds a test data package for development purposes';

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
        $this->info('
                    _       _
             ___  _| | _ _ | |__ ___
            / ._>/ . || | || / /<_> |
            \___.\___|`___||_\_\<___|

        ');

        $this->paragraph('-= Freshing and seeding Eduka database =-', false);

        $this->paragraph('=> Freshing database ...');
        $this->call('migrate:fresh', [
            '--force' => 1,
            '--quiet' => 1,
        ]);
        $this->paragraph('=> Done', false);

        if (app()->environment() != 'production') {
            $this->paragraph('=> Seeding database with testing data ...');
            $this->call('db:seed', [
                '--class' => 'Eduka\Database\Seeders\SchemaTestSeeder',
                '--quiet' => 1,
            ]);
        }

        $this->paragraph('-= All done! Database refreshed! =-');

        return 0;
    }
}
