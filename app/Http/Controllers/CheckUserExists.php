<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUserExists extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $request->validate([
           'email' => 'required|email:rfc,dns,filter'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $ascendants = count($user->ancestors);
        $descendants = count($user->descendants);

        return response()->json([ 'ascendants' => $ascendants, 'descendants' => $descendants], Response::HTTP_OK);
    }
}
