@extends('layouts.app')

@section('content')

<div class="container">

	<h2><strong>Event List</strong></h2>
	<!-- <a href="{{ route('events.create')}}" class="btn btn-primary">Add new event</a> -->
	<table class="table">
		<thead>
			<tr>
				<th >Title</td>
                <th >Description</td>
				<th >Start at</th>
				<th >End at</th>
				<th >User</th>
				<!-- <th colspan = 2>Actions</th> -->
			</tr>
		</thead>
		<tbody>
			@foreach($events as $event)
			<tr>
				<td>{{$event->title}}</td>
                <td>{{$event->description}}</td>
				<td>{{date('d-m-Y H:m', strtotime($event->start_at))}}</td>
				<td>{{date('d-m-Y H:m', strtotime($event->end_at))}}</td>
				<td>{{$event->user->name}}</td>
				<!-- <td>
					 <a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Edit</a>
				</td>	
				<td>
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
    {{ $events->links() }}


</div>
@endsection