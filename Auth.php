<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    public function user()
    {
        if(empty($_SESSION['user'])){
            return $_SESSION['user']=false;
         }
        return User::find($_SESSION['user']);
    }

    public function check()
    {
        if(empty($_SESSION['user'])){
           return $_SESSION['user']=false;
        }
        return isset($_SESSION['user']);
    }

    public function attempt($email,$password)
    {
        //kikeresni a felhaszálót emial alapján

        $user=User::where('email',$email)->first();

           // ha nem létezik, akkor false
        if(!$user)
        {
            return false;
        }
        // ha létezik, ellenőrizni a jelszavát
         // Session beállítása
        if(password_verify($password,$user->password))
        {
            $_SESSION['user']=$user->id;
            return true;
        }
        else{
            return false;
        }  
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}