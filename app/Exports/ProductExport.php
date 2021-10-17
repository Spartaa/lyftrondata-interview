<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, ShouldQueue ,WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return ['Id','Title','Description','Price'];
    }
    public function query()
    {
        return Product::query()->select('id','title','description','price');
    }
}
