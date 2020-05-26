@extends('layouts.app')
@section('card-body')
    <table class="table" id="inviteList">
        <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Title</th>
            <th>Hash</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invites as $invite)
        <tr>
            <td scope="row">{{ $invite['event_id'] }}</td>
            <td>{{ \App\Models\Event::find($invite['event_id'])->title }}</td>
            <td>{{ $invite['hash'] }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            $('table[id="inviteList"]').DataTable({
                lengthMenu: [10, 25, 50 ],
                columnDefs: [
                    { "orderable": false, "targets": 0 }
                ]
            });
        })
    </script>
@endsection
