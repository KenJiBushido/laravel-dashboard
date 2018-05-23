<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory as Load;

class ImportController extends Controller
{
    //
    public function import(Request $request){
        $inputFileName = $request->excel;
        $spreadsheet = Load::load($inputFileName);
        foreach ($spreadsheet->getWorksheetIterator() as $worksheetName) {
            $highestRow = $worksheetName->getHighestRow();
            for($row=2; $row<=$highestRow; $row++){
                $name = $worksheetName->getCellByColumnAndRow(1, $row);
                $surname = $worksheetName->getCellByColumnAndRow(2, $row);
                $email = $worksheetName->getCellByColumnAndRow(3, $row);
                $phone = $worksheetName->getCellByColumnAndRow(4, $row);

                $member = new Members;
                $member->name = $name;
                $member->surname = $surname;
                $member->email = $email;
                $member->phone = $phone;

                $member->save();

            }
            return redirect()->route('home.input');

        }
    }
}
