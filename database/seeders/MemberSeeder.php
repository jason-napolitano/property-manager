<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // administrator
        $member = Role::create(['name' => env('APP_DEFAULT_ROLE')]);
        $member->givePermissionTo('manage_profile');
        $member->givePermissionTo('update_profile');
        $member->givePermissionTo('delete_profile');

        /*
        $user = User::create([
            'password'   => bcrypt('password'),
            'email'      => 'client@example.com',
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'phone'      => fake()->phoneNumber(),
        ]);
        $user->assignRole($member);
        */
    }
}
