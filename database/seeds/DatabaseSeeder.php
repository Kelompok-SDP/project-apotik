<?php

use App\Models\Artikel;
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
        // php artisan db:seed --database="mysql"
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            TagSeeder::class,
            ArtikelSeeder::class
        ]);
    }
}
