<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
  public function all():Collection;
  public function paginate(int $paginate = 10):LengthAwarePaginator;
}
