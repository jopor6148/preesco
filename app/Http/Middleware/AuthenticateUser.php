<?php 

namespace Preesco\Http\Middleware;
use Closure;
use Session;

/**
* 
*/
class AuthenticateUser
{
	
	function __construct()
	{
		
	}

	public function handle($request, Closure $next)
    {
       if(Session:: has('idUsuario')){
       	  return $next($request);
       }

       return redirect('/login');
    }
}