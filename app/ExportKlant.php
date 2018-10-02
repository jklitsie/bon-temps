<?php

namespace App;

use Illuminate\Support\Facades\DB;
use App\Klant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportKlant implements FromCollection,WithHeadings
{
    use Exportable;

    public function __construct()
    {

    }

    public function collection()
    {
        $klantenn = Klant::select('voornaam','achternaam','email','telefoonnummer')->get();
        return $klantenn;

    }

    public function headings() : array
    {
        return ['voornaam','achternaam','email','telefoonnummer'];
    }
}
