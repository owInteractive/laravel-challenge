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
        <div class="card-header">{{ __('Event List') }}</div>

        <div class="card-body">
			
			<form id="search-form" action="{{ route('events.search')}}" method="post">
			@csrf
				<div class="form-row">
					<div class="form-group col-md-10">
						<a href="{{ route('events.create')}}" class="btn btn-primary">Add new event</a>
					</div>
					
						<div class="form-group col-md-2">
							<select class="form-control" id="searchType" name="searchType" onchange="document.getElementById('search-form').submit();">
								@foreach($searchTypes as $type)
									@if($type->id == $searchType )
										<option value="{{$type->id}}" selected>{{$type->description}}</option>
									@else
										<option value="{{$type->id}}">{{$type->description}}</option>
									@endif
								@endforeach	
							</select>
						</div>
					
				</div>
			</form>
					
			<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('events.file-import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="file" name="import_file" />
				<button class="btn btn-primary">Import File</button>
				<a class="btn btn-success" href="{{ route('events.file-export') }}">Export data</a>
			</form>

		</div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th >Title</td>
                <th >Description</td>
				<th >Start at</th>
				<th >End at</th>
				<th >User</th>
				<th >Guests</th>
				<th colspan = 2>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
			<tr>
				<td>{{$event->title}}</td>
                <td>{{$event->description}}</td>
				<td>{{date('d-m-Y', strtotime($event->start_date))}} {{date('H:i', strtotime($event->start_time))}}</td>
				<td>{{date('d-m-Y', strtotime($event->end_date))}} {{date('H:i', strtotime($event->end_time))}}</td>
				<td>{{$event->user->name}}</td>
				<td>
					 <a href="{{ route('events.invite',$event->id)}}" class="btn btn-success">{{$event->emails_count}} +</a>
				</td>
				<td>
					 <a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Edit</a>
				</td>	
				<td>
                    <form action="{{ route('events.destroy', $event->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
				</td>
			</tr>

			@endforeach
		</tbody>
	</table>
    {{ $events->links() }}


</div>
@endsection