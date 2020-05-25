@extends("layouts.app")

@section("card-header")
    {{ __("event.list.title") }}
    <select id="selectEvent" class="form-control">
        <option value="0">Show All Events</option>
        <option value="1">Today Events</option>
        <option value="2">Next 5 Days Events</option>
    </select>
@endsection

@section("card-body")
    <table class="table compact" id="eventList">
        <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Title</th>
            <th>Start Date</th>
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
                <td scope="row">{{ $event['data_active'] }}</td>
                <td>{{ \App\Models\User::find($event['user_id'])->first()->name }}</td>
                <td>{{ $event['description'] }}</td>
                <td><div id="endDate">{{ date_format(date_create_from_format('Y-m-d H:i:s', $event['end_date']), "H:i d/m/Y") }}</div></td>
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
                ],
                rowCallback: function (row, data) {

                    let data_active = $('select[id="selectEvent"]').val();
                    if(data_active == 0)
                    {
                        $(row).show();
                    }
                    if(data_active == 1)
                    {
                        if($(row).data('active') == 0 || $(row).data('active') == 2)
                            $(row).hide();
                        else
                            $(row).show();
                    }
                    if(data_active == 2)
                    {
                        if($(row).data('active') == 0 || $(row).data('active') == 1)
                            $(row).hide();
                        else
                            $(row).show();
                    }
                }
            }).then(alert("Salve"));
            $('select["id=selectEvent"]').on('change', function () {
                let data_active = $(this).val();
                let allRows = $('tr');
                let data0 = $('tr[data-active="0"]');
                let data1 = $('tr[data-active="1"]');
                let data2 = $('tr[data-active="2"]');
                if(data_active == 0)
                {
                    allRows.show();
                }
                if(data_active == 1)
                {
                    if($(row).data('active') == 0 || $(row).data('active') == 2)
                        allRows.hide();
                    else
                        data1.show();
                }
                if(data_active == 2)
                {
                    if($(row).data('active') == 0 || $(row).data('active') == 1)
                        allRows.hide();
                    else
                        data2.show();
                }
            });
        });
    </script>
@endsection
