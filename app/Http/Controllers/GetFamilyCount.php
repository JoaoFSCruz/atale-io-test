<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\GetFamilyCountRequest;

class GetFamilyCount extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\GetFamilyCountRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function __invoke(GetFamilyCountRequest $request)
    {
        $user = User::where('email', $request->input('email'))->firstOrFail();

        $ascendants = count($user->ancestors);
        $descendants = count($user->descendants);

        return view('results', compact('ascendants', 'descendants'));
    }
}
