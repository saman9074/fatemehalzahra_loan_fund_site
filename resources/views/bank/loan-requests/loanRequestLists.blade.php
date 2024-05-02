<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Offline Deposit List') }}
        </h2>
    </x-slot>

    <h2>لیست درخواست‌های وام</h2>

    <table>
        <thead>
        <tr>
            <th>شماره درخواست</th>
            <th>مبلغ</th>
            <th>تعداد اقساط</th>
            <th>علت درخواست</th>
            <th>نام و نام خانوادگی ضامن</th>
            <th>کد ملی ضامن</th>
            <th>تاریخ ایجاد</th>
            <th>وضعیت</th>
            <th>توضیحات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($LoanRequests as $lreq)
            <tr>
                <td>{{ $lreq->id }}</td>
                <td>{{ $lreq->loan_amount }}</td>
                <td>{{ $lreq->installments }}</td>
                <td>{{ $lreq->reason }}</td>
                <td>{{ $lreq->guarantor_name }}</td>
                <td>{{ $lreq->guarantor_national_code }}</td>
                <td>{{ $lreq->created_at }}</td>
                @if($lreq->loan_request_status == "confirmed")
                    <td>{{ __("deposit confirmed.") }}</td>
                @endif
                @if($lreq->loan_request_status == "pending")
                    <td>{{ __("deposit pending.") }}</td>
                @endif
                @if($lreq->loan_request_status == "rejected")
                    <td>{{ __("deposit rejected.") }}</td>
                @endif
                <td>{{ $lreq->des }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
