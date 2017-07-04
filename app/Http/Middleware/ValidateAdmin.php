<?php 

namespace Preesco\Http\Middleware;
use Closure;
use Session;

/**
* 
*/
class ValidateAdmin {

	function __construct()
	{
		
	}

	public function handle($request, Closure $next)
    {
       if(Session('privilegios') == 2){
       	  return $next($request);
       }

       return redirect('home');
    }
}