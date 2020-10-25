@extends('layouts.app')

@section('title')
	TDMU UNIVERSITY - Login 
@endsection

@section('content')
<div class="limiter container">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					TDMU UNIVERSITY
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="wrap-input100 validate-input" data-validate = "Enter Address email">
						<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Address email" autofocus>
						
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					
					</div>
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
					@error('email')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
						@error('password')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
					</div>
						
					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
                        {{ __('Login') }}
						</button>
					</div>
					<div class="form-group row mb-0">
						<a href="/register" style="text-align: center; color: blue; width:100%; padding:20px; text-size: 16px;"> If you don't have account, please register </a>
					</div>
				</form>
			</div>
		</div>
</div>
@endsection

