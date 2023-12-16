<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'name'        => 'Antelope Ridge Apartments',
            'phone'       => '1 (951) 672-8181',
            'client_id'   => User::role('client')->first()->id,
            'address'     => '27757 Aspel Rd Menifee, CA 92585',
            'description' => 'Located just off of I-215, with gorgeous views of rolling mountains right in the backyard, is Antelope Ridge Apartments. With nearby dining, shopping and entertainment, our residents never have to travel far for essentials. Menifee Town Center, Menifee Lakes Plaza and Shops at Newport are all a few minutes away and Regency Perris is always showing the latest movie releases. Antelope Ridge Apartments resides in the Valley-Wide Recreation & Park District award winning California parks. McCall Canyon Park has two basketball courts and a playground and Heritage Lake Park is perfect for those days you want to be on, or in, the water. For those who are more adventurous, head to Just in Time Skydivers, a skydiving destination with beautiful views of the mountains.'
        ]);
    }
}
