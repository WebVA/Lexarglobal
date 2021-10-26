<?php

namespace App\Exports;

use App\Models\Contactus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contactus::select('customer_name','company_name','industry_num','email1','email2','address1','address2','office_phone','mobile_phone','city','state','zip','comment','preffered_method','contact_date')->get();
    }

    public function headings(): array
    {
        return ['Customer Name','Company Name','Industry Number','eMail1','eMail2','Address1','Address2','Office Phone','Mobile Phone','City','State','Zip','Comment','Preffered  Method','Contact Date'];
    }
}
