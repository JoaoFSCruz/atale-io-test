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

        $childrenEmails = $request->input('children');
        $children = User::whereIn('email', $childrenEmails)->get();
        $validatedChildren = [];
        foreach ($children as $child) {
            if ($user->isChildOf($child)) {
                return response()->json([
                    'errors' => [ 'children' => [$child->email . ' is already your parent.'] ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validatedChildren[] = $child;
        }

        $user->save();
        foreach ($validatedChildren as $child) {
            $user->appendNode($child);
        }

        return response()->json(null, Response::HTTP_CREATED);
    }
}
