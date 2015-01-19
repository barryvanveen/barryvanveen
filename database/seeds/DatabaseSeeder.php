<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables that need to be truncated
     * @var array
     */
    protected $tables = [
        'blogs'
    ];


    /**
     * Seeders that need to be called
     * @var array
     */
    protected $seeders = [
        'BlogsTableSeeder'
    ];


    /**
     * Run the database seeds.
     *
     * @return void
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
     * Truncate all necessary database tables
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
