@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Master Faskes
@endsection
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
@section('modal')

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="subtitle-wrapper">
                        <h4 class="card-title">Faskes</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="anim slide" id="table-container">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="anim slide hidden" id="nakes-container">
                        <a href="#" onclick="back()">Kembali</a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Name</th>
                                        <th>Job Position</th>
                                        <th>Since</th>
                                        <th class="text-right">Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Andrew Mike</td>
                                        <td>Develop</td>
                                        <td>2013</td>
                                        <td class="text-right">&euro; 99,225</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>John Doe</td>
                                        <td>Design</td>
                                        <td>2012</td>
                                        <td class="text-right">&euro; 89,241</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Alex Mike</td>
                                        <td>Design</td>
                                        <td>2010</td>
                                        <td class="text-right">&euro; 92,144</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Mike Monday</td>
                                        <td>Marketing</td>
                                        <td>2013</td>
                                        <td class="text-right">&euro; 49,990</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Paul Dickens</td>
                                        <td>Communication</td>
                                        <td>2015</td>
                                        <td class="text-right">&euro; 69,201</td>
                                    </tr>
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
    }

    function back() {
        $('#nakes-container').addClass('hidden')
        $('#table-container').removeClass('hidden')
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
                    class: "text-right",
                    width: 1,
                    orderable: false,
                    render: function (e, d, r) {
                        return '<span class="nav-item dropdown ">' +
                            '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<i class="material-icons">more_horiz</i>' +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right" >' +
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
