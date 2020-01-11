<?php

namespace App\Http\Middleware;

use App\Event;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class ParticipantMiddleware
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $eventId = $request->segments()[1];
        $event = Event::find($eventId);

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        if ($event->participants()->find($this->auth->getUser()->id) === null) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        return $next($request);

    }

}
