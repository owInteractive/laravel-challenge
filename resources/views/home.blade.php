@extends('layouts.template')

@section('content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home Page</h1>
      </div>
    
      <!-- Content Row -->
      <div class="row">
    
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration: none;" href="{{ route('MyEvents',['id'=>Auth::user()->id,'search'=>' ']) }}">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Events</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$my}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar-check fa-2x  text-gray-300"></i>
                  
                </div>
              </div>
            </div>
          </div>
        </a>
        </div>
    
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration: none;" href="{{ route('ToDaysEvents',['search'=>' ']) }}">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today Events</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-certificate fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
        </div>
    
        <!-- Materiais Cadastrados -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration: none;" href="{{ route('5DaysEvents',['search'=>' ']) }}">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Events for the next 5 days </div>
                  <div class="row no-gutters align-items-center">
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$fivedays}}</div>
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
        </div>
    
        <!-- TODOS EVENT -->
        
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration: none;" href="{{route('event.index')}}">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">All Events</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$all}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div><a>
      </div>
      
@endsection
