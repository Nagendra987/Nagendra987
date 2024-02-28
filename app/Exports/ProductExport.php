<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::with(['customer', 'userName'])->get();
        return $array = $products->map(function ($product, $key) {

            return [
                'sn' => $key + 1,
                'created_by' => $product->userName->name,
                'customer_name' => $product->customer->name,
                'product_name' => $product->name,
                'quantity' => $product->quantity,
                'created_at' => $product->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S/N',
            'Created By',
            'Customer Name',           
            'Product Name',
            'Quantity',
            'Created Date',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:f1'; // All headers
                $cellRangeBody = 'A2:W500';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle($cellRangeBody)->getFont()->setSize(10);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

            },
        ];
    }
}
