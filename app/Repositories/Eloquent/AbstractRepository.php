<?php
namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository
{

  protected $model;

  function __construct()
  {
    $this->model = $this->resolveModel();
  }

  public function all():Collection
  {
    return $this->model->all();
  }

  public function paginate(int $paginate = 10):LengthAwarePaginator
  {
    return $this->model->paginate($paginate);
  }

  protected function resolveModel(){
    return app($this->model);
  }
}
