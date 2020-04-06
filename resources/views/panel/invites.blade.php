@extends('template.template')
@section('load_assets')
    <script src="{{url('js/events.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="display: contents">
                    <div class="" style="display: inline-block; margin-top: 30px;">
                        <div class="col-md-12" >
                            <div class="portlet-body form">
                                <form method="post" action="{{route('send_invite', ['id_event' => $event->id])}}">
                                    <div class="form-body">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Contact Name</label>
                                                    <input type="text" name="name" id="name" value="" class="form-control name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Contact Email</label>
                                                    <input type="email" name="email" id="email" value="" class="form-control email" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 btn-same-line">
                                                <button type="submit" class="btn btn-light" title="Send">
                                                    <i class="fas fa-paper-plane" style="padding-right: 5px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="invites-list" style="width: 100%; margin-top: 25px;">
                        <ul class="nav nav-tabs" id="invitesTab" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="invites-tab" data-toggle="tab" href="#invites" role="tab" aria-controls="invites" aria-selected="true">All</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="confirmedInvites-tab" data-toggle="tab" href="#confirmedInvites" role="tab" aria-controls="confirmedInvites" aria-selected="false">Confirmed</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="refusedInvites-tab" data-toggle="tab" href="#refusedInvites" role="tab" aria-controls="refusedInvites" aria-selected="false">Refused</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="invites" role="tabpanel" aria-labelledby="invites-tab">
                                <div class="portlet-body">
                                    <div class="table-div" style="margin-top: 30px;">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <caption>
                                                <span>Total: {{$invites->count()}}</span>
                                            </caption>
                                            <thead>
                                            <tr>
                                                <th class="text-center" width="">Code</th>
                                                <th class="text-center" width="">Name</th>
                                                <th class="text-center" width="">Email</th>
                                                <th class="text-center" width="">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $code = 1; ?>
                                            @foreach($invites as $invite)
                                                <tr>
                                                    <td class="text-center">{{ $code }}</td>
                                                    <td class="text-center">{{ $invite->name_contact }}</td>
                                                    <td class="text-center">{{ $invite->email }}</td>
                                                    <td class="text-center">{{ $invite->getStatus() }}</td>
                                                </tr>
                                                <?php $code++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="confirmedInvites" role="tabpanel" aria-labelledby="confirmedInvites-tab">
                                <div class="portlet-body">
                                    <div class="table-div" style="margin-top: 30px;">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <caption>
                                                <span>Total: {{$confirmedInvites->count()}}</span>
                                            </caption>
                                            <thead>
                                            <tr>
                                                <th class="text-center" width="">Code</th>
                                                <th class="text-center" width="">Name</th>
                                                <th class="text-center" width="">Email</th>
                                                <th class="text-center" width="">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $code = 1; ?>
                                            @foreach($confirmedInvites as $invite)
                                                <tr>
                                                    <td class="text-center">{{ $code }}</td>
                                                    <td class="text-center">{{ $invite->name_contact }}</td>
                                                    <td class="text-center">{{ $invite->email }}</td>
                                                    <td class="text-center">{{ $invite->getStatus() }}</td>
                                                </tr>
                                                <?php $code++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="refusedInvites" role="tabpanel" aria-labelledby="refusedInvites-tab">
                                <div class="portlet-body">
                                    <div class="table-div" style="margin-top: 30px;">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <caption>
                                                <span>Total: {{$refusedInvites->count()}}</span>
                                            </caption>
                                            <thead>
                                            <tr>
                                                <th class="text-center" width="">Code</th>
                                                <th class="text-center" width="">Name</th>
                                                <th class="text-center" width="">Email</th>
                                                <th class="text-center" width="">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $code = 1; ?>
                                            @foreach($refusedInvites as $invite)
                                                <tr>
                                                    <td class="text-center">{{ $code }}</td>
                                                    <td class="text-center">{{ $invite->name_contact }}</td>
                                                    <td class="text-center">{{ $invite->email }}</td>
                                                    <td class="text-center">{{ $invite->getStatus() }}</td>
                                                </tr>
                                                <?php $code++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection