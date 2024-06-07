<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li style="color: #fff"><strong><center>{!! \Session::get('success') !!}</center></strong></li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-error">
                        <ul>
                            <li style="color: red"><strong><center>{!! \Session::get('error') !!}</center></strong></li>
                        </ul>
                    </div>
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">Credit Wallet</div>
                <form action="/admin/credit" method="post">
                    @csrf
                    <label for="user_id" style="color: #fff">User</label>
                    <select name="user_id" id="user_id" style="width: 100%; margin-bottom: 10px;">
                        <option value="">Please select</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <label for="amount" style="color: #fff">Amount</label>
                    <input type="number" name="amount" id="amount" style="width: 100%; margin-bottom: 10px;">
                    <button type="submit" style="background-color:brown; color: #fff; padding: 10px 30px">Credit
                        Wallet</button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">Debit Wallet</div>
                <form action="/admin/debit" method="post">
                    @csrf
                    <label for="user_id" style="color: #fff">User</label>
                    <select name="user_id" id="user_id" style="width: 100%; margin-bottom: 10px;">
                        <option value="">Please select</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <label for="amount" style="color: #fff">Amount</label>
                    <input type="number" name="amount" id="amount" style="width: 100%; margin-bottom: 10px;">
                    <button type="submit" style="background-color:brown; color: #fff; padding: 10px 30px">Debit
                        Wallet</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
