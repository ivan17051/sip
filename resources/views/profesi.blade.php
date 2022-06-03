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
                  <input class="form-check-input" type="checkbox" value=1 id="isparent" name="isparent"> Profesi
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
      <form class="form-horizontal input-margin-additional" id="formedit" method="POST" action="">
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
                  <input class="form-check-input" type="checkbox" id="isparent" name="isparent"> Profesi
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
              <div class="col text-right"><button class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#tambah">Tambah</button></div>
            </div>
          </h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                width="100%" style="width:100%">
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
                    <td>{{$key+1}}</td>
                    <td>{{$unit->nama}}</td>
                    <td>
                      @if($unit->isparent == 1)
                      <span class="badge badge-pill badge-success">Spesialisasi</span>
                      @endif
                    </td>
                    <td class="text-right">
                      @if($unit->isparent == 1)
                      <button class="btn btn-info btn-link" style="padding:5px;" onclick="show({{$unit->id}})"><i
                          class="material-icons">launch</i></button>&nbsp
                      @endif
                      <button type="button" class="btn btn-warning btn-link" style="padding:5px;"
                        onclick="edit({{$unit}})"><i class="material-icons">edit</i></button>&nbsp
                      <button type="button" class="btn btn-danger btn-link" style="padding:5px;"
                        onclick="hapus({{$unit->id}})"><i class="material-icons">close</i></button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="anim slide hidden" id="nakes-container">
            <a href="" class="btn btn-sm btn-warning" onclick="back()">Kembali</a>

            <div class="material-datatable">
              <table id="datatables2" class="table table-striped table-no-bordered table-hover">
                <thead>
                  <!-- <tr>
                    <th data-priority="2" style="width:30px;" class="disabled-sorting">No</th>
                    <th data-priority="1">Nama Spesialisasi</th>
                    <th data-priority="2" class="disabled-sorting text-right">Aksi</th>
                  </tr> -->
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
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
      
    } else{
      
    }
    
  });
  function back() {
    $('#nakes-container').addClass('hidden')
    $('#table-container').removeClass('hidden')
    if ($.fn.dataTable.isDataTable('#datatables2')) {
      $('#datatables2').DataTable().clear();
      $('#datatables2').DataTable().destroy();
      $('#datatables2').empty();
    }
  }

  function daftarNakes(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();

    $('#table-container').addClass('hidden')
    $('#nakes-container').removeClass('hidden')
  }
  function show(x){
    $('#table-container').addClass('hidden');
    $('#nakes-container').removeClass('hidden');
    table2 = $('#datatables2').DataTable({
      ajax: {
        url: '{{route("spesialisasi.get", ["id"=>""])}}/'+x,
        dataSrc: ''
      },
      columns: [
        {data: 'id', title: 'No', width: '10%'},
        {data: 'nama', title: 'Nama Spesialisasi'},
        {data: 'id', title: 'Aksi', render: function(e,d,row){
          return '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="editspesial('+e+')"><i class="material-icons">edit</i></button>&nbsp'+
                  '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapusspesial('+e+')"><i class="material-icons">close</i></button>'
        }}
      ],
      columnDefs: [
        {   
            class: "details-control",
            orderable: false,
            targets: 0
        }
      ]
    });
    
  }

  function edit(data){
      var $modal=$('#sunting');
      
      $('#formedit').attr('action', '{{route("profesi.update", ["id"=>""])}}/'+data['id']);
      $modal.find('input[name=id]').val(data['id']);
      $modal.find('input[name=nama]').val(data['nama']).change();
      if(data['isparent']==1){
        $modal.find('input[name=isparent]').prop('checked', true);
      } else{
        $modal.find('input[name=isparent]').prop('checked', false);
      }
      
      $modal.modal('show');
  }

  function hapus(self){
    $modal=$('#hapus');
    var tr = $(self).closest('tr');
    let idx = oTable.row(tr)[0]
    var data = oTable.data()[idx];
    
    $modal.modal('show');
  }

  function editspesial(data){
      var $modal=$('#sunting');
      console.log(data['id']);
      
  }

  $(document).ready(function(){
      
      table = $('#datatables1').DataTable({
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