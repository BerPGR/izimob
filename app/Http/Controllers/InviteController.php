<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InviteMail;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class InviteController extends Controller
{
    public function accept(Request $request)
    {
        $invite = Invite::where('token', $request->token)->firstOrFail();

        abort_if($invite->isPending(), 410, 'Convite expirado.');

        return Inertia::render('CreateAccount', [
            'invitation_token' => $token,
            'email'            => $invite->email,
            'role'             => $invite->role,
        ]);
    }

    public function send(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:tenant,user',
        ]);

        $invite = Invite::create([
            'agency_id' => auth()->user()->agency_id,
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($invite->email)->send(new InviteMail($invite));

        return redirect()->back()->with('message', 'Convite enviado com sucesso!');
    }
}
