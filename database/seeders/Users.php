<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin SSBLite 1',
            'email' => 'adminssblite1@gmail.com',
            'password' => bcrypt('ssblite1'),
            'gender' => 'Laki-laki',
            'date_of_birth' => '2000-01-01',
            'age_group_category' => null,
            'phone_number' => null,
            'parents_name' => null,
            'parents_telephone_number' => null,
            'address' => null,
            'coach_category' => null,
            'age_group_coach_category' => null,
            'photo' => null,
        ]);
        $admin->assignRole('admin');
    }
}
