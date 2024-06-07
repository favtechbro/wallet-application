<x-app-layout>
    <x-slot name="header">
        <a href="/dashboard">
            <label class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
                Dashboard
            </label>
        </a>
        <a href="/dashboard/transactions">
            <label class="margin-left: 10px; font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
                Transactions
            </label>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a style="background-color:brown; color: #fff; padding: 10px 30px; float: right" href="/download-report" target="_blank" rel="noopener noreferrer">Export Report</a>

                <div class="p-6 text-gray-900 dark:text-gray-100">Transactions</div>
                <table >
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->user->name}}</td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
