<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {        
        
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');

        $user = Auth::user();

        if(empty($roles)) $roles = ['Member'];

        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->role === $role)
                return $next($request);            
        }
        return redirect()->back()->with(['message'=>'You don\'t have the permission to visit the clicked link']);
        // return redirect('/');
        
        
    }
}
