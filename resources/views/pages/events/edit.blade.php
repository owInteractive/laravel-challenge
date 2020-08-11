@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Event') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.update', $event->id) }}">
                        @csrf
                        @method('PATCH') 

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
									name="title" value="{{$event->title}}" required maxLength="50" autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="form-group row">
							<label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

							<div class="col-md-10">
								<textarea id="description" class="form-control @error('description') is-invalid @enderror"
									name="description" required maxLength="200" autocomplete="description" autofocus>{{$event->description}}
                                </textarea>

								@error('description')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror

							</div>
                        </div>

						<div class="form-group row">
							
								<label for="start_date" class="col-md-2 col-form-label text-md-right">{{ __('Start date') }}</label>

								<div class="col-md-4">
									<input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" 
                                    value="{{$event->start_date}}" required autofocus>

									@error('start_date')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<label for="start_time" class="col-md-2 col-form-label text-md-right">{{ __('Start time') }}</label>

								<div class="col-md-4">
									<input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" 
                                    value="{{date('H:i', strtotime($event->start_time))}}" required autofocus>

									@error('start_time')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
                        </div>

						<div class="form-group row">
							
								<label for="end_date" class="col-md-2 col-form-label text-md-right">{{ __('End date') }}</label>

								<div class="col-md-4">
									<input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" 
                                        value="{{$event->end_date}}" required autofocus>

									@error('end_date')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<label for="end_time" class="col-md-2 col-form-label text-md-right">{{ __('End time') }}</label>

								<div class="col-md-4">
									<input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" 
                                    value="{{date('H:i', strtotime($event->end_time))}}" required autofocus>

									@error('end_time')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
                        </div>

                        <div class="form-group row mt-0">
							<div class="col-md-5 offset-md-1">
									<a href="{{ route('events.index')}}" class="btn btn-danger btn-block">
										{{ __('Cancel') }}
									</a>
								</div>
                            <div class="col-md-5 offset-md-1">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('Update') }}
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