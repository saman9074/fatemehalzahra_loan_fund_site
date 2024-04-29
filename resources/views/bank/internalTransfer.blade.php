<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Internal transfer') }}
        </h2>
    </x-slot>
    <h2>انتقال وجه داخلی بین اعضا</h2>

    <form method="POST" action="{{ route('offline-deposit.store') }}">
        @csrf

        <div class="form-group">
            <label for="source_account">شماره حساب مبدا:</label>
            <input type="text" name="source_account" id="source_account">
        </div>

        <div class="form-group">
            <label for="destination_account">شماره حساب مقصد:</label>
            <input type="text" name="destination_account" id="destination_account">
        </div>

        <div class="form-group">
            <label for="amount">مبلغ انتقالی:</label>
            <input type="number" name="amount" id="amount" min="0">
        </div>

        <button type="submit">انجام عملیات انتقال وجه</button>
    </form>
</x-app-layout>
