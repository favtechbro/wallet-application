<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $transactions = $this->adminService->getTransactionReport();
        return view('admin.index', compact('transactions'));
    }

    public function credit(Request $request)
    {
        $amount = $request->input('amount');
        $userId = $request->input('user_id');

        $this->adminService->credit($userId, $amount);
        return redirect('/admin')->with('message', 'Wallet credited successfully.');
    }

    public function debit(Request $request)
    {
        $amount = $request->input('amount');
        $userId = $request->input('user_id');

        try {
            $this->adminService->debit($userId, $amount);
            return redirect('/admin')->with('message', 'Wallet debited successfully.');
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', $e->getMessage());
        }
    }
    
}

