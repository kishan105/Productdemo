<?php

namespace App\Exports;

use App\Models\shop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class shopExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function headings(): array
    {
        return ['shop name','address','email','image'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return shop::select('shop_name','address','email','image')->get();
    }
}
