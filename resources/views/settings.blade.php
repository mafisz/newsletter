@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('settings') }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ __('Settings') }}
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <dl>
                            <dt>{{ __('Name') }}</dt>
                            <dd>{{ auth()->user()->name }}</dd>
                            <dt>{{ __('E-Mail Address') }}</dt>
                            <dd>{{ auth()->user()->email }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                {{ __('Change password') }}
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                        <label for="current_password">{{ __('Current password') }}</label>
                                        <input id="current_password" type="password" class="form-control" name="current_password" required>

                                        @if ($errors->has('current_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">{{ __('New password') }}</label>
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if(auth()->user()->updated_at)
                                <div class="card-footer text-muted">
                                    {{ __('Last change') }} {{ \Carbon\Carbon::now()->diffForHumans(auth()->user()->updated_at) }}
                                </div>
                            @endif
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection