<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ChatroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Chatroom', [
            'contacts' => User::where('id', '!=', Auth::user()->id)->select('id', 'name')
                ->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return Inertia::render('Chatroom', [
            'contacts' => User::where('id', '!=', Auth::user()->id)->select('id', 'name')
                ->get(),
            'chat_id' => (int) $id,
            'messages' => 'Messages',
        ]);
    }
}
