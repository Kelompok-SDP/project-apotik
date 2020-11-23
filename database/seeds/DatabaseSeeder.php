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
        // kalo ada error dulu composer dumpautoload
        // php artisan db:seed --database="mysql"
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            ObatSeeder::class,
            ObatKategoriSeeder::class,
            AlatSeeder::class,
            AlatKategoriSeeder::class,
            ThJualSeeder::class,
            TagSeeder::class,
            ArtikelSeeder::class
        ]);
    }
}
