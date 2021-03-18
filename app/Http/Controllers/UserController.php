<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('email', 'like', '%' . $query . '%')->get();

        return response()->json(UserResource::collection($users), Response::HTTP_OK);
    }

    public function create()
    {
        return view('register');
    }

    public function store(UserRegisterRequest $request)
    {
        $user = new User();
        $user->email = $request->input('email');

        if ($request->has('parent')) {
            $parentUser = User::where('email', $request->input('parent'))->first();
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

        return response()->json(null, Response::HTTP_OK);
    }
}
