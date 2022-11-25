<?php

namespace App\Http\Livewire\Dashboard\Exam\Result;

use App\Services\Print\PrintService;
use Livewire\Component;

class ResultPdf extends Component
{
    public $semester1_result;
    public $semester2_result;

    protected $listeners = ['pdfDataEvent'];


    public function pdfDataEvent($r1, $r2)
    {
        $this->semester1_result = $r1;
        $this->semester2_result = $r2;
        $data = [
            'r1' => $r1,
            'r2' => $r2
        ];
        return PrintService::createPdfFromView('data.pdf', 'livewire.dashboard.exam.result.result-pdf', $data);
    }

    public function render()
    {
        return view('livewire.dashboard.exam.result.result-pdf')->layoutData(['title' => 'Manage Exam Record | School Management System']);
    }
}
