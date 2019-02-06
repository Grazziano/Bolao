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

  public function all(string $column = 'id', string $order = 'ASC'):Collection
  {
    return $this->model->orderBy($column,$order)->get();
  }

  public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
  {
    return $this->model->orderBy($column,$order)->paginate($paginate);
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