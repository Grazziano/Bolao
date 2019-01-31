<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

/**
 *
 */
class UserRepository implements UserRepositoryInterface
{

public function all()
{
$modelo = app(User::class);
return $modelo->all();
}
}
