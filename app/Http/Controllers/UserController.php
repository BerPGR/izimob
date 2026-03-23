<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function acceptUser(Request $request, int $userId) {
        try {
            $user = User::findOrFail($userId);

            $user->status = 'active';
            $user->save();

            return $user;
        } catch (Throwable $e) {
            throw new \Exception('Não foi possivel aceitar usuário: ' . $e->getMessage());
        }
    }

    public function getPendingUsers(Request $request) {
        $pendingUsers = User::where('status', 'active')->get();

        dd($pendingUsers->all());
    }
}
