<?php

use Illuminate\Database\Seeder;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Roles
      $adminACL = \App\Role::firstOrCreate(['name'=>'Admin'], [
        'description'=>'Função de Administrador',
      ]);

      $gerenteACL = \App\Role::firstOrCreate(['name'=>'Gerente'], [
        'description'=>'Função de Gerente',
      ]);

      $usuarioACL = \App\Role::firstOrCreate(['name'=>'Usuário'], [
        'description'=>'Função de Usuário',
      ]);

      // User com Role
      $userAdmin = \App\User::find(1);
      $userGerente = \App\User::find(2);

      // Faz o relacionamento de usuário com funções
      $userAdmin->roles()->attach($adminACL);
      $userGerente->roles()->attach($gerenteACL);

      // Cria as permissões
      $listUser = \App\Permission::firstOrCreate(['name'=>'list-user'], [
        'description'=>'Listar registros',
      ]);

      $createUser = \App\Permission::firstOrCreate(['name'=>'create-user'], [
        'description'=>'Criar registros',
      ]);

      // Relacionamento de funções com permissões
        $gerenteACL->permissions()->attach($listUser);
        $gerenteACL->permissions()->attach($createUser);

        echo "Registros de ACL criados!\n";
    }
}
