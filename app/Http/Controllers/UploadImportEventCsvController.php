<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\UploadEventRequest;
use \App\Models\Event;

class UploadImportEventCsvController extends Controller
{
    public function upload(UploadEventRequest $request)
    {

         $path = $request->file('upload')->getRealPath();
         $data = array_map('str_getcsv', file($path));
         $csv_data = array_slice($data, 1, count($data));
         $returnData = array(); 
         $userId  =  auth()->user()->id;
         //dd($csv_data);
         foreach ($csv_data as $index=> $data) {
          
  
          if($data[0]){
            $newData = explode(';',$data[0]);
            Event::create(['title'=>$newData[0],
                            'description'=>$newData[1],
                            'event_start'=>$newData[2],
                            'event_end'=>$newData[3],
                            'user_id'=> $userId]
                          );
            $returnData [] = $newData;

          }
           
          
         }

         return response()->json(
           [
             'records'=>$returnData
           ]
          );

    }
}
