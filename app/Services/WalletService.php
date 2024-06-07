<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function credit($userId, float $amount)
    {
        DB::transaction(function () use ($userId, $amount) {
            $wallet = Wallet::lockForUpdate()->firstOrCreate(['user_id' => $userId]);
            $wallet->balance += $amount;
            $wallet->save();

            Transaction::create([
                'user_id' => $userId,
                'type' => 'credit',
                'amount' => $amount,
            ]);
        });
    }

    public function debit($userId, $amount)
    {
        DB::transaction(function () use ($userId, $amount) {
            $wallet = Wallet::lockForUpdate()->firstOrCreate(['user_id' => $userId]);
            if ($wallet->balance >= $amount) {
                $wallet->balance -= $amount;
                $wallet->save();

                Transaction::create([
                    'user_id' => $userId,
                    'type' => 'debit',
                    'amount' => $amount,
                ]);
            } else {
                throw new \Exception('Insufficient balance.');
            }
        });
    }

    public function getBalance($userId)
    {
        $wallet = Wallet::firstOrCreate(['user_id' => $userId]);
        return $wallet->balance;
    }
}
