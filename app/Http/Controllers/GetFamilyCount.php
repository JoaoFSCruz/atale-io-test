<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\GetFamilyCountRequest;

class GetFamilyCount extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\GetFamilyCountRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(GetFamilyCountRequest $request)
    {
        $user = User::where('email', $request->input('email'))->firstOrFail();

        $ascendants = count($user->ancestors);
        $descendants = count($user->descendants);

        return response()->json([ 'ascendants' => $ascendants, 'descendants' => $descendants], Response::HTTP_OK);
    }
}
