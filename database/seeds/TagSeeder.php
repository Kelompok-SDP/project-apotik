<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class,10)->make()->each(function($user){
            $fakeUser = Tag::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')->first();
            $newIndex = 'T'.$fakeUser->newIndex;
            $user->id = $newIndex;
            $user->save();
        });
    }
}
