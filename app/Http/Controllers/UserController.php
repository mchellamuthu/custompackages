<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request) :JsonResponse
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->paginate(100)->appends(request()->query());

        return response()->json($users);
    }

    public function show(int $id) :JsonResponse
    {
        $user = QueryBuilder::for(User::where('id', $id))->firstOrFail();

        return response()->json($user);
    }
}
