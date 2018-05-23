<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory as Load;

class PDFController extends Controller
{
    //
    public function memberExpdf(){

        $members = Members::all();
        $pdf = PDF::loadView('pdf', ['members'=>$members]);
        return @$pdf->stream();

    }

    public function import(Request $request){
        // $inputFileName = public_path('test.xlsx');
        $inputFileName = $request->excel;
        // dd($inputFileName);
        $spreadsheet = Load::load($inputFileName);
        foreach ($spreadsheet->getWorksheetIterator() as $worksheetName) {
            $highestRow = $worksheetName->getHighestRow();
            for($row=2; $row<=$highestRow; $row++){
                $name = $worksheetName->getCellByColumnAndRow(1, $row);
                $surname = $worksheetName->getCellByColumnAndRow(2, $row);
                $email = $worksheetName->getCellByColumnAndRow(3, $row);
                $phone = $worksheetName->getCellByColumnAndRow(4, $row);
                // echo $name." ";
                // echo $surname." ";
                // echo $email." ";
                // echo $phone."<br>";
                // echo $worksheetName->getCellByColumnAndRow(4, 12);

                $member = new Members;
                $member->name = $name;
                $member->surname = $surname;
                $member->email = $email;
                $member->phone = $phone;

                $member->save();
    
            }

        }

    }
}
