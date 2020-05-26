@extends("layouts.app")

@section("card-header")
    {{ __("event.list.title") }}
@endsection

@section("card-body")
    <table class="table compact" id="eventList">
        <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Title</th>
            <th>Start Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            {{--
            -- 0 - All
            -- 1 - Today
            -- 2 - Next 5 days
            --}}
            <tr data-active="{{ $event['data_active'] }}">
                <td scope="row">{{ $event['id'] }}</td>
                <td>{{ \App\Models\User::find($event['user_id'])->name }}</td>
                <td>{{ $event['description'] }}</td>
                <td><div id="endDate">{{ date_format(date_create_from_format('Y-m-d H:i:s', $event['end_date']), "H:i d/m/Y") }}</div></td>
                <td><button class="btn btn-warning mx-1" value="{{ $event['id'] }}" id="createInvite"><i class="fas fa-envelope-open"></i></button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            $('table[id="eventList"]').DataTable({
                lengthMenu: [ 5, 10, 25, 50 ],
                columnDefs: [
                    { "orderable": false, "targets": 0 }
                ]
            });
            $('button[id="createInvite"]').click(function () {
                $.ajax({
                    url: 'invite/create/' + $(this).val(),
                    method: "POST",
                    data: { },
                    contentType: 'application/json',
                    success: function (response) {
                        alert("New invite link: http://localhost:8000/enter/" + response.data.hash);
                    },
                    error: function (response) {
                        console.log(response);
                        alert("Wasn't possible create an InvitationController, try again later!");
                    }
                }).done(function (response) {
                    console.log(response);
                });
            });
        });
    </script>
@endsection
