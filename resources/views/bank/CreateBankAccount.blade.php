<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Bank Account') }}
        </h2>
    </x-slot>

    <!-- resources/views/bank_accounts/create.blade.php -->

    <form method="POST" action="{{ route('bank-accounts.store') }}">
        @csrf


        <div class="form-group">
            <label for="account_type">نوع حساب:</label>
            <select name="account_type" id="account_type">
                <option value="qarz">قرض الحسنه</option>
                <option value="jari">جاری</option>
            </select>
        </div>

        <button type="submit">ایجاد حساب بانکی</button>
    </form>


</x-app-layout>
