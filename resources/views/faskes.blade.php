@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Master Faskes
@endsection

@section('masterShow')
show
@endsection

@section('faskesStatus')
active
@endsection


@section('modal')
<div class="modal modal-custom-1 fade" id="modal-pratinjau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pratinjau Faskes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                UNDER DEVELOPMENT
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Faskes -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Fasilitas Kesehatan </h4>
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
                <label for="nama" class="bmd-label-floating">Nama Faskes</label>
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
<!--  End Modal Tambah Faskes -->

<!-- Modal Edit Faskes -->
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
<!-- End Modal Edit Faskes -->

@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data Fasilitas Kesehatan</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar row">
          <div class="col">
            <button class="btn btn-sm btn-warning" id="btnkembali" hidden onclick="back()">Kembali</button>
          </div>
          <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#tambah">Tambah</button></div>
          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover"
                width="100%" style="width:100%">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="anim slide hidden" id="nakes-container">
            
            <div class="table-responsive">
              <table id="datatables2" class="table">
                <thead>
                  <!-- <tr>
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>No. SIP</th>
                    <th>Tgl. Verif</th>
                    <th>Masa Berlaku</th>
                  </tr> -->
                </thead>
                <tbody>
                  <!-- <tr>
                    <td class="text-center">1</td>
                    <td>Andrew Mike</td>
                    <td>Develop</td>
                    <td>2013</td>
                    <td class="text-right">&euro; 99,225</td>
                  </tr> -->
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    var oTable;
    var now = moment();

    function pratinjau(self) {
        var tr = $(self).closest('tr');
        var data = oTable.row(tr).data();

        $('#modal-pratinjau').modal('show')
    }

    function daftarNakes(self) {
        var tr = $(self).closest('tr');
        var data = oTable.row(tr).data();

        $('#table-container').addClass('hidden')
        $('#nakes-container').removeClass('hidden')
        $('#btnkembali').attr('hidden', false);
        $('#btntambah').attr('hidden', true);

        aTable = $("#datatables2").DataTable({
            processing: true,
            serverSide: true,
            
            ajax: {
                type: "GET",
                url: '{{route("pegawai.get", ["id"=>""])}}/'+data['id'],
            },
            columns: [
              { data: 'pegawai.nama', title: 'Nama'},
              { data: 'pegawai.tanggallahir', title: 'Tempat, Tanggal Lahir', orderable: false,
                render: function(e,d,r) {
                  return r['pegawai']['tempatlahir']+', '+new Date(e).toLocaleDateString('id',{ day: 'numeric', month: 'long',year: 'numeric'})
                }
              },
              { data: 'nomor', title: 'No. SIP' },
              { data: 'tglverif', title: 'Tgl. Verif' },
              { data: 'expirystr', title: 'Masa Berlaku' },
              { data: 'action', title: 'Aksi', orderable: false, width: '5%'
                
              },
            ],
            columnDefs: [{
                    orderable: false,
                    responsivePriority: 2,
                    targets: 5
                }
            ]
        });
    }

    function back() {
        $('#nakes-container').addClass('hidden')
        $('#table-container').removeClass('hidden')
        $('#btnkembali').attr('hidden', true);
        $('#btntambah').attr('hidden', false);

        if ($.fn.dataTable.isDataTable('#datatables2')) {
          $('#datatables2').DataTable().clear();
          $('#datatables2').DataTable().destroy();
          $('#datatables2').empty();
        }
    }

    // Datatable
    function showTable() {

        if ($.fn.dataTable.isDataTable('#datatables')) {
            $('#datatables').DataTable().clear();
            $('#datatables').DataTable().destroy();
            $('#datatables').empty();
        }

        oTable = $("#datatables").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                type: "POST",
                url: '{{route("faskes.data")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            columns: [{
                    data: 'nama',
                    title: 'Faskes'
                },
                {
                    data: 'idkategori',
                    title: 'Tingkat',
                    render: function (e, d, r) {
                        return r['kategori']['nama']
                    }
                },
                {
                    data: 'alamat',
                    title: 'Alamat'
                },
                {
                    data: 'id',
                    title: 'Aksi',
                    class: "text-center",
                    width: 1,
                    orderable: false,
                    render: function (e, d, r) {
                        return '<span class="nav-item dropdown ">' +
                            '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<i class="material-icons">more_vert</i>' +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-left" >' +
                            '<a class="dropdown-item" href="#" onclick="pratinjau(this)" >Pratinjau</a>' +
                            '<a class="dropdown-item" href="#" onclick="daftarNakes(this)">Nakes Terkait</a>' +
                            '</div>' +
                            '</span>'
                    }
                },
            ],
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    orderable: false,
                    responsivePriority: 2,
                    targets: 3
                }
            ]
        });
    }

    $(document).ready(function () {
        showTable();
    });

</script>
@endsection
