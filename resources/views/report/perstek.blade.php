<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>CETAK PERSTEK</title>
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
                              <td class="fontKanan w-20" style="vertical-align: middle;padding-right: 24px;"><img src="{{asset('/public/img/logo_sby.png')}}" width="82" height="105"></td>
                              <td>
                                <table style="margin: 0;">
                                  <tbody>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter paddingfont" style="font-size:16px">DINAS KESEHATAN</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:13px; vertical-align:bottom;">Jalan Jemursari No. 197 Surabaya 60243</td>                                    
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:13px">Telp. (031) 8439473, 8439372, 8473729 Fax. (031) 8483393</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter paddingfont" style="font-size:13px">S U R A B A Y A</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
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
                    <!-- NOMOR -->
                    <table>
                      <tbody>
                        <tr>
                          <td class="headerFont fontCenter paddingfont fontUnderline" style="font-size:13px">PERSETUJUAN TEKNIS</td>
                        </tr>
                        <tr>
                          <td class="headerFont fontCenter paddingfont" style="font-size:13px">NOMOR : 503.446 /                  / 1850 / I / IP.DU / 436.7.2 / 2021</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF NOMOR -->
                    <!-- CONTENT -->
                    <table class="w-85">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Sehubungan dengan surat permohonan perizinan Sarana Perpanjangan - Izin Dokter Umum yang diajukan oleh :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="paddingfont w-25" style="font-size:13px">Nama Pemohon</td>
                          <td class="paddingfont" style="font-size:13px">: dr. SUGIAR EMIWATI</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Alamat</td>
                          <td class="paddingfont" style="font-size:13px">: Karah Tama Asri II / 50 Surabaya</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Tanggal Masuk Dinas</td>
                          <td class="paddingfont" style="font-size:13px">: 13 September 2021</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Tanggal Permohonan</td>
                          <td class="paddingfont" style="font-size:13px">: 13 September 2021</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Nomor Permohonan</td>
                          <td class="paddingfont" style="font-size:13px">: 8004</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-85">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Maka Berdasarkan :</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">1. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Peraturan Walikota Surabaya Nomor 41 Tahun 2021 tentang Perizinan Berusaha, Perizinan Non Berusaha dan Pelayanan Non Perizinan </td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">2. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Peraturan Menteri Kesehatan Republik Indonesia Nomor 2025/MENKES/PER/X TAHUN 2011 </td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-85">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">dengan ini memutuskan memberikan persetujuan untuk diterbitkan Sarana Perpanjangan - Izin Dokter Umum Kepada :</td>
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
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Demikian persetujuan ini dibuat untuk dapat digunakan sebagaiamana mestinya.</td>
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
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">KEPALA DINAS,</td>
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