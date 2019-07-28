@extends('layouts.auth')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}">
                    <span class="fa fa-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail') }}">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus placeholder="{{ __('Phone') }}">
                    <span class="fa fa-phone form-control-feedback"></span>
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}">
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{--<div class="social-auth-links text-center">--}}
                {{--<p>- OR -</p>--}}
                {{--<a href="#" class="btn btn-block btn-primary">--}}
                    {{--<i class="fa fa-facebook mr-2"></i>--}}
                    {{--Sign up using Facebook--}}
                {{--</a>--}}
                {{--<a href="#" class="btn btn-block btn-danger">--}}
                    {{--<i class="fa fa-google-plus mr-2"></i>--}}
                    {{--Sign up using Google+--}}
                {{--</a>--}}
            {{--</div>--}}

            {{--<a href="{{ route('login') }}" class="text-center">I already have a membership</a>--}}
        </div>
        <!-- /.form-box -->
    </div>
@endsection
