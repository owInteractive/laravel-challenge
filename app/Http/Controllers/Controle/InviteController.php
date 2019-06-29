<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;

class InviteController extends Controller
{
 
    public function accept($token)
    {

        $invite = Invitation::whereToken($token)->first();
        if (!isset($invite->id)) {
            return view('error-invite');
        }
        //  dd($invite);
        return view('accept-invite');
       
    }

    public function destroy($id)
    {
        try {
            $event = Event::proprietario()->find($id);

            if (!isset($event->id)) {
                return redirect()->route('controle.event.index')->with('msg', 'não foi possível excluir o registro!')->with('error', true);
            }

            $event->delete();

            return redirect()->route('controle.event.index')->with('msg', 'registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('controle.event.index')->with('msg', 'não foi possível excluir o registro!')->with('error', true);
        }
    }
}
