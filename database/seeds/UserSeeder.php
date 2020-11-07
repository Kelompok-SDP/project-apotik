<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->make()->each(function($user){
            $fakeUser = User::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')->first();
            $newIndex = 'USER'.$fakeUser->newIndex;
            $user->id = $newIndex;
            $user->save();
        });



    }
}
