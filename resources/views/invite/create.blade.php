<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
</head>
<body>    
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="col-md-12">
            <h4>Take Part</h4>
            <div>
                <p>Information about event</p>
                <p><b>Name: </b> {{$event->title}} <p>    
                <p><b>Event description:</b> {{$event->description}} <p>        
            </div> 
            <h6>Informe your data</h6>  
            <form action="{{ route('invite.store') }}" method="POST">
                <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                      <label for="title">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Gustavo"  required>
                </div>
                <div class="form-group">
                    <label for="title">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ex: guga@gmail.com"  required>
               </div>
                <div class="form-group">
                    <label for="description">Cellphone</label>
                    <input type="tel" class="form-control" id="cellphone" name="cellphone" placeholder="Ex: (16) 99255-0026" pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})" required>
                    <small>Format: (00) 9900-0000</small>
                </div>               
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</body>
</html>