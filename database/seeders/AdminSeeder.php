<?php

namespace Database\Seeders {
    use Spatie\Permission\Models\Role;
    use Illuminate\Database\Seeder;
    use App\Models\User;

    class AdminSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // administrator
            $admin = Role::create(['name' => 'admin']);
            $admin->givePermissionTo('*');
            $user = User::create([
                'password' => bcrypt('password'),
                'email'    => 'admin@example.com',
                'first_name' => fake()->firstName(),
                'last_name'  => fake()->lastName(),
                'phone'      => fake()->phoneNumber(),
            ]);
            $user->assignRole($admin);
        }
    }
}
