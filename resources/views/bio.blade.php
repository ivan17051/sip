@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
PROFIL NAKES
@endsection

@section('bioStatus')
active
@endsection

@section('modal')

@endsection
@section('content')
<div class="container-fluid">
    <div class="alert alert-rose alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">notifications</i>
        <span data-notify="message">STR AKAN MEMASUKI MASA EXPIRED PADA TANGGAL <strong>2 JUNI 2022</strong> !!!</span>
    </div>
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
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control">
                                        <span class="bmd-help">A block of help text that breaks onto a new line.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Profesi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Spesialisasi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" placeholder="placeholder">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-right">
                                <button type="button" class="btn btn-primary btn-selengkapnya" onclick="openSelengkapnya()"><i
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
                                    <table class="table table-2-col">
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
                            <div class="row myform">
                                <div class="col">
                                    <table class="table table-2-col">
                                        <tbody>
                                            <tr>
                                                <td><label>Jenis Permohonan</label></td>
                                                <td data-editable="true" >Permohonan Baru
                                                    <select class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                                                        <option disabled selected>Single Option</option>
                                                        <option value="1">PERMOHONAN BARU</option>
                                                        <option value="2">CABUT DAN PINDAH</option>
                                                    </select>
                                                    <!-- <select class="" name="">
                                                        
                                                    </select> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Praktik Ke-</label></td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td><label>Nomor</label></td>
                                                <td data-editable="true">ADAS2
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="" maxlength="5" value="ADAS2" required="true" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Nomor Rekom</label></td>
                                                <td>2948 232 1242 2412</td>
                                            </tr>
                                            <tr>
                                                <td><label>Tanggal Online</label></td>
                                                <td data-editable="true">2 Januari 2022
                                                    <div class="form-group">
                                                        <input type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                                                    </div>
                                                </td>
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
                                    <div class="float-right absolute myform-actions">
                                        <div data-state="0">
                                            <button class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                                                <i class="material-icons">edit_note</i>
                                            </button>
                                            <button class="btn btn-primary btn-round btn-fab" id="anjay">
                                                <i class="material-icons">pending_actions</i>
                                            </button>
                                        </div>
                                        <div data-state="1">
                                            <button class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0)">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <button class="btn btn-success btn-round btn-fab">
                                                <i class="material-icons">save</i>
                                            </button>
                                        </div>
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
    <template id="modal-template">
        <div class="modal modal-custom-1 fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
                </div>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@section('script')
<script type="text/javascript">
    async function openSelengkapnya(){
        if(!$('#modal-biodata').length){
            try {
                let res = await my.request.get("{{route('raw.bio')}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-biodata')
                $modal.find('.modal-title').text('Biodata Nakes')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
            } catch (err) {
                console.log(err)
            }
        }else{
            $('#modal-biodata').modal('show')
        }
    }
    
    $(function(){
        $('.myform').myFormAndToggle()
    })
</script>
@endsection
