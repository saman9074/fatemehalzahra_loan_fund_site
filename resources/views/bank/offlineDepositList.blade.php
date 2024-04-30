<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Offline Deposit List') }}
        </h2>
    </x-slot>

    <h2>لیست درخواست‌های واریز آفلاین</h2>

    <table>
        <thead>
        <tr>
            <th>شماره درخواست</th>
            <th>کارت / حساب مبدا</th>
            <th>کارت / حساب مقصد</th>
            <th>مبلغ</th>
            <th>وضعیت</th>
            <th>شماره پیگیری تراکنش</th>
            <th>تاریخ ایجاد</th>
            <th>توضیحات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offlineDeposits as $deposit)
            <tr>
                <td>{{ $deposit->id }}</td>
                <td>{{ $deposit->origin_card_number }}</td>
                <td>{{ $deposit->destination_card_number }}</td>
                <td>{{ $deposit->amount }}</td>
                @if($deposit->transfer_status == "confirmed")
                    <td>{{ __("deposit confirmed.") }}</td>
                @endif
                @if($deposit->transfer_status == "pending")
                    <td>{{ __("deposit pending.") }}</td>
                @endif
                @if($deposit->transfer_status == "rejected")
                    <td>{{ __("deposit rejected.") }}</td>
                @endif
                <td>{{ $deposit->tracking_number }}</td>
                <td>{{ $deposit->deposit_time }}</td>
                <td>{{ $deposit->desc }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
