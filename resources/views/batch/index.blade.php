@extends('layouts.app')

@section('content')
    <div id="page-head"></div>


    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Batch</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                <strong>Well Done!</strong>
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2">
                        <a href="{{ route('batch.create') }}" class=" btn btn-primary"><i class="pli-plus"></i> Add New</a>
                    </div>
                </div>
                <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Add Row -->

    </div>
    <!--===================================================-->
    <!--End page content-->
@endsection
