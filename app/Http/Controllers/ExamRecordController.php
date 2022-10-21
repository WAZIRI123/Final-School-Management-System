<?php

namespace App\Http\Controllers;

use App\Models\ExamRecord;
use App\Http\Requests\StoreExamRecordRequest;
use App\Http\Requests\UpdateExamRecordRequest;

class ExamRecordController extends Controller
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
     * @param  \App\Http\Requests\StoreExamRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamRecord  $examRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ExamRecord $examRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamRecord  $examRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamRecord $examRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRecordRequest  $request
     * @param  \App\Models\ExamRecord  $examRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRecordRequest $request, ExamRecord $examRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamRecord  $examRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamRecord $examRecord)
    {
        //
    }
}
