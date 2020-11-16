<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class CheckNoHpUpdate implements Rule
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
        $valid= true;
        $userLogin = null;
        $iduser = "";
        $notlp = "";
        if(Cookie::has('isLogin')){
            $userLogin = json_decode(Cookie::get('isLogin'));
            $iduser = $userLogin->id;
        }
        $allUser =User::all();
        foreach($allUser as $item){
            if($item->id != $iduser ){
                if($value== $item->noHp){
                    $valid = false;
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
        return 'No Hp sudah pernah di pakai';
    }
}
