<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables that need to be truncated.
     *
     * @var array
     */
    protected $tables = [
        'blogs',
        'pages',
        'users',
    ];

    /**
     * Seeders that need to be called.
     *
     * @var array
     */
    protected $seeders = [
        'BlogsTableSeeder',
        'PagesTableSeeder',
        'UsersTableSeeder',
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();

        foreach ($this->seeders as $seedClass) {
            $this->call($seedClass);
        }
    }

    /**
     * Truncate all necessary database tables.
     */
    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
