<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        $event = Event::create(array_merge($validatedData, ['user_id' => 1]));

        return $event;
        // $event = Event::create([
        //     // 數據做驗證
        //     'user_id' => 1,
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'nullable|string',
        //         'start_time' => 'required|date',
        //         'end_time' => 'required|date|after:start_time'
        //     ])

        // ]);

        // return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // 
        return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return response(status: 204);
    }
}
