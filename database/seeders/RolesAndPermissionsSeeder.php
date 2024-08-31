<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'read posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'login user']);

        $admin = Role::create(["name" => "Admin"]);
        $admin->givePermissionTo(Permission::all());

        $editor = Role::create(["name" => "Editor"]);
        $editor->givePermissionTo("update posts");

        $writer = Role::create(['name' => 'Writer']);
        $writer->givePermissionTo(['create posts', 'update posts']);

        $normal = Role::create(['name' => 'Normal']);
        $normal->givePermissionTo('read posts');
    }
}
