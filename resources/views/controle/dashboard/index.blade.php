@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('controle.event.index') }}">Events</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Events</h1>
    <!-- end page-header -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-green-lighter">
                <div class="stats-icon"><i class="fa fa-clock"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS TODAY</h4>
                    <p>{{ $eventsToday->count() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="{{ route('controle.event.today') }}">View List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-blue-lighter">
                <div class="stats-icon"><i class="fa fa-calendar"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS IN 5 DAYS</h4>
                    <p>{{ $eventsNextDays->count() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="{{ route('controle.event.nextDays') }}">View List</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-grey-lighter">
                <div class="stats-icon"><i class="fa fa-calendar"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS</h4>
                    <p>{{ $events->count() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="vertical-box calendar">

    </div>
    
@stop


@section('styles')
<link rel="stylesheet" href="/admin/css/vendor.css">
@endsection

@section('scripts')
<script src="/admin/js/vendor.js"></script>

<script>
    startCalendar();

    function startCalendar() {
        if($('.calendar').length > 0){
            $('.calendar').fullCalendar({
                businessHours: {
                    // days of week. an array of zero-based day of week integers (0=Sunday)
                    // dow: [ 1, 2, 3, 4, 5 ], // Monday - Thursday
                },
                header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                themeSystem: 'bootstrap4',
                contentHeight: 500,
                loading : function(isLoading, view){
                    if(isLoading == true){
                        $('.overlay').show();
                    }else{
                        $('.overlay').hide();
                    }
                },
                {{-- 

                events: function (start, end, timezone, callback) {
                    var moment = $('.calendar').fullCalendar('getDate');
                    var url = '/controle/agendamento-salas/carrega-reservas';
                    $.ajax({
                        url: url,
                        data: { 
                            start: start.format("YYYY-MM-DD"), 
                            end: end.format("YYYY-MM-DD"),
                            sala_id : $('.sala option:selected').val()
                        },
                        type: "GET",
                        dataType: "json",
                        success: function (json) {
                            $('.overlay').hide();
                            callback(json);
                        }
                    });
                },
                eventClick: function(calEvent, jsEvent, view) {
                    var url = '/controle/agendamento-salas/carrega-reserva';
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            id: calEvent.id
                        },
                        dataType: "json",
                        success: function (response) {
                            montarReserva(response);
                        }
                    });
                    $(this).css('border-color', 'red');
                }
                --}}
            });
        }
        
    }
        
</script>
@endsection