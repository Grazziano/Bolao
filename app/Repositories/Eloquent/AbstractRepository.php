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

  public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection{
    $query = $this->model;
    foreach ($columns as $key => $value) {
      $query = $query->orWhere($value, 'like', '%'.$search.'%');
    }
    //dd($query->get());
    return $query->orderBy($column, $order)->get();
  }

  protected function resolveModel(){
    return app($this->model);
  }
}
