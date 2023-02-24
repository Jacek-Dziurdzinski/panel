<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return DB::table('shopping_temp')->get();
    }
}
