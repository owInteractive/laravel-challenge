@extends('adminlte::page')

@section('title', 'Import data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Importar Eventos</h3>
            </div>
            <div class="card-body">
                <div class="panel panel-default">
    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('events.importEvents') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">Escolha o Arquivo para importar</label>

                            <a href="{{asset('import_file_example.csv')}}"> Ver arquivo de exemplo de importação </a>
    
                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>
    
                                </div>
                            </div>
    
    
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Importar CSV
                                    </button>
                                     <a href="/events" >Voltar para Eventos</a>
                                </div>
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection 