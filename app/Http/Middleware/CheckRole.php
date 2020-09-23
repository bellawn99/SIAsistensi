<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = $request->user();
        $user = Auth::user();

        if($user){
            if($user->role_id=='1'){
               return redirect('/admin/dashboard');
            }
            else if($user->role_id=='2'){
               return redirect('/mahasiswa/dashboard');
            }else if($user->role_id=='3'){
                return redirect('/superadmin/dashboard');
            }
        }
		return $next($request);
        //return back()->with('error', 'Access Denied');
    }
}
