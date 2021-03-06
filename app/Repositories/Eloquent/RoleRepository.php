<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

/**
 *
 */
class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{

  protected $model = Role::class;

  public function create(array $data):Bool
  {
    $register = $this->model->create($data);
    if (isset($data['permissions']) && count($data['permissions'])) {
      foreach ($data['permissions'] as $key => $value) {
        $register->permissions()->attach($value);
      }
    }
    return (bool) $register;
  }

  public function update(array $data, int $id):Bool
  {
    $register = $this->find($id);
    if ($register) {
      $permissions = $register->permissions;
      if (count($permissions)) {
        foreach ($permissions as $key => $value) {
          $register->permissions()->detach($value->id); // remove o relacionamento com o registro
        }
      }
      if (isset($data['permissions']) && count($data['permissions'])) {
        foreach ($data['permissions'] as $key => $value) {
          $register->permissions()->attach($value);     // relaciona com o registro
        }
      }
      return (bool) $register->update($data);
    }else {
      return false;
    }
  }

}
