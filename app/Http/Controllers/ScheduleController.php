<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        return view('schedule.index');
    }

    public function create(Request $request)
    {
        $item = new Schedule();
        $item->title = $request->title;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->description = $request->description;
        $item->color = $request->color;
        $item->save();

        return redirect('/');
    }


    public function getEvents()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function deleteEvent($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Event moved successfully']);
    }

    public function ucast(Request $request)
    {

        $matchThese = ['schedule_id' => $request->schedule_id, 'user_id' => $request->user_id];
        $text = "";

        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $text = "fail";

        }else{
            DB::table('schedule_user')->insert([
                'user_id' => $request->user_id,
                'schedule_id' => $request->schedule_id,
                'ucast' => $request->ucast
            ]);
            $text = "success";
        }

        $ucast = DB::table('schedule_user')->where('schedule_id', '=', $request->schedule_id)->get();

        foreach ($ucast as $u){
            $test[] = DB::table('users')->where('id','=', $u->user_id)->get();
        }

        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $already = true;
            $ucastnik = DB::table('schedule_user')->where($matchThese)->first();
        }else{
            $already = false;
            $ucastnik = "neni";
        }

        $details = DB::table('schedules')->where('id', '=', $request->schedule_id)->first();

        $userId = Auth::id();

        return view("event_detail")->with('schedule', $request->schedule_id)->with('details', $details)->with('userId', $userId)->with('ucast', $test)->with('text', $text)->with('already',$already)->with("ucastni", $ucast)->with('ucastnik', $ucastnik);
    }

    public function ucast_update(Request $request){
        $matchThese = ['schedule_id' => $request->schedule_id, 'user_id' => $request->user_id];
        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $update = array('ucast'=>$request->ucast);
            DB::table('schedule_user')->where($matchThese)->limit(1)->update($update);
            $ucastnik = DB::table('schedule_user')->where($matchThese)->first();
        }else{
            $ucastnik = "neni";
        }

        $text = "";

        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $text = "fail";
        }else{
            DB::table('schedule_user')->insert([
                'user_id' => $request->user_id,
                'schedule_id' => $request->schedule_id,
                'ucast' => $request->ucast
            ]);
            $text = "success";
        }

        $ucast = DB::table('schedule_user')->where('schedule_id', '=', $request->schedule_id)->get();

        foreach ($ucast as $u){
            $test[] = DB::table('users')->where('id','=', $u->user_id)->get();
        }

        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $already = true;
        }else{
            $already = false;
        }

        $details = DB::table('schedules')->where('id', '=', $request->schedule_id)->first();

        $userId = Auth::id();

        return view("event_detail")->with('schedule', $request->schedule_id)->with('details', $details)->with('userId', $userId)->with('ucast', $test)->with('text', $text)->with('already',$already)->with("ucastni", $ucast)->with('ucastnik', $ucastnik);
    }

    public function details($id)
    {

        $ucast = DB::table('schedule_user')->where('schedule_id', '=', $id)->get();

        foreach ($ucast as $u){
            $test[] = DB::table('users')->where('id','=', $u->user_id)->get();
        }

        if (empty($test)){
            $test = [];
        }

        $matchThese = ['schedule_id' => $id, 'user_id' => auth()->id()];
        if(DB::table('schedule_user')->where($matchThese)->exists()) {
            $already = true;
            $ucastnik = DB::table('schedule_user')->where($matchThese)->first();
        }else{
            $already = false;
            $ucastnik = "neni";
        }

        $details = DB::table('schedules')->where('id', '=', $id)->first();

        $userId = Auth::id();

        return view("event_detail")->with('details', $details)->with('userId', $userId)->with('ucast', $test)->with('already',$already)->with("ucastni", $ucast)->with('ucastnik', $ucastnik);
    }

    public function resize($eventId, Request $request)
    {
        // Validate the request data
        $request->validate([
            'end' => 'required|date'
        ]);

        // Find the event by ID
        $event = Schedule::findOrFail($eventId);

        // Update the event's end date
        $event->end = $request->input('end');
        $event->save();

        return response()->json(['message' => 'Event resized successfully.']);
    }

    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');

        $matchingEvents = Schedule::where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
}
