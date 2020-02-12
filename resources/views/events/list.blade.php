@extends('layouts.app')

@section('content')

<input type="hidden" id="event_id" value="{{(isset($_GET['event'])) ? $_GET['event'] : ''}}">

<div class="container">
    <div class="page-title">
        <span class="page-title-text text-primary">{{$data['title']}}</span>
    </div>
    <div class="row">
        @foreach ($data['data'] as $item)
            <div onClick="show('{{\Crypt::encryptString($item['id'])}}', '_blank')" class="col-xs-12 col-md-4" style="padding-right:5px; cursor:pointer">
                <div class="event-item">
                    <div class="datetime datetime-left">
                        <span class="text-small">{{date('M', strtotime($item['start_date']))}}</span><br>
                        <span class="text-large text-primary">{{date('d', strtotime($item['start_date']))}}</span><br>
                        <span class="text-small">{{date('Y', strtotime($item['start_date']))}}</span>
                    </div>
                    <div class="description">
                        <span class="title text-primary">{{$item['title']}}</span>
                        <div class="icons">
                            <div title="Confirmed" class="icon">
                                <i class="fa fa-check"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][2]) ? $data['feedbacks'][$item['id']][2] : 0}}</span>
                            </div>
                            <div title="Interested" class="icon" style="padding-left: 30%;">
                                <i class="fa fa-question"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][1]) ? $data['feedbacks'][$item['id']][1] : 0}}</span>
                            </div>
                            <div title="Denied" class="icon" style="padding-left: 30%;">
                                <i class="fa fa-times"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][3]) ? $data['feedbacks'][$item['id']][3] : 0}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($data['paginate'])
            <div class="row">
                <div class="col-xs-12">
                    <center>{{$data['data']->render()}}</center>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="modal-show">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <span class="title text-primary" style="font-size: 4rem">Title</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12" style="text-align: justify">
                        <span class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. In tempore nesciunt aliquam reiciendis ipsum rem labore ad, iure esse veniam dolores exercitationem quaerat. Doloremque libero nemo ducimus pariatur, distinctio debitis?
                        Voluptatum, odit unde nesciunt atque cupiditate esse dicta, dolore minima fugiat eum, voluptatem animi iure sunt sapiente amet architecto commodi nostrum doloribus reprehenderit officiis! Eum nesciunt possimus ipsum eligendi exercitationem?
                        Aut quasi eius officia! Iusto quod voluptate dolores fugiat quasi aliquid velit! Doloremque, hic dolor consectetur nisi, praesentium aperiam, debitis illum quasi impedit ratione adipisci perferendis deserunt quaerat qui quos.
                        Doloremque assumenda eum amet eius similique, vitae iste qui architecto, fugit quos illum cupiditate, veniam repellendus ut aperiam voluptatibus fugiat libero quisquam quam deleniti molestias harum. A magnam tempora magni.
                        Quam veniam, ad ipsam recusandae harum autem vero vel libero, voluptates, quas odio incidunt tempora ducimus sint adipisci soluta optio sit ex doloremque molestias? Reiciendis nobis voluptates incidunt magni corporis?
                        Repellat provident nulla ducimus ipsum impedit aspernatur ab! Cupiditate earum repellendus nulla. Dolorem eveniet eum totam illo quis dignissimos est iure debitis ipsum itaque nesciunt, id impedit quae dolor veritatis?
                        Qui quia excepturi iusto voluptatum labore voluptate nostrum dolorum quaerat in delectus obcaecati culpa placeat adipisci provident, aut atque vero. Culpa sunt molestias voluptatibus? Autem totam reiciendis veniam cum exercitationem?
                        Cum sapiente eos quisquam perferendis, incidunt nesciunt dolorum laudantium sequi explicabo impedit eligendi similique ipsa delectus fuga dignissimos illo pariatur ea facere ut? Facilis ducimus nostrum expedita officia vitae quo!
                        Dolore autem natus iusto magnam numquam nemo minima soluta. Omnis error autem veritatis, quos sit alias reprehenderit sunt odit accusantium blanditiis necessitatibus? Dicta nesciunt praesentium accusantium sit id eum placeat!
                        Tenetur, exercitationem! Cumque officia aperiam quas! Consectetur est suscipit facilis molestiae quos. Autem et possimus quos dolorum at maxime aspernatur enim incidunt sint quod debitis ut consequuntur, rem officia deserunt.</span>
                    </div>
                </div>
                <div class="row" style="margin: 25px 0">
                    <div class="col-xs-12 col-md-4">
                        <span style="font-weight:bolder; font-size: 3rem; font-style: italic">Starts on</span><Br>
                        <span class="start_date" style="font-size: 2rem">21/12/1999 08:00:00</span>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="teste" style="text-align: center; float: left">
                            <span class="going" style="font-size: 3rem; font-weight: bolder">21</span><br>
                            <span style="font-size: 2rem">going</span>
                        </div>
                        <div class="teste" style="text-align: center; float: left; margin-left: 17%">
                            <span class="interested" style="font-size: 3rem; font-weight: bolder">21</span><br>
                            <span style="font-size: 2rem">interested</span>
                        </div>
                        <div class="teste" style="text-align: center; float: left; margin-left: 11%">
                            <span class="denied" style="font-size: 3rem; font-weight: bolder">21</span><br>
                            <span style="font-size: 2rem">denied</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 pull-right" style="text-align:right">
                        <span style="font-weight:bolder; font-size: 3rem; font-style: italic">Finishes on</span><Br>
                        <span class="finish_date" style="font-size: 2rem">21/12/1999 08:00:00</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <input type="search" id="email" placeholder="First... we need your email" class="form-control">
                            <span class="input-group-btn">
                                <button onClick="confirm(2)" class="btn btn-flat btn-primary" type="button">I'm going!</button>
                                <button onClick="confirm(1)" class="btn btn-flat btn-warning" type="button">I'm interested!</button>
                                <button onClick="confirm(3)" class="btn btn-flat btn-danger" type="button">I'm not going!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    let id_event = "";

    $(document).ready(function() {
        let event = $("#event_id").val();

        if(event.length > 0) show(event);
    })

    function show(id) {
        $.ajax({
            method: 'GET',
            url: `show/${id}`,
            success: function(response) {
                console.log(response);
                id_event = id;

                $("#modal-show .title").html(response.event.title);
                $("#modal-show .description").html(response.event.description);
                
                let start_full = response.event.start_date;
                let start_split = start_full.split(" ");
                let start_date = start_split[0].split("-");
                let start_time = start_split[1].split(":");

                let finish_full = response.event.finish_date;
                let finish_split = finish_full.split(" ");
                let finish_date = finish_split[0].split("-");
                let finish_time = finish_split[1].split(":");

                $("#modal-show .start_date").html(`${start_date[1]}/${start_date[2]}/${start_date[0]} ${start_time[0]}:${start_time[1]}`).mask("99/99/9999 99:99");
                $("#modal-show .finish_date").html(`${finish_date[1]}/${finish_date[2]}/${finish_date[0]} ${finish_time[0]}:${finish_time[1]}`).mask("99/99/9999 99:99");
                $("#modal-show .going").html('0');
                $("#modal-show .interested").html('0');
                $("#modal-show .denied").html('0');

                if(response.feedbacks.length > 0) {
                    for(let f in response.feedbacks) {
                        if(response.feedbacks[f].status == 2) $("#modal-show .going").html(response.feedbacks[f].amount);
                        else if(response.feedbacks[f].status == 1) $("#modal-show .interested").html(response.feedbacks[f].amount);
                        else $("#modal-show .denied").html(response.feedbacks[f].amount);
                    }
                }
                $("#modal-show").modal('toggle');
            }
        })
    }

    function confirm(invite_status){
        let email = $("#email").val();
        let id = id_event;

        $.ajax({
            method: 'POST',
            url: 'invite/send',
            data: {
                event_id: id,
                status: invite_status,
                email: email
            },
            success: function(response) {
                $("#email").removeClass('input-error');
                toastr['success']('Thanks for your feedback!');
                setTimeout(window.open('/event_list/all', '_self'),3000);
            },
            error: function(response) {
                $("#email").removeClass('input-error');
                for(let i in response.responseJSON.errors) {
                    $("#"+i).addClass('input-error');
                    toastr['error'](`${response.responseJSON.errors[i]}`)
                }
            }
        })
    }
</script>
@endsection

