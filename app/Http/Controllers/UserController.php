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

        if ($request->filled('parent')) {
            $parentUser = User::where('email', $request->input('parent'))->first();
            $user->appendToNode($parentUser);
        } else {
            $user->makeRoot();
        }

        $children = $request->input('children');
        foreach ($children as $childEmail) {
            $child = User::where('email', $childEmail)->first();

            if ($user->isChildOf($child)) {
                return response()->json([
                    'errors' => [ 'children' => [$childEmail . ' is already your parent.'] ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $child->appendToNode($user);
        }

        $user->save();

        return response()->json(null, Response::HTTP_CREATED);
    }
}
