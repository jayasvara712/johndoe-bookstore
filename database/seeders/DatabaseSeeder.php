<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(AuthorsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(RatingsSeeder::class);
    }
}
