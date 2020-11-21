<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CheckPassUpdate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $valid= false;
        $userLogin = null;
        $iduser = "";
        $passuser = "";
        if(Cookie::has('isLogin')){
            $userLogin = json_decode(Cookie::get('isLogin'));
            $iduser = $userLogin->id;
            $passuser = $userLogin->password;
        }
        $allUser = User::all();
        foreach($allUser as $item){
            if($item->id == $iduser ){
               if(Hash::check($value, $passuser)){
                   $valid =true;
               }
            }

        }
        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password tidak sama';
    }
}
