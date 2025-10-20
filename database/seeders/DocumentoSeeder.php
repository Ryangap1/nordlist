<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentos = [
            [
                'tipo_documento' => 'CC' //Cédula de Ciudadanía: CC.
            ],
            [
                'tipo_documento' => 'TI' //Tarjeta de Identidad: TI.
            ],
            [
                'tipo_documento' => 'CE' //Cédula de Extranjería: CE.
            ],
            [
                'tipo_documento' => 'TE' //Tarjeta de Extranjería: TE.
            ],
            [
                'tipo_documento' => 'PA' //Pasaporte: PA.
            ],
            [
                'tipo_documento' => 'PEP' //Permiso Especial de Permanencia: PEP.
            ],
            [
                'tipo_documento' => 'NUIP' //Número Único de Identificación Personal: NUIP
            ],
            [
                'tipo_documento' => 'NIT' //Número de Identificación Tributaria: NIP
            ]
        ];

        foreach ($documentos as $doc) {
            Documento::firstOrCreate(['tipo_documento' => $doc['tipo_documento']]);
        }
        
    }
}
