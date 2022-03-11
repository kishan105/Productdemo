<?php

namespace App\Exports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class productExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function headings(): array
    {
        return ['product name','price','stock','shop_id','video'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return product::select('product_name','price','stock','shop_id','video')->get();
    }
}
