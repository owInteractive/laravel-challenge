@extends("layouts.app")

@section("card-header")
    {{ __("event.list.title") }}
@endsection

@section("card-body")
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>desc</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td scope="row">{{ $event['id'] }}</td>
                <td>{{ $event['title'] }}</td>
                <td>{{ $event['description'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section("card-footer")

@endsection
