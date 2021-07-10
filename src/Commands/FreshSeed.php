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
    protected $signature = 'eduka:fresh-seed {--with-test-data : Seed testing data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the Eduka database and optionally populates testing data';

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
        $this->paragraph('=> Installing Eduka schema...');

        $this->call('migrate:fresh', [
            '--force' => 1,
            '--quiet' => 1,
        ]);

        $this->paragraph('=> Seeding database with initial required data ...');
        $this->call('db:seed', [
            '--class' => 'Eduka\Database\Seeders\SchemaInitializeSeeder',
            '--quiet' => 1,
        ]);

        if ($this->option('with-test-data') && app()->environment() != 'production') {
            $this->paragraph('=> Seeding database with testing data ...');
            $this->call('db:seed', [
                '--class' => 'Eduka\Database\Seeders\SchemaTestSeeder',
                '--quiet' => 1,
            ]);
        }

        return 0;
    }
}
