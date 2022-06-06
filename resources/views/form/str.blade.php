@if(isset($str))
<form onsubmit="submitSTR(event)">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    <tr>
                        <td><label>Nomor STR</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomor" maxlength="22" value="{{$str->nomor}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Terbit</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="since" class="form-control" required value="{{$str->since}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Berkahir</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="expiry" class="form-control" required value="{{$str->expiry}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Penetapan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tanggal" class="form-control" required value="{{$str->tanggal}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Peruntukan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                                @foreach($profesi as $p)
                                <option value="{{$p->id}}" {{$nakes->idprofesi==$p->id ? 'selected' : ''}}>{{$p->nama}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Spesialis</label></td>
                        <td>
                            <span data-text="true"></span>
                            <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                                <option value="">KOSONG</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col" style="flex-grow:0;">
            <div class="float-right absolute myform-actions">
                <div data-state="0" class="anim slide">
                    <button type="button" class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                        <i class="material-icons">edit_note</i>
                    </button>
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriSTR()">
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
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya"><i
            class="material-icons">priority_high</i> TINDAKAN PADA STR</button>
</div>
@else
<div class="modal modal-custom-1 fade" id="modal-str" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('str.store')}}" method="POST">
        @csrf
        <input type="hidden" name="idpegawai" value="{{$nakes->id}}">
        <div class="modal-header">
            <h4 class="modal-title">Tambah STR</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="bmd-label-floating">Nomor <small class="text-danger align-text-top">*wajib</small></label>
                <input type="text" class="form-control" name="nomor" maxlength="22" required>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Tanggal Terbit <small class="text-danger align-text-top">*wajib</small></label>
                <input type="date" class="form-control" name="since" required>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Tanggal Berkahir <small class="text-danger align-text-top">*wajib</small></label>
                <input type="date" class="form-control" name="expiry" required>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Tanggal Penetapan <small class="text-danger align-text-top">*wajib</small></label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
                <label class="bmd-label force-top">Peruntukan <small class="text-danger align-text-top">*wajib</small></label>
                <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Single Select" name="idprofesi" onchange="toggleSpesialisasi(event)" required>
                    <option value="" >Peruntukan</option>
                    @foreach($profesi as $p)
                    <option value="{{$p->id}}" {{$nakes->idprofesi==$p->id ? 'selected' : ''}} data-isparent="{{$p->isparent}}" >{{$p->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group spesialisasi-wrapper" hidden>
                <label class="bmd-label force-top">Spesialisasi <small class="text-danger align-text-top">*wajib</small></label>
                <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Spesialisasi" name="idspesialisasi" required>
                </select>
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
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-str"><i
            class="material-icons">add</i> TAMBAH STR</button>
</div>
@endif

@push('script2')
<script>
    async function toggleSpesialisasi(e){
        var idspesialisasi={{ (isset($str) AND $str->idspesialisasi <> NULL) ? $str->idspesialisasi : -1 }}
        let $s = $(e.target).find('option:selected')
        let idprofesi = $s.val()
        let isparent = $s[0].dataset.isparent
        if(parseInt(isparent)){
            try {
                let url = "{{route('data.getspesialisasi',['idprofesi'=>''])}}/"+idprofesi;
                let res = await my.request.get(url)
                let options = res.reduce(function(e,a){
                    if(a.id == idspesialisasi){
                        e += '<option value="'+a.id+'" selected>'+a.nama+'</option>'
                    }else{
                        e += '<option value="'+a.id+'" >'+a.nama+'</option>'
                    }
                    return e;
                },'<option value="" >Pilih Spesialisasi</option>');
                let $wrapper = $('.spesialisasi-wrapper')
                let $select = $wrapper.find('select')
                $select.html(options)
                $select.prop("disabled", false)
                $select.attr("required",true)  
                $select.selectpicker('refresh')
                $wrapper.attr('hidden', false)
            } catch (error) {
                let $wrapper = $('.spesialisasi-wrapper')
                $wrapper.attr('hidden', true) 
                let $select = $wrapper.find('select')
                $select.removeAttr("required")  
                $select.prop("disabled", true)  
            }
        }else{
            let $wrapper = $('.spesialisasi-wrapper')
            $wrapper.attr('hidden', true) 
            let $select = $wrapper.find('select')
            $select.removeAttr("required")  
            $select.prop("disabled", true)
        }
    }

    @if(isset($str))
    async function submitSTR(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('str.store')}}";
            let res = await my.request.post(url, data)
            $submitBtn.myFormAndToggle().initInput()
            $submitBtn.myFormAndToggle().toggle(0)
            md.showNotification('check', 3, 'Berhasil Memperbarui Data')
        } catch (err) {
            md.showNotification('close', 2, Object.values(err.responseJSON.errors)[0])
            LOADING.hide()
        }
    }
    @else
    
    @endif
</script>
@endpush