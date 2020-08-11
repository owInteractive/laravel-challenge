@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Event') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
									name="title" value="{{ old('title') }}" required maxLength="50" autocomplete="title" autofocus>

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
								<input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
									name="description" value="{{ old('description') }}" required maxLength="200" autocomplete="description" autofocus>

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
										value="{{ old('start_date') }}" required autofocus>

									@error('start_date')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<label for="start_time" class="col-md-2 col-form-label text-md-right">{{ __('Start time') }}</label>

								<div class="col-md-4">
									<input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" 
										value="{{ old('start_time') }}" required autofocus>

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
										value="{{ old('end_date') }}" required autofocus>

									@error('end_date')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<label for="end_time" class="col-md-2 col-form-label text-md-right">{{ __('End time') }}</label>

								<div class="col-md-4">
									<input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" 
										value="{{ old('end_time') }}" required autofocus>

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
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>











































	<!-- <h2>Add Event</h2>

	<form method="POST" action="{{ route('events.store') }}">

		<div class="form-group">
			<label for="title">Title:</label>
			<input name="title" class="form-control" max="50"></input>
		</div>

        <div class="form-group">
			<label 	  for="description">Description:</label>
			<textarea name="description" class="form-control" max=200></textarea>
		</div>

		<div class="form-row">
            <div class="col">
                <label for="start_date">Start Date:</label>
                <input name="start_date" class="form-control" type="date"></input>
            </div>
            <div class="col">
                <label for="start_time">Start Time:</label>
                <input name="start_time" class="form-control" type="time"></input>
            </div>
		</div>
		<div class="form-row">
            <div class="col">
                <label for="end_date">End Date:</label>
                <input name="end_date" class="form-control" type="date"></input>
            </div>
            <div class="col">
                <label for="end_time">End Time:</label>
                <input name="end_time" class="form-control" type="time"></input>
            </div>
		</div>
		
		<br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Add Event</button>
		</div>
		{{ csrf_field() }}
	</form> -->


</div>

@endsection