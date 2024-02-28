<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomerExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $customers = Customer::with(['userName'])->get();
        return $array = $customers->map(function ($customer, $key) {

            return [
                'sn' => $key + 1,
                'created_by' => $customer->userName->name,
                'customer_name' => $customer->name,
                'mobile_number' => $customer->mobile_number,
                'age' => $customer->age,
                'created_at' => $customer->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S/N',
            'Created By',
            'Customer Name',           
            'Mobile Number',
            'Age',
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
