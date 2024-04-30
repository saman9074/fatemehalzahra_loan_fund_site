<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Offline Deposit') }}
        </h2>
    </x-slot>

<h2>واریز وجه</h2>

<form method="POST" action="{{ route('offline-deposit.store') }}">
    @csrf

    <div class="form-group">
        <label for="origin_card_number">شماره حساب یا کارت مبدا:</label>
        <input type="text" name="origin_card_number" id="origin_card_number">
    </div>

    <div class="form-group">
        <label for="destination_card_number">شماره حساب یا کارت مقصد:</label>
        <input type="text" name="destination_card_number" id="destination_card_number">
    </div>

    <div class="form-group">
        <label for="amount">مبلغ واریزی:</label>
        <input type="number" name="amount" id="amount" min="0">
    </div>

    <div class="form-group">
        <label for="deposit_time">زمان واریزی:</label>
        <input data-jdp name="deposit_time" id="deposit_time">
    </div>

    <div class="form-group">
        <label for="tracking_number">شماره پیگیری:</label>
        <input type="text" name="tracking_number" id="tracking_number">
    </div>

    <div class="form-group">
        <input type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
    </div>

    <button type="submit">انجام عملیات واریز وجه</button>
</form>
    <script>
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "today",
            minTime: "attr",
            maxTime: "today",
            hideAfterChange: true,
            autoHide: true,
            showTodayBtn: true,
            showEmptyBtn: false,
            topSpace: 10,
            bottomSpace: 30,
            useDropDownYears: true,
            dayRendering(opt,input){
                return {
                    isHollyDay:opt.day==1
                }
            }
        });

        document.getElementById("aaa").addEventListener("jdp:change", function (e) { console.log(e) });
    </script>
</x-app-layout>
