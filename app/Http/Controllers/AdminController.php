<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreditUserRequest;
use App\Http\Requests\AdminDebitUserRequest;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Services\UserService;

class AdminController extends Controller
{
    public function __construct(private readonly AdminService $adminService, private readonly UserService $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->getUsers();

        $transactions = $this->adminService->getWeeklyReport();

        return view('dashboard', compact('transactions', 'users'));
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

    public function reports(Request $request)
    {
        $data = $this->adminService->getWeeklyReport();
    }
}
