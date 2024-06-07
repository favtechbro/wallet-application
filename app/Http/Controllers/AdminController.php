<?php

namespace App\Http\Controllers;

use App\Common\TransactionsExport;
use App\Http\Requests\AdminCreditUserRequest;
use App\Http\Requests\AdminDebitUserRequest;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Services\UserService;
use App\Services\WalletService;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct(private readonly AdminService $adminService, private readonly UserService $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->getUsers();

        return view('dashboard', compact('users'));
    }

    public function reports()
    {
        $transactions = $this->adminService->getWeeklyReport();

        return view('transactions', compact('transactions'));
    }

    public function credit(AdminCreditUserRequest $request)
    {
        try {
            $amount = $request->input('amount');
            $userId = $request->input('user_id');

            $this->adminService->credit($userId, $amount);
            return redirect()->back()->with('success', 'Wallet credited successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function debit(AdminDebitUserRequest $request)
    {
        $amount = $request->input('amount');
        $userId = $request->input('user_id');

        try {
            $this->adminService->debit($userId, $amount);
            return redirect()->back()->with('success', 'Wallet debited successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function exportWeeklyReport()
    {
        return Excel::download(new TransactionsExport(new WalletService()), 'weekly_report.xlsx');
    }
}
