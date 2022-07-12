<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Spesialisasi;
use App\Pegawai;
use App\Faskes;
use App\Profesi;
use App\SIP;
use Datatables;
use Validator;

class DataController extends Controller
{
    public function getSpesialisasi($idprofesi){
        $spesialisasi = Spesialisasi::where('idprofesi',$idprofesi)->get();
        return response()->json($spesialisasi, 200);
    }

    public function searchFaskes(Request $request){
        $data=$request->input('query');
        $data = Faskes::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('alamat', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(10)
            ->get();
        return response()->json($data);
    }

    public function searchPegawai(Request $request){
        $data=$request->input('query');
        $data = Pegawai::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('nip', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }

    public function laporan(){
        $d['fasyankes']=Faskes::select('id','nama')->get();
        $d['profesi']=Profesi::select('id','nama')->get();
        return view('laporan', ['d'=>$d]);
    }

    public function downloadLaporan(Request $request){
        // dd($request->all());

        $ex = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $ex->getProperties()->setCreator("IT Dinkes 2022");
        $ac = $ex->getActiveSheet();

        // Data Nakes Teregistrasi/Tersertifikasi
        if($request->jenislaporan == 1){
            $data = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->get();
            dd($data);
            $ac->mergeCell('A1:D1');
            $ac->getCell('A1')->setValue('DATA NAKES YANG TEREGISTRASI/TERSERTIFIKASI');

        }
        // Data Cetak Persetujuan Teknis
        elseif($request->jenislaporan == 2) {
            
            $tglawal = '01/'.$request->tglawal;
            $tglawal = \Carbon\Carbon::createFromFormat('d/m/Y',$tglawal)->format('Y-m-d');
            $tglakhir = explode('/', $request->tglakhir);
            $tglakhir = \Carbon\Carbon::create($tglakhir[1],$tglakhir[0])->lastOfMonth()->format('Y-m-d');
            
            $data = SIP::whereBetween('tglverif', [$tglawal, $tglakhir])->get();
            dd($data);
        }
        // Data Tenaga Kesehatan di Fasyankes
        elseif($request->jenislaporan == 3){

            
        }
        // Data Nakes per Profesi
        elseif($request->jenislaporan == 4){

        }
        
        

        $ac->getCell('A2')->setValue("Nama");
        // $ac->mergeCells('A1:A2');
        $ac->getCell('B2')->setValue("NIK");
        // $ac->mergeCells('B1:B2');

        $ac->getCell('A3')->setValue("1");
        $ac->getCell('B3')->setValue("2");

        $maxcol=2;

        $ac->getProtection()->setSheet(true);
        //header pertanyaan dan kode
        foreach ($pertanyaan as $i=>$val) {
            $maxcol++;
            $p=explode('_',$val);
            $cell = $ac->getCellByColumnAndRow($i+3, 1);
            $cell->setValue($p[0]);
            $cell = $ac->getCellByColumnAndRow($i+3, 2);
            $cell->setValue($p[1]);
            $cell = $ac->getCellByColumnAndRow($i+3, 3);
            $cell->setValue($maxcol);
        }

        //daftar siswa
        for ($i=0; $i < count($data[0]); $i++) { 
            $nik=$data[0][$i];
            $nama=$data[1][$i];
            $cell = $ac->getCellByColumnAndRow(1, $i+4);
            $cell->setValue($nama);
            $cell = $ac->getCellByColumnAndRow(2, $i+4);
            $cell->setValue($nik);

            $ac->getColumnDimension($cell->getColumn())->setWidth(15);
        }

        $headerStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $ac->getColumnDimension('A')->setWidth(25);
        $ac->getColumnDimension('B')->setWidth(25);

        //kita hide row satu yg berisikan data id formulir, banyak "siswa_pertanyaan" , dan id-id pertanyaan
        $ac->getRowDimension('1')->setVisible(false);
        $ac->getRowDimension('2')->setRowHeight(30);

        $cell = $ac->getCellByColumnAndRow(count($pertanyaan)+2, count($data[0])+3);
        $maxcol = $cell->getColumn();
        $maxrow = $cell->getRow();

        //Informasi Jumlah siswa, dan jumlah pertanyaan pada file excel, untuk mempermudah proses import nantinya
        $ac->getCell('B1')->setValue(count($data[0]).'_'.count($pertanyaan));

        $ac->getStyle('A1:'.$maxcol.$maxrow)->applyFromArray($headerStyle);
        $ac->getStyle('A3:'.$maxcol.'3')->getFont()->setSize(8);
        $ac->getStyle('A4:A'.$maxrow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $ac->getStyle('B4:B'.$maxrow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        $ac->getStyle('C4:'.$maxcol.$maxrow)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

        $sekolah = \App\User::select('id','nama')->where('id',explode('_',json_decode($request->input('sekolah')))[0])->first();
        $fileName="INPUT_{$sekolah->nama}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($ex, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
