<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\InviteMail;
use App\Models\Invite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class InviteController extends Controller
{
    public function accept(Request $request)
    {
        $invite = Invite::where('token', $request->token)->firstOrFail();

        abort_unless($invite->isPending(), 410, 'Convite expirado.');

        return Inertia::render('CreateAccount', [
            'invitation_token' => $invite->token,
            'email' => $invite->email,
            'role' => $invite->role,
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'invitations' => 'required|array|min:1',
            'invitations.*.email' => 'required|email',
            'invitations.*.role' => 'required|in:tenant,user,admin',
        ]);

        foreach ($request->invitations as $data) {
            $invite = Invite::create([
                'agency_id' => auth()->user()->agency_id,
                'email' => $data['email'],
                'role' => $data['role'],
                'token' => Str::random(64),
                'expires_at' => now()->addDays(7),
            ]);

            Mail::to($invite->email)->send(new InviteMail($invite));
        }

        return redirect()->back()->with('message', 'Convite enviado com sucesso!');
    }

    public function store(Request $request, string $token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        abort_unless($invite->isPending(), 410, 'Convite expirado.');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email' , Rule::in([$invite->email])] ,
            'telefone' => 'required|string',
            'document' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:tenant,user,admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $invite->email,
            'telefone' => $request->telefone,
            'document' => $request->document,
            'status' => 'active',
            'password' => Hash::make($request->password),
            'role' => $invite->role,
            'agency_id' => $invite->agency_id,
        ]);

        $invite->update(['status' => 'accepted']);

        Auth::login($user);

        return match ($invite->role) {
            'tenant' => redirect()->route('client.home'),
            'user' => redirect()->route('client.home'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('client.home')
        };
    }
}
