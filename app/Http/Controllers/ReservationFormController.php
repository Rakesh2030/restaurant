<?php

namespace App\Http\Controllers;

use App\Models\ReservationFormModel;
use Illuminate\Http\Request;

class ReservationFormController extends Controller
{
    //
    public function reservationFormStore(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        $validated['datetime'] = $validated['date'] . ' ' . $validated['time'];
        $validated['people'] = $validated['guests'];
        $validated['message'] = $validated['message'] ?? '';
        $validated['status'] = 'pending';

        ReservationFormModel::create($validated);

        return back()->with('success','Reservation booked successfully');
    }
    public function index(){
        $reservations = ReservationFormModel::latest()->get();
        return view('admin.reservationForm.index',compact('reservations'));
    }

    public function updateStatus($id, $status)
    {
        if (!in_array($status, ['confirmed', 'cancelled'])) {
            return back()->with('error', 'Invalid reservation status');
        }

        $reservation = ReservationFormModel::findOrFail($id);
        $reservation->status = $status;
        $reservation->save();

        return back()->with('success', 'Reservation status updated successfully');
    }
}
