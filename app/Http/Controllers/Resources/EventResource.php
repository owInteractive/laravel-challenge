<?php


namespace App\Http\Controllers\Resources;


use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventResource extends Controller
{
    public function index()
    {
        return $this->tryCatch(function () {
            return Event::with('user')->paginate(6);
        });
    }

    public function show($id)
    {
        return $this->tryCatch(function () use ($id) {
            return Event::with('user')->find($id);
        });
    }

    public function store(Request $request)
    {
        return $this->tryCatch(function () use ($request) {
            return Event::create($request->all() + ['user_id' => 1]);
        }, new EventRequest());

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }
}