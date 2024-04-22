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
                    <form action="{{ route('sendOTP') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="mobile">{{ __('users.phone') }}</label>
                            <x-input id="mobile" type="text" class="mt-1 block w-full" value="{{ Auth::user()->mobile }}" required autocomplete="mobile" disabled />
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
