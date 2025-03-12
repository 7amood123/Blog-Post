<x-layout>
    @section('title')
    sign in
    @endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="px-6 py-8">
            <div class="max-w-lg mx-auto mt-10">
                <div class="text-center font-bold text-xl">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="login">
                        @csrf
                        <x-form.input name='email' type='email' />
                        <x-form.input name='password' type='password' />
                        <x-form.check_box/>
                        @if (Route::has('password.email'))
                            <a class="hover:underline hover:text-gray-900 rounded-md ml-4" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <x-form.button>lin</x-form.button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>

