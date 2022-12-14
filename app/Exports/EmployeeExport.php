<?php

namespace App\Exports;

use App\Models\AppModelsEmployee;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct( $data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return collect($this->data);
    }

    public function headings():array {
        return [
            'Id',
            'First Name',
            'Last Name',
            'Email',
            'Address',
            'Full Name'
        ];
    }

}
