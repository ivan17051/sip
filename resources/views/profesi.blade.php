@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Profesi
@endsection

@section('masterShow')
show
@endsection

@section('profesiStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Profesi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('profesi.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Profesi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="1" id="isparent" name="isparent"> Profesi
                  Memiliki Spesialisasi
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah -->

<!-- Modal Edit -->
<div class="modal fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sunting Profesi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="id">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Profesi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="1" id="isparent" name="isparent"> Profesi
                  Memiliki Spesialisasi
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <form class="" method="POST" action="">
            @method('DELETE')
            @csrf
        <div class="modal-body text-center">
            <p>Yakin ingin menghapus?</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-danger btn-link">Ya, Hapus
                <div class="ripple-container"></div>
            </button>
        </div>
        </form>
        </div>
    </div>
</div>
<!--  end modal Hapus -->
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">group</i>
          </div>
          <h4 class="card-title">
            <div class="row">
              <div class="col">Data Profesi</div>
              <div class="col text-right"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">Tambah</button></div>
            </div>
          </h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                    <th data-priority="3" style="width:30px;" class="disabled-sorting">No</th>
                    <th data-priority="1">Nama Profesi</th>
                    <th data-priority="2">Punya Spesialisasi</th>
                    <th data-priority="3" class="disabled-sorting text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($profesi as $key=>$unit)
                <tr>
                  <td>{{$key}}</td>
                  <td>{{$unit->nama}}</td>
                  <td>{{$unit->isparent}}</td>
                  <td class="text-right">
                    @if($unit->isparent == 1)
                    <button class="btn btn-info btn-link" style="padding:5px;" onclick="show(this)"><i class="material-icons">launch</i></button>&nbsp
                    @endif
                    <button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp
                    <button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
  <!-- end row -->
</div>
@endsection
@section('script')
<script>
  $('#isparent').click(function(){
    if($(this).prop("checked") == true){
      $('#isSpesialisasi').show();
    } else{
      $('#isSpesialisasi').hide();
    }
    
  });
  $('#addSpesialisasi').click(function(e){
    $('#spesialisasi').append("<div class='form-group'><label for='nama' class='bmd-label-floating'>Nama Spesialisasi</label><input type='text' class='form-control' id='nama' name='nama'></div>");
  });
  $('.validasi').on('click', function(e) {
        console.log()
        allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).attr('data-id'));
        });
        var sum_jurnal = allVals.length;
        
        var mainContainer = document.getElementById("peringatanValidasi");
        var submit = document.getElementById("btnValidasi");

        if(allVals.length <=0){
            mainContainer.innerHTML = 'Pilih Jurnal Terlebih Dahulu';
            submit.style.visibility = "hidden";
        }
        else{
            $('#jumlah').attr("value", sum_jurnal);
            mainContainer.innerHTML = 'Ingin Validasi '+ sum_jurnal + ' Jurnal Ini? <br><br><small><i>*Jurnal yang sudah tervalidasi tidak dapat diubah</i></small>';
            submit.style.visibility = "visible";
        }
    });

  function show(self){
      var $modal=$('#spesialisasi');
      var tr = $(self).closest('tr');
      let idx = oTable.row(tr)[0]
      var data = oTable.data()[idx];
      
      window.location.href = "{{url('/str')}}/"+data['id'];
  }

  function edit(self){
      var $modal=$('#sunting');
      var tr = $(self).closest('tr');
      let idx = oTable.row(tr)[0]
      var data = oTable.data()[idx];
      
      $modal.find('input[name=id]').val(data['id']);
      $modal.find('input[name=nama]').val(data['nama']).change();;
      $modal.find('input[name=tempatlahir]').val(data['tempatlahir']).change();;

      $modal.modal('show');
  }

  function hapus(self){
    $modal=$('#hapus');
    var tr = $(self).closest('tr');
    let idx = oTable.row(tr)[0]
    var data = oTable.data()[idx];
    
    $modal.find('form').attr('action', "{{route('pegawai.delete', ['id'=>''])}}/"+data['id']);
    $modal.modal('show');
  }
  $(document).ready(function(){
      // oTable = $("#datatables").DataTable({
      //     select:{
      //         className: 'dataTable-selector form-select'
      //     },
          
      //     processing: true,
      //     serverSide: true,
      //     ajax: {type: "POST", url: '{{route("pegawai.data")}}', data:{'_token':@json(csrf_token())}},
      //     columns: [
      //         { data:'id', title:'ID', visible: false},
      //         { data:'nik', title:'NIK'},
      //         { data:'nama', title:'Nama'},
      //         { data:'jeniskelamin', title:'JenisKelamin', visible: false},
      //         { data:'nohp', title:'No. HP'},
      //         { data:'tempatlahir', title:'TempatLahir', visible: false},
      //         { data:'tanggallahir', title:'TanggalLahir', visible: false},
      //         { data:'alamat', title:'Alamat', visible: false},
      //         { data:'action', title:'Aksi', width:'15%'},
      //     ],
      // });
      table = $('#datatables').DataTable({
        responsive:{
            details: false
        },
        columnDefs: [
            {   
                class: "details-control",
                orderable: false,
                targets: 0
            }
        ]
    });
  });
</script>
@endsection