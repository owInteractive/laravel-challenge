@extends('layouts.app', ['activePage' => 'invite', 'titlePage' => __('Invites')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">card_giftcard</i>
            </div>
            <h4 class="card-title">{{__('Invites of Event ' . $event->title )}}</h4>
          </div>
          <div class="card-body">
            @if (session('status'))
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                  </button>
                  <span>{{ session('status') }}</span>
                </div>
              </div>
            </div>
            @endif
            <div class="toolbar">
              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('invite.create',$event) }}" class="btn btn-sm btn-primary">{{ __('Add invite') }}</a>
                </div>
              </div>
            </div>
            <div class="material-datatables">
              <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="datatables"
                      class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
                      width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                      <thead class=" text-primary">
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 163px;" aria-label="Name: activate to sort column ascending">Event Title</th>
                          <th class="sorting_desc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 230px;" aria-label="Position: activate to sort column ascending"
                            aria-sort="descending">Inviteded</th>
                          <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 125px;" aria-label="Office: activate to sort column ascending">Email
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 125px;" aria-label="Age: activate to sort column ascending">Sended at</th>

                          <th class="disabled-sorting text-center sorting" tabindex="0" aria-controls="datatables"
                            rowspan="1" colspan="1" style="width: 191px;"
                            aria-label="Actions: activate to sort column ascending">Accepted at
                          </th>
                        </tr>
                      </thead>
                      <tfoot>
                        {{$invites->links()}}
                      </tfoot>
                      <tbody>
                        <?php
                          $i =0;
                        ?>
                       
                        @foreach ($invites as $invite)

                        <?php 
                        switch ($invite->status) {
                          case '0':
                          $btInviteStatus = 'table-warning';
                          $msg = "Invite sended";
                            break;
                          
                            case '1':
                            $btInviteStatus = 'table-success';
                            $msg = "Invite accepted";
                            break;

                          default:
                          $btInviteStatus = '';$msg = '';
                            break;
                        }

                        ?>

                      <tr rel="tooltip" title="{{$msg}}" role="row" class="{{ $i % 2 == 1 ? "odd" : "even" }} {{ $btInviteStatus }}">
                          <td class="" tabindex="0">{{$event->title}}</td>
                          <td class="sorting_1">{{$invite->name}}</td>
                        <td>{{$invite->email}}</td>
                        <td>{{date('d/m/Y H:i:s',strtotime($invite->sended_at))}}</td>
                        <td>{{$invite->accepted_at == null ? '' : date('d/m/Y H:i:s',strtotime($invite->accepted_at ))}}</td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>

                  </div>
                </div>


              </div>

            </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
  </div>
</div>
@endsection
