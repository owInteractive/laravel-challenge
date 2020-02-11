@extends('layouts.app', ['activePage' => 'event', 'titlePage' => __('Event Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('event.update',$event) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Event') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}"  value="{{ old('title', $event->title) }}" required="true" aria-required="true"/>
                      @if ($errors->has('title'))
                        <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="description" placeholder="{{ __('Description') }}"  value="{{ old('description', $event->description) }}" required />
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Start at') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                      <input class="date_time form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}" name="start_at" id="input-start_at" type="text" placeholder="{{ __('00/00/0000 00:00:00')}}" value="{{ old('start_at', date('d/m/Y H:i:s',strtotime($event->start_at))) }}" required />
                      @if ($errors->has('start_at'))
                        <span id="start_at-error" class="error text-danger" for="input-start_at">{{ $errors->first('start_at') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('End at') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                      <input class="date_time form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}" name="end_at" id="input-end_at" type="text" placeholder="{{ __('00/00/0000 00:00:00') }}" value="{{ old('end_at', date('d/m/Y H:i:s',strtotime($event->end_at))) }}" required />
                      @if ($errors->has('end_at'))
                        <span id="end_at-error" class="error text-danger" for="input-end_at">{{ $errors->first('end_at') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Edit Event') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
{{ Html::script('material/js/plugins/jquery.dataTables.min.js') }}
{{ Html::script('js/jquery.mask.min.js') }}
{{ Html::script('js/events.js') }}
@endpush