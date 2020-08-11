@extends('layouts.app')

@section('content')

<style>
td {
	word-wrap: break-word;
}
</style>

<div class="container">

	<h2><strong>Event List</strong></h2>
	<a href="{{ route('events.create')}}" class="btn btn-primary">Add new event</a>
	<br><br>
	<table class="table">
		<thead>
			<tr>
				<th >Title</td>
                <th >Description</td>
				<th >Start at</th>
				<th >End at</th>
				<th >User</th>
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
				<!-- <td>
					 <a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Edit</a>
				</td>	 -->
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
    {{ $events->links() }}


</div>
@endsection