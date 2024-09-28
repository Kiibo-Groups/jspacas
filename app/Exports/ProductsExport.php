<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use App\Models\Product;

use Auth;

class ProductsExport implements FromView,WithHeadings,WithTitle
{
    public $folder  = "almacenes/products/print_labels.";
    /**
    * @return \Illuminate\Support\Collection
    */
 

    public function headings(): array
    {
        return [
            'Clave',
            'Descripcion'
        ];
    }
    
    public function title(): string
    {
        return 'Impresion de etiquetas';
    }

    public function view(): view
    {
        $res = new Product;
        
		return View($this->folder.'print_labels',[
            'data' => $res->PrintLabels($_POST['bodega'])
		]);
    }
}
