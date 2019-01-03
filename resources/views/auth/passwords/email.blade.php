@extends('atomic::auth.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @include('atomic::auth.partials.header')

                        <hr>
                        @component('atomic::auth.partials.heading')
                            {{ __('atomic::main.Forgot Your Password?') }}
                        @endcomponent

                        <form method="POST" action="{{ route('AtomicPanel.password.email') }}">
                            @csrf
                            @if (session('status'))
                                <div class="text-success text-center font-semibold my-3">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @include('atomic::auth.partials.errors')
                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label text-center">{{ __('atomic::main.E-Mail Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('atomic::main.Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
