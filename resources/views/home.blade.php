@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('home') }}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            {{ __('Campaigns') }} - {{ __('summary') }}
                        </div>

                        <div class="card-body">
                            <ul class="list-group">
                            @forelse ($campaigns as $campaign)
                                <li class="list-group-item d-flex justify-content-between align-items-center @if(!$campaign->active) bg-warning @else bg-success text-white @endif @if($campaign->send) bg-info @endif">
                                    <div>
                                        <span>{{ $campaign->title }}</span>
                                    </div>
                                    <div>
                                        @if(!$campaign->send)
                                            <span>{{ __('Start date') }}: {{ \Carbon\Carbon::now()->diffForHumans($campaign->send_time) }}</span>
                                        @else
                                            <span>{{ __('Sended') }}: {{ \Carbon\Carbon::now()->diffForHumans($campaign->send_time) }}</span>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">{{ __('No campaigns') }}</li>
                            @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            {{ __('Members') }}
                        </div>

                        <div class="card-body">
                            <h3>{{ __('Members count') }} : {{ $members->count() }}</h3>
                            <h3>{{ __('Mails in queue') }} : {{ count($jobs) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
