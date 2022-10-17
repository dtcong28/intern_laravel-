<?php

namespace App\Exports;

use App\Models\AppModelsEmployee;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repository\Eloquent\EmployeeRepository;

class EmployeeExport implements FromCollection
{
    protected $employeeRepository;

//    public function __construct(EmployeeRepository $employeeRepository)
//    {
//        $this->employeeRepository = $employeeRepository;
//    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        $result = $this->employeeRepository->getAll();
//        return collect($result);
    }

    public function heading():array {
        return [
            'id',
            'email',
        ];
    }
}
