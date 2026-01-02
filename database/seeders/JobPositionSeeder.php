<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'ACCOUNTING / AKUNTANSI',
            'ADMINISTRASI KEUANGAN',
            'ADMINISTRASI PROYEK BANGUNAN',
            'ADMINISTRASI UMUM',
            'AHLI GIZI',
            'ANALIS LABORATORIUM',
            'ANALIS PATOLOGI ANATOMI',
            'APOTEKER',
            'ARSITEK - DRAFTER MEP',
            'ASISTEN APOTEKER / TENAGA TEKNIS KEFARMASIAN',
            'ASISTEN PERAWAT',
            'BIDAN',
            'CLEANING SERVICE',
            'DIREKTUR DAN JAJARAN DIREKSI LAINNYA',
            'DOKTER GIGI',
            'DOKTER GIGI SPESIALIS ATAU SUBSPESIALIS LAINNYA',
            'DOKTER GIGI SPESIALIS BEDAH MULUT',
            'DOKTER GIGI SPESIALIS GIGI ANAK',
            'DOKTER GIGI SPESIALIS KONSERVASI GIGI / ENDODONSIA',
            'DOKTER GIGI SPESIALIS ORTODONSIA',
            'DOKTER GIGI SPESIALIS PERIODONSIA',
            'DOKTER SPESIALIS ANAK',
            'DOKTER SPESIALIS ANESTESI',
            'DOKTER SPESIALIS BEDAH',
            'DOKTER SPESIALIS BEDAH SARAF',
            'DOKTER SPESIALIS BEDAH TORAK & KARDIOVASKULAR',
            'DOKTER SPESIALIS GIZI KLINIK',
            'DOKTER SPESIALIS JANTUNG & PEMBULUH DARAH',
            'DOKTER SPESIALIS JIWA / PSIKIATRI',
            'DOKTER SPESIALIS KULIT & KELAMIN / DERMATOVENEREOLOGI',
            'DOKTER SPESIALIS MATA',
            'DOKTER SPESIALIS OBSTETRI & GINEKOLOGI',
            'DOKTER SPESIALIS ORTHOPAEDI & TRAUMATOLOGI',
            'DOKTER SPESIALIS PARU PULMONOLOGI',
            'DOKTER SPESIALIS PATOLOGI KLINIK',
            'DOKTER SPESIALIS PENYAKIT DALAM',
            'DOKTER SPESIALIS RADIOLOGI',
            'DOKTER SPESIALIS REHABILITASI MEDIK',
            'DOKTER SPESIALIS SARAF / NEUROLOGI',
            'DOKTER SPESIALIS THT',
            'DOKTER SPESIALIS UROLOGI',
            'DOKTER UMUM - CASEMIX / CODING JKN',
            'DOKTER UMUM - FUNGSIONAL (IGD/RANAP/POLI)',
            'DOKTER UMUM - MANAJERIAL',
            'ELEKTROMEDIS',
            'FISIKAWAN MEDIS',
            'FISIOTERAPIS / PELAKSANA REHABILITASI MEDIK',
            'FRONT OFFICE / CUSTOMER CARE',
            'KASIR',
            'KASIR MINIMARKET / FOODCORT',
            'KEPALA INSTALASI FARMASI',
            'KEPALA SUB BAGIAN (UMUM/LOGISTIK/RUMAH TANGGA)',
            'KEPALA SUB BAGIAN KEUANGAN (PERBENDAHARAAN/AKUNTANSI)',
            'KESEHATAN LINGKUNGAN',
            'LAUNDRY',
            'LEGAL',
            'LOGISTIK',
            'MANAJER KEPERAWATAN',
            'MANAJER KEUANGAN / AKUNTANSI',
            'MANAJER PELAYANAN MEDIS',
            'MANAJER PENUNJANG MEDIS',
            'MANAJER SDM / HRD',
            'MANAJER UMUM (ADMINISTRASI / LOGISTIK / RUMAH TANGGA)',
            'MARKETING',
            'PARKIR',
            'PENDAFTARAN / REGISTRASI',
            'PENGAWAS LAPANGAN PROYEK BANGUNAN',
            'PENUNJANG MEDIK',
            'PERAWAT',
            'PERAWAT / PENATA ANESTESI',
            'PERAWAT AHLI / SPESIALIS / SERTIFIKASI KHUSUS',
            'PERAWAT BEDAH',
            'PERAWAT GIGI',
            'PERAWAT HEMODIALISIS',
            'PERAWAT INTENSIF (ICU / PICU / NICU)',
            'PSIKOLOG KLINIS',
            'RADIOGRAFER',
            'RADIOTERAPI',
            'REFRAKSIONIS OPTISIEN',
            'REKAM MEDIS',
            'SATPAM',
            'SDM / HRD',
            'SUPIR',
            'TATA BOGA / PELAKSANA GIZI',
            'TEKNISI',
            'TEKNISI KARDIOVASKULAR',
            'TEKNOLOGI INFORMASI / IT',
            'TERAPIS ESTETIKA / BEAUTICIAN',
            'TERAPIS OKUPASI',
            'TERAPIS PERILAKU',
            'TERAPIS REMEDIAL',
            'TERAPIS WICARA'
        ];

        foreach ($positions as $position) {
            JobPosition::create(['name' => $position]);
        }
    }
}
