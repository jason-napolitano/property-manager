<?php

namespace Database\Seeders {
    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class DeveloperSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $role = Role::create(['name' => 'developer']);
            $role->givePermissionTo('dev_access');
        }
    }
}
