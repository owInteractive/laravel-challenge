@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-title">
        <span class="page-title-text text-primary">{{$data['title']}}</span>
    </div>
    <div class="row">
        @foreach ($data['data'] as $item)
            <div onClick="show('/event/{{\Crypt::encryptString($item['id'])}}/edit', '_blank')" class="col-xs-12 col-md-4" style="padding-right:5px;">
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function show(id) {
        $.ajax({
            method: 'GET',
            url: `/show/${id}`,
            success: function() {

            },
            error: function() {

            }
        })
        $("#modal-show").modal('toggle');
    }
</script>
@endsection

