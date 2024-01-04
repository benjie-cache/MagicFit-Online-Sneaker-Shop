<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\user_management\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory(4)->create();
    }
}
