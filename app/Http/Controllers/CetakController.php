<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function perstek(Request $request, $idpegawai, $idprofesi){
        $d['aturan'] = $this->dasarPeraturanPerstek($idprofesi);
        return view('report.perstek', $d);
    }

    public function kitir(Request $request, $idsip){
        return view('report.kitir');
    }

    public function sip(Request $request, $idsip){
        return view('report.sip');
    }

    private function dasarPeraturanPerstek($idprofesi){
        $text = [];
        switch ($variable) {
            case "1" :      // Dokter
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "2" :      // Dokter Gigi
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "3" :      // Dokter Spesialis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "4" :      // Dokter Gigi Spesialis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "5" :      // PPDS (Program Pendidikan Dokter Spesialis)
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "6" :      // PPDGS (Program Pendidikan Dokter Gig Spesialis)
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "7" :      // Dokter Internship
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "8" :      // Psikologi Klinis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 45 Tahun 2017 Tentang Izin dan Penyelenggaraan Praktik Psikolog Klinis",
                ];
                break;
            case "9" :      // Perawat
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 26 Tahun 2019 Tentang Peraturan Pelaksanaan Undang-Undang Nomor 38 Tahun 2014 tentang Keperawatan.",
                ];
                break;
            case "10":      // Bidan
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 28 Tahun 2017 Tentang Izin dan Penyelenggaraan Pekerjaan dan Praktik Bidan",
                ];
                break;
            case "11":      // Apoteker
                $text =  [
                    "Peraturan Pemerintahan Nomor 51 Tahun 2009 tentang Pekerjaan Kefarmasian,",
                    "Peraturan Menteri Kesehatan Nomor 31 Tahun 2016 tentang Perubahan Atas Peraturan Menteri Kesehatan Nomor 889/Menkes/Per/V/2011 tentang Registrasi Izin Praktik, dan Izin Kerja Tenaga Kefarmasian;",
                    "Surat Edaran Nomor HK.02.02/MENKES/24/2017 tentang Petunjuk Pelaksanaan Peraturan Menteri Kesehatan Nomor 31 Tahun 2016;",
                ];
                break;
            case "12":      // Tenaga Teknis Kefarmasian
                $text =  [
                    "Peraturan Pemerintahan Nomor 51 Tahun 2009 tentang Pekerjaan Kefarmasian,",
                    "Peraturan Menteri Kesehatan Nomor 31 Tahun 2016 tentang Perubahan Atas Peraturan Menteri Kesehatan Nomor 889/Menkes/Per/V/2011 tentang Registrasi Izin Praktik, dan Izin Kerja Tenaga Kefarmasian;",
                    "Surat Edaran Nomor HK.02.02/MENKES/24/2017 tentang Petunjuk Pelaksanaan Peraturan Menteri Kesehatan Nomor 31 Tahun 2016;",
                ];
                break;
            case "13":      // Sanitasi Lingkungan
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 32 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Tenaga Sanitarian",
                ];
                break;
            case "14":      // Nutrisionis/Dietisien
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 26 Tahun 2013 Tentang Izin dan Penyelenggaraan Praktik Tenaga Gizi",
                ];
                break;
            case "15":      // Fisioterapis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 80 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Fisioterapis",
                ];
                break;
            case "16":      // Okupasi Terapis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 23 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Okupasi Terapis",
                ];
                break;
            case "17":      // Terapis Wicara
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 24 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Terapis Wicara",
                ];
                break;
            case "18":      // Akupunktur Terapis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia  Nomor 34 Tahun 2018 tentang Izin dan Penyelenggaraan Praktik Akupunktur Terapis."
                ];
                break;
            case "19":      // Perekam Medis dan Informasi Kesehatan
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 55 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Perekam Medis",
                ];
                break;
            case "20":      // Teknik Kardiovaskuler
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 30 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Teknisi Kardiovasuler",
                ];
                break;
            case "21":      // Refraksionis Optisien/Optometris
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 19 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Refraksionis Optisien dan Optometris",
                ];
                break;
            case "22":      // Teknisi Gigi
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 54 Tahun 2012 Tentang Penyelenggaraan Pekerjaan Teknisi Gigi",
                ];
                break;
            case "23":      // Penata Anestesi
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 18 Tahun 2016 Tentang Izin dan Penyelenggaraan Praktik Penata Anestesi",
                ];
                break;
            case "24":      // Terapis Gigi dan Mulut
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 20 Tahun 2016 Tentang Izin dan Penyelenggaraan Praktik Terapis Gigi dan Mulut",
                ];
                break;
            case "25":      // Radiografer
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 81 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Radiografer",
                ];
                break;
            case "26":      // Elektromedis
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 45 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Elektromedis",
                ];
                break;
            case "27":      // Ahli Teknologi Laboratorium Medik
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 42 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Ahli Teknologi Laboratorium Medik",
                ];
                break;
            case "28":      // Ortotik Prostetik
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 22 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Ortotis Prostetis",
                ];
                break;
            case "29":      // Tenaga Kesehata Tradisional
                $text =  [
                    "Peraturan Pemerintah Republik Indonesia Nomor 103 Tahun 2014 Tentang Pelayanan Kesehatan Tradisional",
                ];
                break;
            case "30":      // Tenaga Kesehata Tradisional Jamu
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 24 Tahun 2018 Tentang Izin dan Penyelenggaraan Praktik Tenaga Kesehatan Tradisional Jamu",
                ];
                break;
            case "31":      // Tenaga Kesehata Tradisional Interkontinental
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 17 Tahun 2021 Tentang Izin dan Penyelenggaraan Praktik Tenaga Kesehatan Tradisional Interkontinental"
                ];
                break;
            case "32":      // Penyehat Tradisional
                $text =  [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 61 Tahun 2016 tentang Pelayanan Kesehatan Tradisional Empiris"
                ];
                break;
        }

        array_merge($text, ["Peraturan Menteri Kesehatan Republik Indonesia Nomor 2025/MENKES/PER/X TAHUN 2011"]);
        
        return $text;
    }
}
