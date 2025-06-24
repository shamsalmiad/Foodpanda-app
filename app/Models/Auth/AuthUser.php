<?php
namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AuthUser extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'users';
    protected $connection = 'auth_db';
}
