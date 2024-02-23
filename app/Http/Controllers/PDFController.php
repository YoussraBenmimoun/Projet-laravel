<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;



class PDFController extends Controller
{
    public function generatePDF()
    {
        $visits = Visit::all(); 
        $visitsCount = Visit::count(); 

        
        $pdf = Pdf::loadView('pdf.visits', compact('visits','visitsCount'));

        return $pdf->download('rapport.pdf');
    }
}
