<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $userCount = User::count();

        if ($userCount == 0) {
            $this->command->info('No users found, skipping transactions seeding.');
            return;
        }

        $transactionsPerUser = 50;

        User::all()->each(function ($user) use ($transactionsPerUser) {
            Transaction::factory()->count($transactionsPerUser)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
