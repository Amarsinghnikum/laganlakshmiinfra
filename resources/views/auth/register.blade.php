@extends('backend.auth.auth_master')

@section('auth_title')
Register
@endsection

@section('auth-content')
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="login-form-head">
                    <h4>Sign In</h4>
                    <p>Hello there, Sign in and start managing your Account</p>
                </div>
                <div class="login-form-body">
                    @include('backend.layouts.partials.messages')
                    <div class="form-gp">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-gp">
                        <select id="price_level" name="price_level"
                            class="form-control @error('price_level') is-invalid @enderror" required>
                            <option value="">-- Select Partner Type --</option>
                            <option value="end_user" {{ old('price_level') == 'end_user' ? 'selected' : '' }}>End User
                            </option>
                            <option value="installer" {{ old('price_level') == 'installer' ? 'selected' : '' }}>
                                Installer (Special Partner)</option>
                            <option value="dealer" {{ old('price_level') == 'dealer' ? 'selected' : '' }}>Dealer (VIP
                                Partner)</option>
                            <option value="distributor" {{ old('price_level') == 'distributor' ? 'selected' : '' }}>
                                Distributor</option>
                        </select>
                        @error('price_level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-gp">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-gp">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-gp">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('google.login') }}"
                            class="btn btn-light btn-block border d-flex align-items-center justify-content-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#EA4335"
                                        d="M24 9.5c3.54 0 6.02 1.53 7.4 2.8l5.46-5.46C33.5 3.74 29.1 1.5 24 1.5 14.74 1.5 6.93 6.98 3.17 14.92l6.56 5.1C11.5 13.2 17.25 9.5 24 9.5z"/>
                                    <path fill="#4285F4"
                                        d="M46.5 24.5c0-1.64-.15-3.22-.43-4.75H24v9h12.7c-.55 2.98-2.2 5.5-4.7 7.2l7.24 5.6C43.6 37.4 46.5 31.4 46.5 24.5z"/>
                                    <path fill="#FBBC05"
                                        d="M9.73 28.02c-.45-1.33-.7-2.75-.7-4.27s.25-2.94.7-4.27l-6.56-5.1C1.95 17.52 1.5 20.68 1.5 24s.45 6.48 1.67 9.62l6.56-5.1z"/>
                                    <path fill="#34A853"
                                        d="M24 46.5c6.1 0 11.2-2.02 14.94-5.5l-7.24-5.6c-2 1.35-4.56 2.15-7.7 2.15-6.75 0-12.5-3.7-14.27-9.02l-6.56 5.1C6.93 41.02 14.74 46.5 24 46.5z"/>
                                </svg>
                            <span class="fw-medium">Continue with Google</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection