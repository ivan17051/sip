@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
MASTER FASKES
@endsection
<div class="modal modal-custom-1 fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Modal title</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
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
                    
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
