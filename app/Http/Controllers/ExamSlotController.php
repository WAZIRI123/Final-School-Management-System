<?php

namespace App\Http\Controllers;

use App\Models\ExamSlot;
use App\Http\Requests\StoreExamSlotRequest;
use App\Http\Requests\UpdateExamSlotRequest;

class ExamSlotController extends Controller
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
     * @param  \App\Http\Requests\StoreExamSlotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamSlotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamSlot  $examSlot
     * @return \Illuminate\Http\Response
     */
    public function show(ExamSlot $examSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamSlot  $examSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamSlot $examSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamSlotRequest  $request
     * @param  \App\Models\ExamSlot  $examSlot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamSlotRequest $request, ExamSlot $examSlot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamSlot  $examSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamSlot $examSlot)
    {
        //
    }
}
