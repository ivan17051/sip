@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
PROFIL NAKES
@endsection

@section('modal')

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="subtitle-wrapper">
                        <h4 class="card-title">BIODATA PENGGUNA</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-2 text-center"> 
                            <div class="profil-image-wrapper d-inline-block">
                                <div class="">
                                    <img src="{{asset('public/img/faces/marc.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">With help</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control">
                                        <span class="bmd-help">A block of help text that breaks onto a new line.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Placeholder</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" placeholder="placeholder">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-right">
                                <button type="button" class="btn btn-primary btn-selengkapnya"><i
                                        class="material-icons">more_vert</i> SELENGKAPNYA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title"></span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#str" data-toggle="tab">
                                        <i class="material-icons">bug_report</i> STR
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sip1" data-toggle="tab">
                                        <i class="material-icons">code</i> SIP 1
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sip2" data-toggle="tab">
                                        <i class="material-icons">code</i> SIP 2
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sip3" data-toggle="tab">
                                        <i class="material-icons">code</i> SIP 3
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="str">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-sip">
                                        <tbody>
                                            <tr>
                                                <td><label>Nomor STR</label></td>
                                                <td>1029 0120 3023</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Terbit</label></td>
                                                <td>2 Januari 2022</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Expired</label></td>
                                                <td><strong class="text-danger">2 Januari 2027</strong></td>
                                            </tr>
                                            <tr>
                                                <td><label>Peruntukan</label></td>
                                                <td>Dokter Anak</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col" style="flex-grow:0;">
                                    <div class="float-right absolute">
                                        <button class="btn btn-primary btn-round btn-fab">
                                            <i class="material-icons">edit_note</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
                                <button type="button" class="btn btn-primary btn-selengkapnya"><i
                                        class="material-icons">priority_high</i> TINDAKAN PADA STR</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="sip1">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-sip">
                                        <tbody>
                                            <tr>
                                                <td><label>Jenis Permohonan</label></td>
                                                <td>Permohonan Baru</td>
                                            </tr>
                                            <tr>
                                                <td><label>Praktik Ke-</label></td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td><label>Nomor</label></td>
                                                <td>918/AI8291/2022/JADS</td>
                                            </tr>
                                            <tr>
                                                <td><label>Nomor Rekom</label></td>
                                                <td>2948 232 1242 2412</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Online</label></td>
                                                <td>2 Januari 2022</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Masuk Dinas</label></td>
                                                <td>2 Januari 2022</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Verif & Cetak</label></td>
                                                <td>23 Januari 2022</td>
                                            </tr>
                                            <tr>
                                                <td><label>Jenis Praktik</label></td>
                                                <td>Dokter</td>
                                            </tr>
                                            <tr>
                                                <td><label>Spesialis</label></td>
                                                <td>Dokter Anak</td>
                                            </tr>
                                            <tr>
                                                <td><label>Sarana Praktik</label></td>
                                                <td>Praktik Mandiri</td>
                                            </tr>
                                            <tr>
                                                <td><label>Alamat Praktik</label></td>
                                                <td>Jl. Jemursari, Surabaya</td>
                                            </tr>
                                            <tr>
                                                <td><label>Jadwal Praktik</label></td>
                                                <td>Senin-Jumat, 13:00-18:00</td>
                                            </tr>
                                            <tr>
                                                <td><label>Preview SIP</label></td>
                                                <td><button class="btn btn-outline-primary btn-round btn-sm">preview <i class="material-icons">open_in_new</i></button></td>
                                            </tr>
                                            <tr>
                                                <td><label>Histori SIP</label></td>
                                                <td><button class="btn btn-outline-primary btn-round btn-sm">histori SIP <i class="material-icons">open_in_new</i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col" style="flex-grow:0;">
                                    <div class="float-right absolute">
                                        <button class="btn btn-primary btn-round btn-fab">
                                            <i class="material-icons">edit_note</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
                                <button type="button" class="btn btn-primary btn-selengkapnya"><i
                                        class="material-icons">priority_high</i> TINDAKAN PERIZINAN</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="sip2">
                            <div class="tambah-sip-wrapper text-center">
                                <button type="button" class="btn btn-primary btn-selengkapnya"><i
                                        class="material-icons">add</i> Tambah SIP Ke-2</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="sip3">
                            <div class="tambah-sip-wrapper text-center">
                                <button type="button" class="btn btn-primary btn-selengkapnya"><i
                                        class="material-icons">add</i> Tambah SIP Ke-3</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    @endsection

    @section('script')

    @endsection
