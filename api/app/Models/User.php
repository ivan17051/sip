<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'muser';

    public $timestamps = false;

    public function username()
    {
        return 'username';
    }

    public function getRememberTokenName()
    {
        return 'token';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nama', 'password', 'api_token', 'doc', 'dom', 'isactive', 'token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token', 'token'
    ];

    function generateRandomString($length = 10, $abc = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")
    {
        return substr(str_shuffle($abc), 0, $length);
    }


    public function generateToken()
    {
        $this->api_token = $this->generateRandomString(60);
        $this->save();

        return $this->api_token;
    }

    public function deleteToken()
    {
        $this->api_token = null;
        $this->save();

        return $this->api_token;
    }
}
