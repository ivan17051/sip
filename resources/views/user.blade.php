@extends('layouts.layout')
@extends('layouts.sidebar')

@php
$role = Auth::user()->role;
@endphp

@section('title')
User
@endsection

@section('masterShow')
show
@endsection

@section('userStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah User </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('user.store')}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="username" class="bmd-label-floating">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <label class="bmd-label force-top mt-1">Role User <small class="text-danger align-text-top">*wajib</small></label>
            <select id="role" name="role" class="selectpicker form-control" data-size="7" data-style="btn btn-primary btn-round" title="Pilih Role">
                <option disabled selected>Pilih Role</option>
                <option>SDMK</option>
                <option>Promkes</option>
            </select>
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Sunting Data User </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('user.store')}}">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="username" class="bmd-label-floating">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <label class="bmd-label force-top mt-1">Role User <small class="text-danger align-text-top">*wajib</small></label>
            <select id="role" name="role" class="selectpicker form-control" data-size="7" data-style="btn btn-primary btn-round" title="Pilih Role">
                <option disabled selected>Pilih Role</option>
                <option>SDMK</option>
                <option>Promkes</option>
            </select>
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
<div class="modal fade modal-mini modal-primary" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
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
<!-- Modal Validasi -->
<div class="modal fade modal-mini modal-primary" id="modalValidasi" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <div class="modal-body text-center">
            <p id="peringatanValidasi"></p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-warning btn-link" onclick="$('#formValidasi').trigger('submit')">Ya
                <div class="ripple-container"></div>
            </button>
        </div>
        <form id="formValidasi" method="POST" action=""></form>
        </div>
    </div>
</div>
<!--  end modal Validasi -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data User</h4>
          </div>
        </div>
        <div class="card-body">
            <div class="toolbar text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
            
            <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                <tr>
                    <th hidden>id</th>
                    <th data-priority="1">Nama</th>
                    <th data-priority="2">Username</th>
                    <th data-priority="1">Role</th>
                    <th data-priority="2" class="disabled-sorting text-right">Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th class="disabled-sorting text-right">Actions</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($user as $key=>$unit)
                <tr>
                    <td hidden>{{$unit->id}}</td>
                    <td>{{$unit->nama}}</td>
                    <td>{{$unit->username}}</td>
                    <td>{{$unit->role}}</td>
                    <td class="text-right">
                        @if($unit->username=="admin")
                        <a href="#" class="btn btn-link btn-sm text-dark btn-just-icon disabled"><i class="material-icons">lock</i></a>
                        @else
                        <a href="#" class="btn btn-link btn-warning btn-just-icon edit btn-sm" key="{{$key}}" onclick="onEdit(this)"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon remove btn-sm" key="{{$key}}" onclick="onDelete(this)"><i class="material-icons">delete</i></a>
                        @endif
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
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('public/js/plugins/bootstrap-tagsinput.js')}}"></script>
<script>
var table;
var myUsers = @json($user);

//ketika klik edit
function onEdit(self) {
    var key = $(self).attr('key');
    var j = myUsers[key];
    
    $modal=$('#modalEdit');
    
    $modal.find('[name=id]').val(j['id']).change();
    $modal.find('[name=username]').val(j['username']).change();
    $modal.find('[name=nama]').val(j['nama']).change();
    $modal.find('[name=role]').val(j['role']).change().blur();
    
    $modal.find('form').attr('action', "{{route('user.update', ['id'=>''])}}/"+j['id']);
    $modal.modal('show');
} 

//ketika klik delete
function onDelete(self) {
    var key = $(self).attr('key');
    var j = myUsers[key];
    $modal=$('#modalDelete');

    $modal.find('form').attr('action', "{{route('user.destroy', ['id'=>''])}}/"+j['id']);
    $modal.modal('show');
} 

$(document).ready(function() {
    my.initFormExtendedDatetimepickers();
    if ($('.slider').length != 0) {
        md.initSliders();
    }

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

} );
</script>
@endsection