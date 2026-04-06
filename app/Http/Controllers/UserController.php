<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function acceptUser(Request $request, User $user) {
        try {
            $user->status = 'active';
            $user->save();

            return redirect()->back()->with('message', 'Usuário ativo com sucesso!');
        } catch (Throwable $e) {
            throw new \Exception('Não foi possivel aceitar usuário: ' . $e->getMessage());
        }
    }

    public function getPendingUsers(Request $request) {
        $pendingUsers = User::where('status', 'pending')->with('agency')->get();

        return Inertia::render('Request', [
            'pendingUsers' => $pendingUsers
        ]);
    }
}
