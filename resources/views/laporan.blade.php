@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Laporan
@endsection

@section('laporanStatus')
active
@endsection

@section('modal')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Laporan</h4>
          </div>
        </div>
        
        <div class="card-body">
          <div class="toolbar row">
            <!-- Here you can write extra buttons/actions for the toolbar -->
          </div>
            <form method="get" action="/" class="form-horizontal">
              <div class="row">
                <label class="col-sm-2 col-form-label label-checkbox">Jenis Laporan</label>
                <div class="col-sm-10 checkbox-radios">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="option2" checked> Data Nakes Teregistrasi/Tersertifikasi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="option1"> Data Cetak Persetujuan Teknis
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="option2" checked> Data Tenaga Kesehatan di Fasyankes
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="option1"> Data Nakes per Profesi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">Nama Fasyankes</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="idkategori" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" title="Kategori">
                      <option disabled selected>Pilih Fasyankes</option>
                      @foreach($d['fasyankes'] as $unit)
                      <option value="{{$unit->id}}">{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              
            </form>
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

</script>
@endsection