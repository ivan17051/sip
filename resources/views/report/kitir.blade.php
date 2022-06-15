<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>KITIR TEKNIS</title>
    <style media="all" type="text/css">
        body{
            font-family:Verdana, Geneva, sans-serif;
            font-size:12px;
            padding:0px;
            margin:0px;
        } 
        .TebalBorder{ 
            border-bottom:solid 2px;
        } 
        p{
            text-indent:40px;
        }
    </style>
</head>

<body>
    @php
    $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    @endphp
    <table class="screen panjang lebarKertasTegak">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter paddingfont fontUnderline" style="font-size:16px">HASIL VERIFIKASI PERSYARATAN TEKNIS</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END OF KOP SURAT -->
                    <!-- CONTENT -->
                    <table class="w-85">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Sehubungan dengan permohonan yang diajukan oleh :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="paddingfont " style="font-size:13px">Nama</td>
                          <td class="paddingfont" style="font-size:13px">: dr. SUGIAR EMIWATI</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Tempat Tanggal Lahir</td>
                          <td class="paddingfont" style="font-size:13px">: Surabaya, 03 November 1969</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Alamat KTP</td>
                          <td class="paddingfont" style="font-size:13px">: Karah Tama Asri II / 50 Surabaya</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Nomor Online/Tanggal Pendaftaran</td>
                          <td class="paddingfont" style="font-size:13px">: 8004 / 13 September 2021</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Tanggal Masuk Dinkes</td>
                          <td class="paddingfont" style="font-size:13px">: 13 September 2021</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Jenis Perizinan</td>
                          <td class="paddingfont" style="font-size:13px">: Sarana Perpanjangan - Dokter Umum</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Maka berdasarkan persyaratan dibawah ini :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-85">
                      <thead class="tb-header">
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">PERSYARATAN</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">SESUAI</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">TIDAK SESUAI</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        <tr>
                          <td class="paddingfont fontJustify">1. </td>
                          <td class="paddingfont fontJustify">STR Legalisir</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">2. </td>
                          <td class="paddingfont fontJustify">KTP</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">3. </td>
                          <td class="paddingfont fontJustify">Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">4. </td>
                          <td class="paddingfont fontJustify">Pas Photo Digital Terbaru Ukuran 4 X 6 cm</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">5. </td>
                          <td class="paddingfont fontJustify">Rekomendasi Organisasi Profesi (IDI / PDGI)</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">6. </td>
                          <td class="paddingfont fontJustify">Surat Pernyataan Memiliki Tempat Kerja di Sarana / fasilitas pelayanan kesehatan atau praktik mandiri bermaterai 10.000</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">7. </td>
                          <td class="paddingfont fontJustify">Surat Keterangan Bekerja dari Pimpinan, beserta Foto Copy Izin Penyelenggaraan Fasilitas Pelayanan Kesehatan yang Berlaku</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">8. </td>
                          <td class="paddingfont fontJustify">SIP Lama Asli</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">9. </td>
                          <td class="paddingfont fontJustify">Surat Pengantar Puskesmas</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify">10. </td>
                          <td class="paddingfont fontJustify">Denah Tempat Praktik</td>
                          <td class="paddingfont fontCenter">&#10003;</td>
                          <td class="paddingfont fontCenter"></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-85">
                      <tbody>
                        <tr>  
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Telah dilakukan verifikasi dan diperiksa kebenarannya bahwa telah memenuhi persyaratan untuk  diberikan persetujuan teknis kepada:</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf w-25" style="font-size:13px">Nama</td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">: dr. SUGIAR EMIWATI</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Nama Fasyankes</td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">: PUSKESMAS TANJUNGSARI</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Alamat Fasyankes</td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">: Jl. Raya Tanjungsari 116 Surabaya</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Demikian hasil verifikasi persyaratan teknis ini dibuat untuk digunakan sebagaimana mestinya.</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF CONTENT -->
                    <!-- TTD -->
                    <table class="w-85">
                      <tbody>
                        <tr>
                          <td></td>
                          <td width="35%">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">Surabaya, 12 Januari 2022</td>
                                </tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">KEPALA BIDANG,</td>
                                </tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">Sumber Daya Kesehatan,</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">Ibu Nanik</td>
                                </tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">Pembina Utama Muda</td>
                                </tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">NIP 196502281992032008</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF TTD -->
                </td>
            </tr>
            
        </tbody>
    </table>
    <script>
        // window.print();
    </script>
</body>

</html>