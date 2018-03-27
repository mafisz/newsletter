@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('campaign', $campaign) }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ $campaign->title }}
                </div>
                <form method="POST" action="{{ route('editCampaign') }}">
                @csrf
                    <input type="hidden" name="campaignId" value="{{ $campaign->id }}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-5">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $campaign->title }}" required>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="list" class="col-sm-4 col-form-label text-md-right">{{ __('Mailing list') }}</label>

                            <div class="col-md-5">
                                <select id="list" name="listId" class="form-control" required>
                                    @forelse ($lists as $list)
                                        <option value="{{ $list->id }}" @if($campaign->list_id == $list->id) selected="selected" @endif>{{ $list->name }}</option>
                                    @empty
                                        <option>{{ __('No lists') }}</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('listId'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('listId') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-muted">
                                    <a href="{{ route('templates') }}">{{ __('Mailing lists') }}</a>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label text-md-right">{{ __('Start date') }}</label>

                            <div class="col-md-3">
                                <input type="date" name="start_date" class="form-control" value="{{ $campaign->send_time->format('Y-m-d') }}" required >
                                
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="time" name="start_time" class="form-control" value="{{ $campaign->send_time->format('H:i') }}" required>
                                
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control tinymce" rows="25" name="content">{{ $campaign->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection