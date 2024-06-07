<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditWalletRequest;
use App\Http\Requests\DebitWalletRequest;
use Illuminate\Http\Request;
use App\Services\WalletService;

class WalletController extends Controller
{
    public function __construct(private readonly WalletService $walletService)
    {
    }

    public function credit(CreditWalletRequest $request)
    {
        $amount = $request->input('amount');
        $this->walletService->credit(auth()->id(), $amount);

        return response()->json(['message' => 'Wallet credited successfully.']);
    }

    public function debit(DebitWalletRequest $request)
    {
        $amount = $request->input('amount');

        try {
            $this->walletService->debit(auth()->id(), $amount);
            return response()->json(['message' => 'Wallet debited successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function balance()
    {
        $balance = $this->walletService->getBalance(auth()->id());
        return response()->json([
            'data' => ['balance' => $balance],
        ]);
    }
}
