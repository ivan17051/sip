@push('modal2')
<div class="modal modal-custom-1 fade" id="modal-sip{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('sip.store')}}" method="POST">
        @csrf
        <input type="hidden" name="idstr" value="{{$str->id}}">
        <div class="modal-header">
            <h4 class="modal-title">SIP {{$index+1}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <div id="sip-form-accordion{{$index}}" role="tablist">
                @if(isset($sips[$index]) AND $sips[$index]['isactive'] )
                <div class="form-check-group mb-3" id="aksisip-wrapper-{{$index}}">
                    <!-- <div class="form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="jenispermohonan" value="perpanjangan" data-target="#" > Perpanjangan
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                        </label>
                    </div> -->
                    <div class="form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="jenispermohonan" value="cabut" > Cabut
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="jenispermohonan" value="cabutpindah" data-target="#form-sip-baru-{{$index}}" checked > Cabut Pindah
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                        </label>
                    </div>
                </div>
                @else
                <input type="hidden" name="jenispermohonan" value="baru">
                @endif
                <div id="form-sip-baru-{{$index}}">
                    <div class="card-collapse">
                        <div class="card-header" role="tab" >
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#sip-form-1-{{$index}}" aria-expanded="true" class="collapsed">
                                NOMOR
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                        </div>
                        <div id="sip-form-1-{{$index}}" class="collapse show" role="tabpanel" data-parent="#sip-form-accordion{{$index}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label force-top">Praktik ke- <small class="text-danger align-text-top">*wajib</small></label>
                                    <input type="number" class="form-control bg-color-unset" name="instance" value="{{$index+1}}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Nomor SIP <small class="text-danger align-text-top">*wajib</small></label>
                                    <div class="nomorsip-wrapper">
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="7" value="503.446" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="5" value="" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="4" value="{{sprintf('%04d', $nakes->nomorregis)}}" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="3" value="{{integerToRoman($index+1)}}" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="5" value="IP.DU" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="7" value="436.7.2" readonly required></span> / 
                                        <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="4" value="{{date('Y')}}" readonly required></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Nomor Online</label>
                                    <div>
                                        <input type="text" class="form-control" name="nomoronline" maxlength="28" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Nomor Rekom</label>
                                    <div>
                                        <input type="text" class="form-control" name="nomorrekom" maxlength="22" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Jabatan</label>
                                    <div>
                                        <input type="text" class="form-control" name="jabatan" maxlength="30" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-collapse">
                        <div class="card-header" role="tab" >
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#sip-form-2-{{$index}}" aria-expanded="false" class="">
                                FASKES
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                        </div>
                        <div id="sip-form-2-{{$index}}" class="collapse" role="tabpanel" data-parent="#sip-form-accordion{{$index}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label force-top">Faskes <small class="text-danger align-text-top">*wajib</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="idfaskes" required hidden>
                                        <input type="text" class="form-control" name="faskes" required readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}">
                                                <i class="material-icons">search</i>
                                            </button>
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Jadwal Praktik </label>
                                    <textarea type="text" class="form-control" name="jadwalpraktik" maxlength="100" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-collapse">
                        <div class="card-header" role="tab" >
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#sip-form-3-{{$index}}" aria-expanded="false" class="">
                                TANGGAL
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                        </div>
                        <div id="sip-form-3-{{$index}}" class="collapse" role="tabpanel" data-parent="#sip-form-accordion{{$index}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label force-top">Tanggal Online <small class="text-danger align-text-top">*wajib</small></label>
                                    <input type="date" class="form-control" name="tglonline" required>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Tanggal Masuk Dinas <small class="text-danger align-text-top">*wajib</small></label>
                                    <input type="date" class="form-control" name="tglmasukdinas" required>
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label force-top">Tanggal Verif & Cetak <small class="text-danger align-text-top">*wajib</small></label>
                                    <input type="date" class="form-control" name="tglverif" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-link text-primary">Simpan</button>
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
        </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade text-left bg-overlay-gray" id="searchfaskes{{$index}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content" style="overflow: visible!important;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" >Cari Faskes
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="typeahead__container ">
                    <div class="typeahead__field">
                        <div class="form-group typeahead__query">
                            <input class="form-control js-typeahead"
                                name="q"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@if(isset($sips[$index]))

<!-- FORM DELETE STR -->
<form action="{{route('sip.destroy', ['str'=>$sips[$index]['id']])}}" method="POST" id="form-destroy-sip-{{$index}}">
@csrf
@method('DELETE')
</form>
<!-- END OF FORM DELETE STR -->

<form id="form-update-sip-{{$index}}">
    <input type="hidden" name="id" value="{{$sips[$index]['id']}}">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    <tr>
                        <td><label>Jenis Permohonan</label></td>
                        <td>@php 
                            switch($sips[$index]['jenispermohonan']){
                                case 'baru':
                                    echo 'Permohonan Baru';
                                    break;
                                case 'cabut':
                                    echo 'Cabut';
                                    break;
                                case 'cabutpindah':
                                    echo 'Cabut Pindah';
                                    break;
                            }
                            @endphp</td>
                    </tr>
                    <tr>
                        <td><label>Praktik Ke-</label></td>
                        <td>{{$sips[$index]['instance']}}</td>
                    </tr>
                    <tr>
                        <td><label>Nomor SIP</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                @php
                                $nomors = explode(' / ', $sips[$index]['nomor']);
                                @endphp
                                <div class="nomorsip-wrapper" data-editable=true data-delimitter=" / " >
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="7" value="{{$nomors[0]}}" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="5" value="" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="4" value="{{sprintf('%04d', $nomors[1])}}" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="3" value="{{$nomors[2]}}" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="5" value="{{$nomors[3]}}" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="7" value="{{$nomors[4]}}" readonly required></span> / 
                                    <span class="form-group d-inline-block"><input data-editable2=true type="text" class="form-control" name="nomor[]" maxlength="4" value="{{$nomors[5]}}" readonly required></span>
                                </div>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nomor Online</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomoronline" value="{{$sips[$index]['nomoronline']}}" maxlength="28" >
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nomor Rekom</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomorrekom" value="{{$sips[$index]['nomorrekom']}}" maxlength="22" >
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Online</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglonline" value="{{$sips[$index]['tglonline']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Masuk Dinas</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglmasukdinas" value="{{$sips[$index]['tglmasukdinas']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Verif & Cetak</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglverif" value="{{$sips[$index]['tglverif']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr hidden>
                        <td><label>FASKES HIDDEN</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" name="idfaskes" value="{{$sips[$index]['idfaskes']}}" required hidden>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Sarana Praktik</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span class="input-group">
                                <input class="form-control" data-editable=true type="text" name="namafaskes" value="{{$sips[$index]['namafaskes']}}" required readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>  
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Alamat Praktik</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input class="form-control" data-editable=true type="text" name="alamatfaskes" value="{{$sips[$index]['alamatfaskes']}}" readonly>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jadwal Praktik</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <textarea data-editable=true type="text" class="form-control" name="jadwalpraktik" value="{{$sips[$index]['jadwalpraktik']}}" maxlength="100" ></textarea>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jabatan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" value="{{$sips[$index]['jabatan']}}" name="jabatan" maxlength="30" >
                            </span>
                        </td>
                    </tr>
                    @if( in_array($sips[$index]['idprofesi'], [31]) )
                    <!-- KHUSUS Tenaga Kesehata Tradisional Interkontinental -->
                    <tr>
                        <td><label>Cetak SIP</label></td>
                        <td><a target="_blank" href="{{route('cetak.sip', ['idsip'=>$sips[$index]['id']])}}" class="btn btn-outline-primary btn-round btn-sm" >Cetak SIP <i class="material-icons">open_in_new</i></a></td>
                    </tr>
                    @else
                    <tr>
                        <td><label>Cetak Perstek</label></td>
                        <td><a target="_blank" href="{{route('cetak.perstek', ['idsip'=>$sips[$index]['id']])}}" class="btn btn-outline-primary btn-round btn-sm" >Cetak Perstek <i class="material-icons">open_in_new</i></a></td>
                    </tr>
                    <tr>
                        <td><label>Cetak Kitir</label></td>
                        <td><a target="_blank" href="{{route('cetak.kitir', ['idsip'=>$sips[$index]['id']])}}" class="btn btn-outline-primary btn-round btn-sm" >Cetak Kitir <i class="material-icons">open_in_new</i></a></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col" style="flex-grow:0;">
            <div class="float-right absolute myform-actions">
                <div data-state="0" class="anim slide">
                    <button type="button" class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                        <i class="material-icons">edit_note</i>
                    </button>
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriSIP(1)">
                        <i class="material-icons">pending_actions</i>
                    </button>
                </div>
                <div data-state="1" class="anim slide">
                    <button type="button" class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0)">
                        <i class="material-icons">close</i>
                    </button>
                    <button type="submit" class="btn btn-success btn-round btn-fab">
                        <i class="material-icons">save</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@if($str->isactive OR  (!$str->isactive AND isset($sips[$index])))
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya" data-toggle="modal" data-target="#modal-sip{{$index}}"><i
            class="material-icons">priority_high</i> TINDAKAN PERIZINAN</button>
</div>
@endif
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sip{{$index}}"><i
            class="material-icons">add</i> TAMBAH SIP</button>
</div>
@endif

@push('script2')
<script>
$(function(){

    $('#modal-sip{{$index}} form').submit(function(e){
        e.preventDefault();
        let formDOM = this
        let jenispermohonan = $(this).find('[name=jenispermohonan]:checked').val()
        
        if(jenispermohonan == 'cabut'){
            //cabut
            swal({
                title: 'Yakin ingin mencabut SIP?',
                text: "proses tidak dapat dilakukan lagi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Tidak',
                buttonsStyling: false
            }).then( function(isConfirm){
                if(isConfirm.value) $('#form-destroy-sip-{{$index}}').submit();
            }).catch(swal.noop)
        }else{
            formDOM.submit()
        }
    })


    // EDITABLE NOMOR SIP
    $('#modal-sip{{$index}} [name="nomor[]"][data-editable2=true], #form-update-sip-{{$index}} [name="nomor[]"][data-editable2=true]').focusin(function(e,a){
        e.target.readOnly = false;
    }).focusout(function(e){
        e.target.readOnly = true;
    })
    // END OF EDITABLE NOMOR SIP

    // SEARCH FASKES
    $('#searchfaskes{{$index}} .js-typeahead').typeahead({
        input: ".js-typeahead",
        dynamic: true, 
        hint: true,
        order: "asc",
        display: ["nama", "alamat"],
        template: function (query, item) {return item.nama+', '+item.alamat},
        emptyTemplate: "Tidak ditemukan",
        source: {
            faskes: {
                // Ajax Request
                ajax: function (query) {
                    return {
                        type: 'GET',
                        url: '{{route("data.searchfaskes")}}',
                        data: {'query':query}
                    }
                }
            }
        },
        callback: {
            onClick: function(node, a, item, event){
                $('#searchfaskes{{$index}}').modal('hide')

                if( $('#modal-sip{{$index}}').hasClass('show') ){
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM MODAL SIP
                    let $modalsip = $('#modal-sip{{$index}}')
                    $modalsip.find('[name=faskes]').val(item.nama+', '+item.alamat)
                    $modalsip.find('[name=idfaskes]').val(item.id)
                }else{
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM UPDATE SIP
                    let $form = $('#form-update-sip-{{$index}}')
                    $form.find('[name=namafaskes]').val(item.nama)
                    $form.find('[name=alamatfaskes]').val(item.alamat)
                    console.log($form.find('[name=idfaskes]'))
                    $form.find('[name=idfaskes]').val(item.id)
                }
            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });
    // END OF SEARCH FASKES

    // TOGGLE RADIO BUTTON JENISPERMOHONAN
    $('#modal-sip{{$index}} [name=jenispermohonan]').change(function(e){
        $('#modal-sip{{$index}} [name=jenispermohonan]').each(function(k,elem){
            let section =  $(elem.dataset.target)
            if(!section.length) return;
            if(elem.checked){
                section.find('input,select,textarea').prop("disabled", false)
                section.attr('hidden', false)
            }else{
                section.find('input,select,textarea').prop("disabled", true)
                section.attr('hidden', true)
            }
        })
    })
    // END OF TOGGLE RADIO BUTTON JENISPERMOHONAN

    @if(isset($sips[$index]))
    // UPDATE SIP HANDLER
    $('#form-update-sip-{{$index}}').submit(async function(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('sip.update', ['idsip' => $sips[$index]['id']])}}";
            let res = await my.request.post(url, data)
            $submitBtn.myFormAndToggle().initInput()
            $submitBtn.myFormAndToggle().toggle(0)
            md.showNotification('check', 3, 'Berhasil Memperbarui Data')
        } catch (err) {
            console.log(err);
            md.showNotification('close', 2, Object.values(err.responseJSON.errors)[0])
        }
        LOADING.hide()
    })
    // END OF UPDATE SIP HANDLER
    @endif

    $('#modal-sip{{$index}} [name=jenispermohonan]').change();

    @if(!isset($sips[$index]) OR !$sips[$index]['isactive'])
    $('#modal-sip{{$index}} .modal-title').text('Tambahkan SIP');
    @endif
})
</script>
@endpush