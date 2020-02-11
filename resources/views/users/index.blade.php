@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Users') }}</h4>
                <p class="card-category"> {{ __('Here you can manage users') }}</p>
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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                    <table id="datatables"
                    class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                    cellspacing="0" width="100%" style="width: 100%;" role="grid"
                    aria-describedby="datatables_info">
                    <thead class=" text-primary">
                      <th class="sorting" tabindex="0" aria-controls="datatables"
                        rowspan="1" colspan="1" style="width: 163px;"
                        aria-label="Name: activate to sort column ascending">{{ __('Name') }}</th>
                      <th class="sorting_desc" tabindex="0" aria-controls="datatables"
                        rowspan="1" colspan="1" style="width: 230px;"
                        aria-label="Position: activate to sort column ascending"
                        aria-sort="descending">{{ __('Email') }}</th>
                      <th class="sorting" tabindex="0" aria-controls="datatables"
                        rowspan="1" colspan="1" style="width: 125px;"
                        aria-label="Office: activate to sort column ascending"> {{ __('Creation date') }}
                      </th>
                      <th class="disabled-sorting text-center sorting" tabindex="0"
                      aria-controls="datatables" rowspan="1" colspan="1"
                      style="width: 191px;"
                      aria-label="Actions: activate to sort column ascending">{{ __('Actions') }}
                  </th>
                  
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>
                            {{ $user->name }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                          <td>
                            {{ $user->created_at->format('Y-m-d') }}
                          </td>
                          <td class="td-actions text-right">
                            @if ($user->id != auth()->id())
                              <form action="{{ route('user.destroy', $user) }}" method="post">
                                  @csrf
                                  @method('delete')
                              
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            @else
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      {{$users->links()}}
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection