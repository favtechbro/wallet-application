<?php
namespace App\Common;

use App\Services\AdminService;
use App\Services\WalletService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function __construct(private readonly WalletService $walletService)
    {
        
    }
    public function collection()
    {
        return $transactions = (new AdminService($this->walletService))->getWeeklyReport();

        // $data  = [];
        // foreach($transactions as $transaction){
        //     array_push($data, [
        //         'user' => $transaction->user->name,
        //         'amount' => $transaction->amount,
        //         'type' => $transaction->type,
        //         'date' => $transaction->created_at
        //     ]);
        // }

        // return $data;
    }

    public function headings(): array
    {
        return [
            'User',
            'Amount',
            'Type',
            'Date'
        ];
    }
}
