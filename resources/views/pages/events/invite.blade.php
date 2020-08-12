@extends('layouts.app')

@extends('layouts.alert_message') 

@section('content')

<style>
td {
	word-wrap: break-word;
}
</style>

<div class="container">

	<div class="card">
        <div class="card-header">
			<strong>Event:</strong> {{$event->title}}
		</div>

        <div class="card-body">
			
			<form id="invite-form" action="{{ route('emails.store')}}" method="post">
			@csrf
				<div class="form-group row">
					<label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

					<div class="col-md-7">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-primary btn-block">
							{{ __('Invite') }}
						</button>
					</div>
				</div>
				<div class="form-group row" style="display:none">
						<input id="event_id" type="text" class="form-control" 
							   name="event_id" value="{{$event->id}}" >
				</div>
			</form>

		</div>
	</div>

    <table class="table">
        <thead>
            <tr>
                <th >Friends invited</td>
                <!-- <th >Action</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($event->emails as $email)
            <tr>
                <td>{{$email->email}}</td>
                <!-- <td>
                    <form action="{{ route('events.destroy', $event->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td> -->
            </tr>

            @endforeach
        </tbody>
    </table>

</div>
@endsection