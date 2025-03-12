<x-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="px-6 py-8">
            <div class="max-w-lg mx-auto mt-10">
                <div class="text-center font-bold text-xl">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <x-form.input name='password' type="password" required />
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                            <x-form.button>{{ __('Confirm Password') }}</x-form.button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
