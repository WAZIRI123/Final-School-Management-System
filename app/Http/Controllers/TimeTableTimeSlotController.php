<?php

namespace App\Http\Controllers;

use App\Models\TimeTableTimeSlot;
use App\Http\Requests\StoreTimeTableTimeSlotRequest;
use App\Http\Requests\UpdateTimeTableTimeSlotRequest;

class TimeTableTimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTimeTableTimeSlotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeTableTimeSlotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeTableTimeSlot  $timeTableTimeSlot
     * @return \Illuminate\Http\Response
     */
    public function show(TimeTableTimeSlot $timeTableTimeSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeTableTimeSlot  $timeTableTimeSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeTableTimeSlot $timeTableTimeSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeTableTimeSlotRequest  $request
     * @param  \App\Models\TimeTableTimeSlot  $timeTableTimeSlot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeTableTimeSlotRequest $request, TimeTableTimeSlot $timeTableTimeSlot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeTableTimeSlot  $timeTableTimeSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeTableTimeSlot $timeTableTimeSlot)
    {
        //
    }
}
