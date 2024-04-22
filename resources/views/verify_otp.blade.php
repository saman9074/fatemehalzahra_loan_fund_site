<x-app-layout>
    <div class="container mt-5 mainDive">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('users.verify') }}</div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('checkOTP') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="verify_code">{{ __('users.verify_code') }}</label>
                                <x-input name="verify_code" id="verify_code" type="text" class="mt-1 block w-full" required autocomplete="verify_code" />
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">{{ __('users.sendCode') }}</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
