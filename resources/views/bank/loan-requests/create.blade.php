<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Internal transfer') }}
        </h2>
    </x-slot>
    <h2>درخواست وام</h2>

<form action="{{ route('loan-requests.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="income_variety">تنوع درآمد:</label>
    <select name="income_variety" id="income_variety">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3 و بیشتر</option>
    </select>

    <label for="job_type">نوع شغل اصلی:</label>
    <input type="radio" id="employee" name="job_type" value="employee">
    <label for="employee">کارمند</label>
    <input type="radio" id="freelancer" name="job_type" value="freelancer">
    <label for="freelancer">آزاد</label>

    <label for="job_title">عنوان دقیق شغلی:</label>
    <input type="text" id="job_title" name="job_title">

    <label for="second_job">شغل دوم:</label>
    <input type="text" id="second_job" name="second_job">

    <label for="main_income">میزان درآمد از شغل اصلی:</label>
    <input type="number" id="main_income" name="main_income">

    <label for="other_income">میزان درآمد از سایر:</label>
    <input type="number" id="other_income" name="other_income">

    <label for="monthly_expenses">هزینه های ماهیانه:</label>
    <input type="number" id="monthly_expenses" name="monthly_expenses">

    <label for="salary_slip">تصویر فیش حقوقی یا جواز کسب:</label>
    <input type="file" id="salary_slip" name="salary_slip" accept=".pdf, .jpg, .png">

    <label for="bank_statement">صورت حساب 6 ماهه بانکی:</label>
    <input type="file" id="bank_statement" name="bank_statement" accept=".pdf">

    <label for="assets">دارای خانه و ماشین:</label>
    <select name="assets" id="assets">
        <option value="home">خانه</option>
        <option value="car">ماشین</option>
        <option value="both">هر دو</option>
    </select>

    <label for="loan_amount">مبلغ وام پیشنهادی:</label>
    <input type="range" id="loan_amount" name="loan_amount" min="1000000" max="100000000" step="500000" oninput="updateSliderValue(this.value)">
    <span id="loan_amount_value">1,000,000 تومان</span>



    <label for="installments">تعداد اقساط پیشنهادی:</label>
    <select name="installments" id="installments">
        <option value="3">3 ماهه</option>
        <option value="6">6 ماهه</option>
        <option value="12">12 ماهه</option>
        <option value="24">24 ماهه</option>
    </select>

    <label for="reason">علت درخواست وام:</label>
    <textarea id="reason" name="reason"></textarea>

    <label for="guarantor_name">نام و نام خانوادگی ضامن:</label>
    <input type="text" id="guarantor_name" name="guarantor_name">

    <label for="guarantor_national_code">کد ملی ضامن:</label>
    <input type="text" id="guarantor_national_code" name="guarantor_national_code">

    <label for="guarantor_birth_date">تاریخ تولد ضامن:</label>
    <input data-jdp data-jdp-max-date="1385/02/12" id="guarantor_birth_date" name="guarantor_birth_date">

    <label for="guarantor_has_check">ضامن دارای چک:</label>
    <input type="radio" id="yes" name="guarantor_has_check" value="yes">
    <label for="yes">بله</label>
    <input type="radio" id="no" name="guarantor_has_check" value="no">
    <label for="no">خیر</label>

    <div class="form-group">
        <input type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
    </div>

    <button type="submit">ارسال درخواست وام</button>
</form>

    <script>
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr",
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
        function updateSliderValue(val) {
            var displayVal = numberWithCommas(val) + ' تومان';
            document.getElementById('loan_amount_value').innerHTML = displayVal;
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
</x-app-layout>
