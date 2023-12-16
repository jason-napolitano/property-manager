<?php

namespace Database\Seeders {
    use Spatie\Permission\Models\Permission;
    use Illuminate\Database\Seeder;

    class PermissionSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // --------------------------------------------
            // categories
            Permission::create(['name' => 'manage_categories']);
            Permission::create(['name' => 'restore_category']);
            Permission::create(['name' => 'manage_category']);
            Permission::create(['name' => 'create_category']);
            Permission::create(['name' => 'update_category']);
            Permission::create(['name' => 'delete_category']);

            // --------------------------------------------
            // properties
            Permission::create(['name' => 'manage_properties']);
            Permission::create(['name' => 'restore_property']);
            Permission::create(['name' => 'manage_property']);
            Permission::create(['name' => 'create_property']);
            Permission::create(['name' => 'update_property']);
            Permission::create(['name' => 'delete_property']);


            // --------------------------------------------
            // projects
            Permission::create(['name' => 'manage_projects']);
            Permission::create(['name' => 'restore_project']);
            Permission::create(['name' => 'manage_project']);
            Permission::create(['name' => 'create_project']);
            Permission::create(['name' => 'update_project']);
            Permission::create(['name' => 'delete_project']);


            // --------------------------------------------
            // tasks
            Permission::create(['name' => 'manage_tasks']);
            Permission::create(['name' => 'restore_task']);
            Permission::create(['name' => 'manage_task']);
            Permission::create(['name' => 'create_task']);
            Permission::create(['name' => 'update_task']);
            Permission::create(['name' => 'delete_task']);

            // --------------------------------------------
            // users
            Permission::create(['name' => 'manage_users']);
            Permission::create(['name' => 'restore_user']);
            Permission::create(['name' => 'manage_user']);
            Permission::create(['name' => 'create_user']);
            Permission::create(['name' => 'update_user']);
            Permission::create(['name' => 'delete_user']);

            // --------------------------------------------
            // roles
            Permission::create(['name' => 'manage_roles']);
            Permission::create(['name' => 'restore_role']);
            Permission::create(['name' => 'manage_role']);
            Permission::create(['name' => 'create_role']);
            Permission::create(['name' => 'update_role']);
            Permission::create(['name' => 'delete_role']);

            // --------------------------------------------
            // permissions
            Permission::create(['name' => 'manage_permissions']);
            Permission::create(['name' => 'restore_permission']);
            Permission::create(['name' => 'manage_permission']);
            Permission::create(['name' => 'create_permission']);
            Permission::create(['name' => 'update_permission']);
            Permission::create(['name' => 'delete_permission']);

            // --------------------------------------------
            // profile
            Permission::create(['name' => 'manage_profile']);
            Permission::create(['name' => 'update_profile']);
            Permission::create(['name' => 'delete_profile']);

            // --------------------------------------------
            // ui
            Permission::create(['name' => 'toggle_dark_mode']);

            // --------------------------------------------
            // telescope
            Permission::create(['name' => 'view_telescope']);

            // --------------------------------------------
            // dev
            Permission::create(['name' => 'dev_access']);

            // admin wildcard
            Permission::create(['name' => '*']);
        }
    }
}
