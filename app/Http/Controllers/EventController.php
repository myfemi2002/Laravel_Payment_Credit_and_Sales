<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class EventController extends Controller
{
    public function eventView(){
        $allData = Event::latest()->paginate(10);
        $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];
        return view(
            "backend.event.index",
            compact("allData", "colors")
        );
    } // End Method

    public function eventStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                "event_name" => "required|unique:events",
            ],
            [
                "event_name.required" =>
                    "Please input event name",
            ]
        );

        Event::insert([
            "event_name" => $request->event_name,
            "created_by" => Auth::user()->id,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Record added successfully",
            "alert-type" => "success",
        ];

        return back()->with($notification);
    } //End Method

    public function eventUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate(
            [
                "event_name" => "required|unique:events,event_name," . $id,
            ],
            [
                "event_name.required" => "Please input event name",
            ]
        );

        try {
            // Find the event name by ID
            $event = Event::findOrFail($id);

            // Update the fields with the new values
            $event->event_name = $request->event_name;
            $event->updated_by = Auth::user()->id;
            $event->updated_at = Carbon::now();

            // Save the updated fevent
            $event->save();

            $notification = [
                "message" => "Record updated successfully",
                "alert-type" => "success",
            ];
            return back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                "message" => "Failed to update record",
                "alert-type" => "error",
            ];
            return back()->with($notification);
        }
    } // End Method

    public function eventDelete($id)
    {
        // Delete from the Database
        Event::find($id)->delete();
        $notification = [
            "message" => "Deleted Successfully",
            "alert-type" => "success",
        ];
        return Redirect()
            ->route("event.view")
            ->with($notification);
    } // End Method
}
