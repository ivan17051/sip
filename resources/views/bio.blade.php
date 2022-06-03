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
                                        <input type="text" class="form-control" value="RM IVAN INDRAKUSUMA" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Profesi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="DOKTER UMUM" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Spesialisasi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="-" readonly>
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
                            @include('form.str')
                        </div>
                        <div class="tab-pane" id="sip1">
                            @include('form.sip')
                        </div>
                        <div class="tab-pane" id="sip2">
                            @include('form.sip')
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
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.bio')}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-biodata')
                $modal.find('.modal-title').text('Biodata Nakes')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
                setTimeout(() => {
                    $modal.find('.selectpicker').selectpicker({liveSearch:true});
                    $modal.find('.myform').myFormAndToggle()  
                    my.initFormExtendedDatetimepickers()  
                }, 200);
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-biodata').modal('show')
        }
    }

    async function openHistoriSTR(){
        if(!$('#modal-historistr').length){
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.historistr')}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-historistr')
                $modal.find('.modal-title').text('Histori STR')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-historistr').modal('show')
        }
    }

    async function openHistoriSIP(index){
        if(!$('#modal-historisip').length){
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.historisip')}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-historisip')
                $modal.find('.modal-title').text('Histori SIP')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-historisip').modal('show')
        }
    }
    
    $(function(){
        $('.myform').myFormAndToggle()
        my.initFormExtendedDatetimepickers()
    })
</script>
@endsection
