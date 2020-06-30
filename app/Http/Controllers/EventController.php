<?php

namespace App\Http\Controllers;


use App\eventos;
use Illuminate\Http\Request;
use App\Http\Requests\crearDatosRequest;
use App\Exports\EventosExport;
use App\Imports\EventoImport;
use Maatwebsite\Excel\Facades\Excel;

use Hash;






class EventController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except('index','show');
  }
    
    public function index()
    {
        
        return view('Datos.index', [
          'editar'=> eventos::latest()->paginate(5)
        ]);
    }

    public function show(eventos $editar)
    {
        
        return view('Datos.show', [
          'editar'=> ($editar)
        ]);
            
    }

    public function create()
      {
        return view('Datos.crear', [
          'editar'=> new eventos
        ] );
      }

    public function store(crearDatosRequest $request)
    {
     
        eventos::create($request->validated());
  

      return redirect()->route('Datos.index');
    }

    public function edit(eventos $editar)
    {
      return view('Datos.edit', [
        'editar'=> $editar
      ]);
    }
    public function update(eventos $editar, crearDatosRequest $request)
    {
      $editar->update($request->validated());
       
      return redirect()->route('Datos.show', $editar);


    }
    public function destroy(eventos $editar)
    {
      eventos::destroy($editar);
      
      return redirect()->route('Datos.index');
    }
      
    
    public function export()
    {
      return Excel::download(new EventosExport, 'users.csv');
    }

    public function import(Request $request) 
    {
        $file=$request->file('file');
        Excel::import(new EventoImport, $file);
        
        return back()->whith('message', 'Impoortacion correcta');
    }



  }
  
  
