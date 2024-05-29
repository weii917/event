<?php

namespace App\Http\Controllers\Api;


use App\Models\Event;
use App\Models\Attendee;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // 加入分頁
    // 透過Event $event呼叫attendees()方法建立查詢builder，latest()查詢最新
    // 查詢後結果$attendees做paginate()分頁
    public function index(Event $event)
    {
        //
        $attendees = $event->attendees()->latest();
        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    // 添加誰加入event，需要儲存
    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $event, Attendee $attendee)
    {
        $attendee->delete();
        return response(status: 204);
    }
}
