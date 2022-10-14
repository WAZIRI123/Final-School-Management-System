<?php

namespace App\Http\Controllers;

use App\Models\WeekDay;
use App\Http\Requests\StoreWeekDayRequest;
use App\Http\Requests\UpdateWeekDayRequest;

class WeekDayController extends Controller
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
     * @param  \App\Http\Requests\StoreWeekDayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeekDayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function show(WeekDay $weekDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function edit(WeekDay $weekDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeekDayRequest  $request
     * @param  \App\Models\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeekDayRequest $request, WeekDay $weekDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeekDay $weekDay)
    {
        //
    }
}
