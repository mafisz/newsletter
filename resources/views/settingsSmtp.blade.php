@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('settingsSmtp') }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ __('Change SMTP configuration') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('changeSmtp') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('mail_host') ? ' has-error' : '' }}">
                            <label for="mail_host">{{ __('MAIL_HOST') }}</label>
                            <input type="text" class="form-control" name="mail_host"
                            @if($mail_config->has('mail_host')) 
                                value="{{ $mail_config->get('mail_host')->value }}"
                            @else
                                value={{ env('MAIL_HOST') }}
                            @endif
                            required>

                            @if ($errors->has('mail_host'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_host') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_username') ? ' has-error' : '' }}">
                            <label for="mail_username">{{ __('MAIL_USERNAME') }}</label>
                            <input type="text" class="form-control" name="mail_username"
                            @if($mail_config->has('mail_username')) 
                                value="{{ $mail_config->get('mail_username')->value }}"
                            @else
                                value={{ env('MAIL_USERNAME') }}
                            @endif
                            required>

                            @if ($errors->has('mail_username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_username') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_password') ? ' has-error' : '' }}">
                            <label for="mail_password">{{ __('MAIL_PASSWORD') }}</label>
                            <input type="password" class="form-control" name="mail_password"
                            @if($mail_config->has('mail_password')) 
                                value="{{ $mail_config->get('mail_password')->value }}"
                            @else
                                value={{ env('MAIL_PASSWORD') }}
                            @endif
                            required>

                            @if ($errors->has('mail_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_encryption') ? ' has-error' : '' }}">
                            <label for="mail_encryption">{{ __('MAIL_ENCRYPTION') }}</label>
                            <select class="form-control" name="mail_encryption" required>
                                @if($mail_config->has('mail_encryption'))
                                    <option value="null" @if($mail_config->get('mail_encryption')->value == 'null') selected="selected" @endif>null</option>
                                    <option value="tls" @if($mail_config->get('mail_encryption')->value == 'tls') selected="selected" @endif>tls</option>
                                    <option value="ssl" @if($mail_config->get('mail_encryption')->value == 'ssl') selected="selected" @endif>ssl</option>
                                @else
                                    <option value="null" @if(env('MAIL_ENCRYPTION') == 'null') selected="selected" @endif>null</option>
                                    <option value="tls" @if(env('MAIL_ENCRYPTION') == 'tls') selected="selected" @endif>tls</option>
                                    <option value="ssl" @if(env('MAIL_ENCRYPTION') == 'ssl') selected="selected" @endif>ssl</option>
                                @endif
                            </select>
                            @if ($errors->has('mail_encryption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_encryption') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_port') ? ' has-error' : '' }}">
                            <label for="mail_port">{{ __('MAIL_PORT') }}</label>
                            <input type="text" class="form-control" name="mail_port"
                            @if($mail_config->has('mail_port')) 
                                value="{{ $mail_config->get('mail_port')->value }}"
                            @else
                                value={{ env('MAIL_PORT') }}
                            @endif
                            required>

                            @if ($errors->has('mail_port'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_port') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_from_address') ? ' has-error' : '' }}">
                            <label for="mail_from_address">{{ __('MAIL_FROM_ADDRESS') }}</label>
                            <input type="text" class="form-control" name="mail_from_address"
                            @if($mail_config->has('mail_from_address')) 
                                value="{{ $mail_config->get('mail_from_address')->value }}"
                            @else
                                value={{ env('MAIL_FROM_ADDRESS') }}
                            @endif
                            required>

                            @if ($errors->has('mail_from_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_from_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mail_from_name') ? ' has-error' : '' }}">
                            <label for="mail_from_name">{{ __('MAIL_FROM_NAME') }}</label>
                            <input type="text" class="form-control" name="mail_from_name"
                            @if($mail_config->has('mail_from_name')) 
                                value="{{ $mail_config->get('mail_from_name')->value }}"
                            @else
                                value={{ env('MAIL_FROM_NAME') }}
                            @endif
                            required>

                            @if ($errors->has('mail_from_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mail_from_name') }}</strong>
                                </span>
                            @endif
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
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ __('Send test email') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('testSmtp') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('test_mail') ? ' has-error' : '' }}">
                            <label for="test_mail">{{ __('E-Mail Address') }}</label>
                            <input id="test_mail" type="email" class="form-control" name="test_mail" required>

                            @if ($errors->has('test_mail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('test_mail') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection