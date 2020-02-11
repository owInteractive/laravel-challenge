<?php


?>
@extends('layouts.app', ['activePage' => '', 'titlePage' => __('Events Management')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">{{__('Events')}}</h4>
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
                <div class="col-6 text-left">
                  <!--                  <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary">
                    <icons-image _ngcontent-ymk-c22="" _nghost-ymk-c19=""> <i _ngcontent-ymk-c19=""
                        class="material-icons icon-image-preview">calendar_view_day</i>
                    </icons-image>
                    <span _ngcontent-ymk-c22="" class="icon-item-title">
                      {{ __('My Events') }}</span>
                  </a>
                  <a href="{{ route('event.today') }}" class="btn btn-sm btn-primary">
                    <icons-image _ngcontent-ymk-c22="" _nghost-ymk-c19=""> <i _ngcontent-ymk-c19=""
                        class="material-icons icon-image-preview">calendar_today</i>
                    </icons-image>
                    <span _ngcontent-ymk-c22="" class="icon-item-title">
                      {{ __('Today') }}</span>
                  </a>
                  <a href="{{ route('event.five') }}" class="btn btn-sm btn-primary">
                    <icons-image _ngcontent-ymk-c22="" _nghost-ymk-c19=""> <i _ngcontent-ymk-c19=""
                        class="material-icons icon-image-preview">event</i>
                    </icons-image>
                    <span _ngcontent-ymk-c22="" class="icon-item-title">
                      {{ __('+ Five Days') }}</span>
                  </a>
                -->

                  <a href="{{ route('event.export') }}" class="btn btn-sm btn-primary">
                    <icons-image _ngcontent-ymk-c22="" _nghost-ymk-c19=""> <i _ngcontent-ymk-c19=""
                        class="material-icons icon-image-preview">import_export</i>
                    </icons-image>
                    <span _ngcontent-ymk-c22="" class="icon-item-title">
                      {{ __('Export') }}</span>
                  </a>

                  <!-- -->
                  <form action="{{ route('event.import') }}" id="frm-import" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <span class="btn btn-sm btn-primary btn-file">
                        <icons-image _ngcontent-ymk-c22="" _nghost-ymk-c19=""> <i _ngcontent-ymk-c19=""
                            class="material-icons icon-image-preview">import_export</i>
                        </icons-image>
                        <span class="fileinput-new">{{ __('Import CSV') }}</span>
                        <span class="fileinput-exists">{{ __('Import CSV') }}</span>
                        <input type="file" name="file" id="file-csv">
                      </span>
                      <span class="fileinput-filename"></span>
                      <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                        style="float: none">&times;</a>
                    </div>


                  </form>

                </div>
                <div class="col-6 text-right">
                  <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary">{{ __('Add event') }}</a>
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
                            style="width: 163px;" aria-label="Name: activate to sort column ascending">Title</th>
                          <th class="sorting_desc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 230px;" aria-label="Position: activate to sort column ascending"
                            aria-sort="descending">Description</th>
                          <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 125px;" aria-label="Office: activate to sort column ascending">Start at
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                            style="width: 125px;" aria-label="Age: activate to sort column ascending">End at</th>

                          <th class="disabled-sorting text-center sorting" tabindex="0" aria-controls="datatables"
                            rowspan="1" colspan="1" style="width: 191px;"
                            aria-label="Actions: activate to sort column ascending">Actions
                          </th>
                        </tr>
                      </thead>
                      <tfoot>
                        {{$events->links()}}
                      </tfoot>
                      <tbody>
                        <?php
                                              $i =0;
                                              ?>
                        @foreach ($events as $event)



                        <tr role="row" class="{{ $i % 2 == 1 ? "odd" : "even" }}">
                          <td class="" tabindex="0">{{$event->title}}</td>
                          <td class="sorting_1">{{$event->description}}</td>
                          <td>{{date('d/m/Y H:i:s',strtotime($event->start_at))}}</td>
                          <td>{{date('d/m/Y H:i:s',strtotime($event->end_at))}}</td>
                          <td class="td-actions text-center">
                            <form action="{{ route('event.destroy', $event) }}" method="post">
                              @csrf
                              @method('delete')
                              <?php 
                                switch (@$event->invites()->get()[0]->status) {
                                  case '0':
                                  $btInviteStatus = 'btn-warning';
                                  $desc = 'Invite has sended';
                                    break;
                                  
                                    case '1':
                                    $btInviteStatus = 'btn-success';
                                    $desc = 'RSVP successfully accepted';  
                                    break;

                                  default:
                                  $btInviteStatus = 'btn-default';
                                  $desc = 'Send Invite to your friends';
                                  
                                    break;
                                }

                              ?>
                              <a rel="tooltip" class="btn btn-link {{ $btInviteStatus  }} "
                              href="{{route('invite.index', $event)}} "
                              data-original-title=""
                              title="Show Invites ">
                              <i class="material-icons">event</i>
                              <div class="ripple-container"></div>
                            </a>
                              <a rel="tooltip" class="btn btn-link btn-default "
                                href="{{route('invite.create', $event)}} "
                                data-original-title=""
                                title="Send invite ">
                                <i class="material-icons">share</i>
                                <div class="ripple-container"></div>
                              </a>
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('event.edit', $event) }}"
                                data-original-title="" title="Edit event">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <button type="button" class="btn btn-danger btn-link" data-original-title=""
                                title="Delete this event"
                                onclick="confirm('{{ __("Are you sure you want to delete this event?") }}') ? this.parentElement.submit() : ''">
                                <i class="material-icons">close</i>
                                <div class="ripple-container"></div>
                              </button>
                            </form>

                          </td>
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
@push('js')
{{ Html::script('material/js/plugins/jquery.dataTables.min.js') }}
{{ Html::script('material/js/plugins/bootstrap-selectpicker.js') }}
{{ Html::script('material/js/plugins/bootstrap-datetimepicker.min.js') }}
{{ Html::script('js/events.js') }}
@endpush