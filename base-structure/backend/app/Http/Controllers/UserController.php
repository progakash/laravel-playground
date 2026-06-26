<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = [
            ['id' => 1, 'name' => 'Alice Johnson11', 'email' => 'alice@example.com', 'role' => 'Admin'],
            ['id' => 2, 'name' => 'Bob Smith',     'email' => 'bob@example.com',   'role' => 'Editor'],
            ['id' => 3, 'name' => 'Carol White',   'email' => 'carol@example.com', 'role' => 'Viewer'],
            ['id' => 4, 'name' => 'David Brown',   'email' => 'david@example.com', 'role' => 'Editor'],
            ['id' => 5, 'name' => 'Eva Martinez',  'email' => 'eva@example.com',   'role' => 'Admin'],
        ];

        return response()->json([
            'data' => $users,
        ]);
    }
}
