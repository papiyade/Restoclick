{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>



        <form method="POST" action="{{ route('login') }}">


            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


        @if(session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<body class="vh-100" style="background-image: url('{{ asset('assets/images/bg.png') }}'); background-position: center;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{asset('assets/images/logo/logo-full.png')}}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" for="email" value="{{ __('Email') }}" class="form-control" required autofocus autocomplete="username" placeholder="hello@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" value="{{ __('Password') }}" class="mb-1"><strong>Password</strong></label>
                                            <input id="password"  type="password" name="password" required autocomplete="current-password" class="form-control" >
                                        </div>
                                        <div class="block mt-4">
                                            <label for="remember_me" class="flex items-center">
                                                <x-checkbox id="remember_me" name="remember" />
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

                                        <div class="flex text-center  mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif

                                            <x-button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Log in') }}
                                            </x-button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
<script src="js/custom.js"></script>
<script src="js/deznav-init.js"></script>
</body>
