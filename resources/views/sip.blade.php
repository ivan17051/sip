@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Detil SIP
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">account_balance_wallet</i>
            </div>
            <h4 class="card-title">Detil SIP</h4>
        </div>
        <div class="card-body">
        <div class="toolbar row">
                <div class="col">
                    
                </div>
                <div class="col-2 text-right">
                    <button class="btn btn-sm btn-success">dummy</button>
                </div>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                    <tr>
                        <th data-priority="1" width="1" class="disabled-sorting"></th>
                        <th data-priority="1">Tanggal</th>
                        <th data-priority="3">Uraian Transaksi</th>
                        <th data-priority="2" class="text-right">Debit</th>
                        <th data-priority="2" class="text-right">Kredit</th>
                        <th data-priority="1" class="text-right disabled-sorting">Saldo</th>
                    </tr>
                    </thead>
                    <tbody>
                  
                    </tbody>
                    <tfoot>
                   
                    </tfoot>
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
    var oTable;
    var now = moment();

    $(document).ready(function(){

    });
</script>
@endsection