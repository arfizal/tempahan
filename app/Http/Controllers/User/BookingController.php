<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Room;
use App\Models\Booking;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::User();
        $rooms = Room::where('status',1)->orderBy('name','ASC')->get();
        $bookings = Booking::where('user_id', $user->id)->orderBy('booking_date','ASC')->get();
        return view('user.room_index', compact('rooms','bookings'));
    }

    public function booking($id)
    {
        $room = Room::find($id);
        $user = Auth::User();
        return view('user.room_booking', compact('room','user'));

    }

    public function bookingPost(Request $request, $id)
    {
        $this->validate($request, [
            'booking_date' => 'required|date_format:Y-m-d',
        ]);

        $user = Auth::User();
        $room = Room::find($id);
        $booking = new Booking;

        if ($room){
            $booking->user_id = $user->id;
            $booking->room_id = $room->id;
            $booking->booking_date = $request['booking_date'];
            $booking->remark = '';
            $booking->save();

            return redirect()->route('user.room.index');
        }

    }

    public function bookingCancel($id)
    {
        $user = Auth::User();
        //$booking = Booking::find($id);
        $booking = Booking::where('user_id', $user_id)->where('id',$id)->first();

        $booking->delete();

        return redirect()->route('user.room.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
