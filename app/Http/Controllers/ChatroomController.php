<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageCreated;
use Illuminate\Http\Request;
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
            'messages' => Message::where(function (Builder $query) use ($id) {
                $query->where('from_id', Auth::user()->id)
                    ->where('to_id', $id);
            })->orWhere(function (Builder $query) use ($id) {
                $query->where('to_id', Auth::user()->id)
                    ->where('from_id', $id);
            })->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = Auth::user()->messages()->create([
            'to_id' => $id,
            'message' => $validated['message'],
        ]);

        broadcast(new MessageCreated($message))->toOthers();

        return redirect()->back();
    }
}
