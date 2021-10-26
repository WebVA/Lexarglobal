<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('firstname','lastname','created','email','mobile_phone','zip','state')->get();
    }

    public function headings(): array
    {
        return ["FirstName", "LastName", "Registered Date", "Email", "Mobile Phone", "Zip", "State"];
    }
}
