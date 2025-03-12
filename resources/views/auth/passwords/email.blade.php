<x-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="px-6 py-8">
            <div class="max-w-lg mx-auto mt-10">
                <div class="text-center font-bold text-xl">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" style="color: green;" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="border border-gray-200 p-2 w-full rounded form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <x-form.button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </x-form.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
