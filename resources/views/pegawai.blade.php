@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Pegawai
@endsection

@section('masterShow')
show
@endsection

@section('modal')

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
          <h4 class="card-title">Data Pegawai</h4>
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
              { data:'nohp', title:'No. HP', visible: false},
              { data:'tempatlahir', title:'TempatLahir', visible: false},
              { data:'tanggallahir', title:'TanggalLahir', visible: false},
              { data:'alamat', title:'Alamat', visible: false},
              { data:'action', title:'Aksi'},
          ],
      });
  });
</script>
@endsection