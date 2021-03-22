<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('categories');
        Storage::makeDirectory('categories');
        $this->call(CategorySeeder::class);

        $this->call(UserSeeder::class);

        Storage::deleteDirectory('courses');
        Storage::makeDirectory('courses');
        $this->call(CourseSeeder::class);

        Storage::deleteDirectory('units');
        Storage::makeDirectory('units');
    }
}
