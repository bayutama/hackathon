<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Event;
class Mainmid
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $slug = urldecode( $request->segment(1) );
	   if($slug){
			$event = Event::whereSlug($slug)->first();
			$event_id = @$event->id;
			
			$request->attributes->add(['event_id' => $event_id]);
		}
		return $next($request);
    }
}
