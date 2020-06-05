<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class APIToken
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
        $token = $request->header('Authorization');
        
        if ( strlen($token) ) {
            $user = User::where('api_token', $token)->first();
            if ($user) {
				\Auth::login($user);
				$request->user_id = $user->id;
                return $next($request);
            } else {
                return response()->json(['message' => __('user not found')], 401);
            }
        } else {
            return response()->json(['message' => __('unauthenticated')], 401);
        }

    }
}
