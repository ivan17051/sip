@push('modal2')
<div class="modal modal-custom-1 fade" id="modal-sip{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('sip.store')}}" method="POST">
        @csrf
        <input type="hidden" name="idstr" value="{{$str->id}}">
        <input type="text" name="idfaskes" required hidden>
        <div class="modal-header">
            <h4 class="modal-title">Tambah SIP</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="bmd-label force-top">Jenis Permohonan <small class="text-danger align-text-top">*wajib</small></label>
                <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="jenispermohonan" name="jenispermohonan" required>
                    @if(isset($sips[$index]))
                    <option>Perpanjangan</option>
                    <option>Cabut</option>
                    <option>Cabut Pindah</option>
                    @else
                    <option selected>Permohonan Baru</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Praktik ke- <small class="text-danger align-text-top">*wajib</small></label>
                <input type="number" class="form-control" name="instance" value="{{$index+1}}" readonly required>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Nomor SIP <small class="text-danger align-text-top">*wajib</small></label>
                <div class="nomorsip-wrapper">
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="7" value="503.446" readonly required></span> / 
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="4" required></span> / 
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="1" value="I" readonly required></span> / 
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="5" value="IP.DU" readonly required></span> / 
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="7" value="436.7.2" readonly required></span> / 
                    <span class="form-group d-inline-block"><input type="text" class="form-control" name="nomor[]" maxlength="4" value="{{date('Y')}}" readonly required></span>
                </div>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Nomor Rekom <small class="text-danger align-text-top">*wajib</small></label>
                <div>
                    <input type="text" class="form-control" name="nomorrekom" maxlength="22" required>
                </div>
            </div>
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
            <div class="form-group">
                <label class="bmd-label force-top">Faskes <small class="text-danger align-text-top">*wajib</small></label>
                <div class="input-group mb-3">
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
                <textarea type="text" class="form-control" name="jadwalpraktik" maxlength="100" required></textarea>
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
<div class="row myform">
    <div class="col">
        <table class="table table-2-col">
            <tbody>
                <tr>
                    <td><label>Jenis Permohonan</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>PERMOHONAN BARU</option>
                            <option value="2">CABUT DAN PINDAH</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Praktik Ke-</label></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td><label>Nomor SIP</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="" maxlength="5" value="ADAS2" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Nomor Rekom</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" value="81292" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Online</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Masuk Dinas</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Verif & Cetak</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Jenis Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter</option>
                            <option value="2">Dokter Gigi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Spesialis</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter Anak</option>
                            <option value="2">Dokter Bedah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Sarana Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter Anak</option>
                            <option value="2">Dokter Bedah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Alamat Praktik</label></td>
                    <td>Jl. Jemursari, Surabaya</td>
                </tr>
                <tr>
                    <td><label>Jadwal Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="" value="Senin-Jumat, 13:00-18:00" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Preview SIP</label></td>
                    <td><button class="btn btn-outline-primary btn-round btn-sm">preview <i class="material-icons">open_in_new</i></button></td>
                </tr>
                <tr>
                    <td><label>Histori SIP</label></td>
                    <td><button class="btn btn-outline-primary btn-round btn-sm" onclick="openHistoriSIP(1)">histori SIP <i class="material-icons">open_in_new</i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col" style="flex-grow:0;">
        <div class="float-right absolute myform-actions">
            <div data-state="0" class="anim slide">
                <button class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                    <i class="material-icons">edit_note</i>
                </button>
            </div>
            <div data-state="1" class="anim slide">
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
@if($str->isactive OR  (!$str->isactive AND isset($sips[$index])))
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya"><i
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
// function formatNomor(nomor) {
//   var cleaned = ('' + nomor).replace(/[^ \/\.]/gm, '');
//   var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
//   if (match) {
//     return '(' + match[1] + ') ' + match[2] + '-' + match[3];
//   }
//   return null;
// }

$(function(){

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
                let $modalsip = $('#modal-sip{{$index}}')
                $modalsip.find('[name=faskes]').val(item.nama+', '+item.alamat)
                $modalsip.find('[name=idfaskes]').val(item.id)
            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });
})
</script>
@endpush