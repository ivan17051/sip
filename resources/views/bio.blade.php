@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Profil Nakes
@endsection

@section('bioStatus')
active
@endsection

@section('modal')

@endsection
@section('content')
<div class="container-fluid">
    @if(!isset($nakes))
        <div class="text-center">
            <h5>Cari Nakes terlebih dahulu atau cari melalui <a href="{{url('/nakes')}}">link berikut</a></h5>
        </div>
    @else

    @if(isset($str))
        @php
            $daydiff = (new DateTime(date('Y-m-d')))->diff(new DateTime($str->expiry));
        @endphp

        @if( $daydiff->invert )
        @php
            $isstrexpired = TRUE;
        @endphp
        <!-- expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">STR TELAH EXPIRED PADA TANGGAL <strong>{{$str->expiry}}</strong> !!!</span>
        </div>
        @elseif( $daydiff->days < 60 )
        <!-- 2 bulan maka sudah masuk expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">STR AKAN MEMASUKI MASA EXPIRED PADA TANGGAL <strong>{{$str->expiry}}</strong> !!!</span>
        </div>
        @endif
    @endif
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
                                        <input type="text" class="form-control" value="{{$nakes->nama}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Profesi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($nakes->profesi)? $nakes->profesi : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Spesialisasi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($nakes->spesialisasi)? $nakes->spesialisasi : '-'}}" readonly>
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
                                @if(isset($str))
                                @for($i=0;$i<=count($sips);$i++)
                                <li class="nav-item">
                                    <a class="nav-link" href="#sip{{$i+1}}" data-toggle="tab">
                                        <i class="material-icons">code</i> SIP {{$i+1}}
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                @endfor
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="str">
                            @include('form.str')
                        </div>
                        @if(isset($str))
                        @for($i=0;$i<=count($sips);$i++)
                        <div class="tab-pane" id="sip{{$i+1}}">
                            @include('form.sip', ['index'=> $i ])
                        </div>
                        @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    @endif
</div>
@endsection

@section('script')
<script type="text/javascript">
    async function openSelengkapnya(){
        if(!$('#modal-biodata').length){
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.bio').$urlparam}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-biodata')
                $modal.find('.modal-title').text('Biodata Nakes')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
                setTimeout(() => {
                    $modal.find('.selectpicker').selectpicker({liveSearch:true}); 
                    $modal.find('.myform').myFormAndToggle() 
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
                let res = await my.request.get("{{route('raw.historistr').$urlparam}}")
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
                let res = await my.request.get("{{route('raw.historisip').$urlparam}}")
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
