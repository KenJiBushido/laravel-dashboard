<?php
namespace App\Exports;

use App\Members;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class InvoicesExport implements FromView {
//     public function view(): View
//     {
//         return view('excel', [
//             'members' => Members::all()
//         ]);
//     }
// }

class InvoicesExport implements FromCollection, WithHeadings {

    public function __construct($check, $search='', $from, $to){
        // dd($from);

        $this->check = $check;
        $this->search = $search;
        $this->from = $from;
        $this->to = $to;
    }

    public function collection(){

        if($this->check == ''){
            if(!empty($this->search)){

                return Members::search($this->search);

            }
            else if(!empty($this->from)){

                return Members::whereBetween('created_at', [$this->from, $this->to])
                            ->orwhere('created_at', 'like', '%' .$this->to. '%');

            }
            else{

                return Members::all();
            }
        }
        
        else{

            return Members::query()->whereIn('id' , $this->check);
        }
    }

    public function headings(): array {
        return [
            'ID',
            'Name',
            'surname',
            'email',
            'phone',
            'create_at',
            'update_at',
        ];
    }

}