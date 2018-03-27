@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('template', $template) }}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ $template->name }}
                </div>
                <form method="POST" action="{{ route('editTemplate') }}">
                @csrf
                    <input type="hidden" name="templateId" value="{{ $template->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea class="form-control tinymce" rows="25" name="content">{{ $template->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection