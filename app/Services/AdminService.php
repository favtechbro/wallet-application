<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminService
{
    public function __construct(private readonly WalletService $walletService)
    {
    }

    public function credit($userId, $amount)
    {
        $this->walletService->credit($userId, $amount);
    }

    public function debit($userId, $amount)
    {
        $this->walletService->debit($userId, $amount);
    }

    public function getTransactionReport()
    {
        return Wallet::with('user')->get();
    }

    public function getWeeklyReport()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        $transactions = Transaction::where('created_at', '>=', $oneWeekAgo)->with('user')->get();

        return $transactions;
    }
}
