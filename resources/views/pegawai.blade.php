@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Pegawai
@endsection

@section('pegawaiStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Pegawai </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="material-icons">clear</i>
        </button>
    </div>
    <form class="form-horizontal input-margin-additional" method="POST" action="{{route('pegawai.update')}}">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <input type="hidden" name="id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama" class="bmd-label-floating">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="nip" class="bmd-label-floating">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                  <select class="selectpicker" data-style="btn btn-primary btn-round" id="jeniskelamin" title="Jenis Kelamin" name="jeniskelamin" required>
                    <option value="L">L</option>
                    <option value="P">P</option>
                  </select>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nama" class="bmd-label-floating">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tanggallahir" class="bmd-label-floating">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nohp" class="bmd-label-floating">No. HP</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" required>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label for="alamat" class="bmd-label-floating">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-link text-primary">Simpan</button>
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
    </div>
    </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah -->

<!-- Modal Edit -->
<div class="modal fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Pegawai </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('pegawai.update')}}">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama" class="bmd-label-floating">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nip" class="bmd-label-floating">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                      <select class="selectpicker" data-style="btn btn-primary btn-round" id="jeniskelamin" title="Jenis Kelamin" name="jeniskelamin" required>
                        <option value="L">L</option>
                        <option value="P">P</option>
                      </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama" class="bmd-label-floating">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tanggallahir" class="bmd-label-floating">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nohp" class="bmd-label-floating">No. HP</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="alamat" class="bmd-label-floating">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-link text-primary">Simpan</button>
            <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
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
              <div class="col">Data Pegawai</div>
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
              </thead>
              <tbody>
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
  function show(self){
      var $modal=$('#sunting');
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
      $modal.find('input[name=nik]').val(data['nik']).change();
      $modal.find('input[name=nama]').val(data['nama']).change();;
      $modal.find('input[name=tempatlahir]').val(data['tempatlahir']).change();;
      $modal.find('input[name=tanggallahir]').val(data['tanggallahir']).change();;
      $modal.find('select[name=jeniskelamin]').val(data['jeniskelamin']).change();
      $modal.find('input[name=alamat]').val(data['alamat']).change();;
      $modal.find('input[name=nohp]').val(data['nohp']).change();

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
      oTable = $("#datatables").DataTable({
          select:{
              className: 'dataTable-selector form-select'
          },
          
          processing: true,
          serverSide: true,
          ajax: {type: "POST", url: '{{route("pegawai.data")}}', data:{'_token':@json(csrf_token())}},
          columns: [
              { data:'id', title:'ID', visible: false},
              { data:'nik', title:'NIK'},
              { data:'nama', title:'Nama'},
              { data:'jeniskelamin', title:'JenisKelamin', visible: false},
              { data:'nohp', title:'No. HP'},
              { data:'tempatlahir', title:'TempatLahir', visible: false},
              { data:'tanggallahir', title:'TanggalLahir', visible: false},
              { data:'alamat', title:'Alamat', visible: false},
              { data:'action', title:'Aksi', width:'15%'},
          ],
      });
  });
</script>
@endsection