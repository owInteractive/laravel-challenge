<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\Event;
class EventController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), EventController::rules(), EventController::messages());
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }   

        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $combinedDTBegin = date('Y-m-d H:i:s', strtotime("$request->beginDate $request->beginTime"));
        $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->endDate $request->endTime"));
        $event->start = $combinedDTBegin;
        $event->end = $combinedDTEnd;
        $event->users_id = Auth::id();       
        $event->save();
        return redirect()->back()->with('message', 'Sucesso ao cadastrar entrada!');

    }
    public function rules(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'beginDate' => 'required|date',
            'beginTime' => 'required|date_format:H:i',
            'endDate' => 'required|date|after:beginDate',
            'endTime' => 'required|date_format:H:i'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Insert a title!',
            'title.max' => 'Insira título com no máximo xxx!',
            'description.required' => 'Insert a title!',
            'description.max' => 'Insira título com no máximo xxx!',
            'beginDate.required' => 'Insira Data de inicio!',
            'beginDate.date' => 'Insira data válida!',
            'beginTime.required' => 'Insira hora de inicio!',
            'beginTime.date_format' => 'Insira hora válida!',
            'endDate.required' => 'Insira Data de fim!',
            'endDate.date' => 'Insira data válida!',
            'endDate.after' => 'Insira data final posterior a data de inicio!',
            'endTime.required' => 'Insira hora de fim!',
            'endTime.date_format' => 'Insira hora válida no fim!'            
        ];
    }   
}
