<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'users';

    public $timestamps = false;
}