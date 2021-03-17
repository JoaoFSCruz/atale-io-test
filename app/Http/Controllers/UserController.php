<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('query');

        $users = User::where('email', 'like', '%' . $query . '%')->get();

        return response()->json(UserResource::collection($users), Response::HTTP_OK);
    }

    public function store(Request $request) {

        $request->validate([
            'email' => 'required|unique:users|email:rfc,dns,filter',
            'parent' => 'nullable|email:rfc,dns,filter|exists:users,email',
            'children' => 'array',
            'children.*' => 'email:rfc,dns,filter|distinct|exists:users,email'
        ]);

        $user = new User();
        $user->email = $request->input('email');

        $parentEmail = $request->input('parent');
        if ($parentEmail) {
            $parentUser = User::where('email', $parentEmail)->first();
            $parentUser->appendNode($user);
        } else {
            $user->saveAsRoot();
        }

        $children = $request->input('children');
        foreach ($children as $childEmail) {
           $child = User::where('email', $childEmail)->first();
           $user->appendNode($child);
        }

        $user->save();

        $ascendants = count($user->ancestors);
        $descendants = count($user->descendants);

        return response()->json([ 'ascendants' => $ascendants, 'descendants' => $descendants], Response::HTTP_OK);
    }
}
