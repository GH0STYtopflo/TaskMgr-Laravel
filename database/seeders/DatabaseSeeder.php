<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        User::create([
            'username' => 'ghosty',
            'is_admin' => true,
            'password' => 'unfortunatelyghostymissedthistime',
        ]);

        User::create([
            'username' => 'jeffery_williams',
            'is_admin' => false,
            'password' => '12345678',
        ]);
    }
}
