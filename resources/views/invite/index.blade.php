@extends('layouts.app')
@section('card-body')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Event ID</th>
            <th>Hash</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invites as $invite)
        <tr>
            <td scope="row">{{ $invite['id'] }}</td>
            <td>{{ $invite['event_id'] }}</td>
            <td>{{ $invite['hash'] }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection