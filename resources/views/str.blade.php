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
            <div class="filter-tags" data-select="#selectrole" data-tags="#tagsinput" data-col="3">
                <div class="form-group d-inline-block" style="width: 120px;">
                    <select id="selectrole" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" multiple title="Filter" data-size="7">
                        <option value="1">Valid</option>
                        <option value="0">Akan Expired</option>
                        <option value="-1">Expired</option>
                        <!-- <option value="-2">Belum memiliki SIP</option> -->
                    </select>
                </div>
                <div class="h-100 d-inline-block">
                    <input id="tagsinput" hidden type="text" value="" class="form-control tagsinput" data-role="tagsinput" data-size="md" data-color="primary" data-role="filter">
                </div>
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
            columnDefs: [{
                targets: '_all',
                defaultContent: ""
            }],
            columns: [
                { data:'nama', title:'Nama'},
                { data:'nomorsip', title:'Nomor SIP'},
                { data:'profesi', title:'Profesi'},
                { data:'expirystr', title:'Tanggal Exp.',  render: function(e,d,row){
                    if(!e) return '';
                    return moment(e).format('L');} 
                },
                { data:'validstatus', title:'Status', render: function(e,d,row){
                    switch (parseInt(e)) {
                        case -2:
                            return '<strong class="text-info">No SIP</strong>';
                        case -1:
                            return '<strong class="text-danger">Expired</strong>';
                        case 0:
                            return '<strong class="text-warning">Akan Expired</strong>';
                        default:
                            return '<strong>Valid</strong>';
                    }
                }},
                { data:'id', title:'Aksi', class:"text-right", render: function(e,d,row){
                    return '<a href="{{route("bio")}}?nakes='+e+'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i> Cek</a>'
                }},
            ],
            createdRow: function (row, data, dataIndex) {
                switch (parseInt(data['validstatus'])) {
                    case -2:
                        $(row).addClass('is-no-data');        
                    case -1:
                        $(row).addClass('is-expired');    
                        break;
                    case 0:
                        $(row).addClass('is-expired-soon');    
                        break;
                }
            },
        });
    }

    $(document).ready(function(){
        showTable(); 

        //event pada tags filter
        $(".filter-tags").each(function(){
            var sel= $($(this).data('select'));
            var put=$($(this).data('tags'));
            var col=parseInt($(this).data('col'));
            put.tagsinput('input').attr('hidden',true);
            
            // filter selectpicker on change
            sel.change(function(){
                put.tagsinput('removeAll');

                for (const opt of sel[0].selectedOptions) {
                    put.tagsinput('add', opt.textContent);
                }

                //search nya pakai regex misal "Pusat|Spesial" artinya boleh Pusat atau Spesial
                if(!sel.val().length){
                    oTable.column(col).search( '' ).draw();
                }
                else{
                    var searchStr='^('+sel.val().join('|')+')$';
                    oTable.column(col).search( searchStr , true, false).draw();
                }
            });

            // filter tags input on removed
            put.on('itemRemoved', function(event) {
                let text = event.item;
                let items = []
                for (const opt of sel[0].selectedOptions) {
                    if(opt.textContent != text){
                        items.push(opt.value)
                    }
                }
                sel.selectpicker('val', items);
            });
        });
    });
</script>
@endsection