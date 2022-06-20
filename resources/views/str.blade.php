@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Data SIP
@endsection

@section('strStatus')
active
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">list_alt</i>
            </div>
            <h4 class="card-title">Data SIP</h4>
        </div>
        <div class="card-body">
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
    var oTable;
    var now = moment();

    // Datatable
    function showTable(){

        if ($.fn.dataTable.isDataTable('#datatables') ) {
            $('#datatables').DataTable().clear();
            $('#datatables').DataTable().destroy();
            $('#datatables').empty();
        }

        oTable = $("#datatables").DataTable({
            // select:{
            //     className: 'dataTable-selector form-select'
            // },
            // scrollX: isMobile?true:false,
            // stateSave: true,
            // searching: false,
            processing: true,
            serverSide: true,
            ajax: {type: "POST", url: '{{route("data")}}', data:{'_token':@json(csrf_token())}},
            columns: [
                { data:'pegawai.nama', title:'Nama'},
                { data:'nomor', title:'Nomor SIP'},
                { data:'expiry', title:'Tanggal Exp.',  render: function(e,d,row){return moment(row['expiry']).format('L');} },
                { data:'expiry', title:'Status.',  render: function(e,d,row){
                    let exp = moment(row['expiry']);
                    let days = exp.diff(now, 'days');

                    if(days <= 0){
                        return '<span class="text-danger">Expired</span>'
                    }else if(days < 60){
                        return '<span class="text-warning">Akan Expired</span>'
                    }else{
                        return '<span class="text-success">Valid</span>'
                    }
                }},
                { data:'id', title:'Aksi', class:"text-right", render: function(e,d,row){
                    return '<a href="{{route("bio")}}?nakes='+row['id']+'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i> Cek</a>'
                }},
            ],
            createdRow: function (row, data, dataIndex) {
                let exp = moment(data['expiry']);
                let days = exp.diff(now, 'days');

                if(days <= 0){
                    $(row).addClass('is-expired');
                }
            },
        });
    }

    $(document).ready(function(){
        showTable(); 
    });
</script>
@endsection