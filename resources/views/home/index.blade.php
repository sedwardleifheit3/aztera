@extends('layouts.app')

@section('content')
    <div id="page-head"></div>


    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-1 col-xs-4 col-sm-2"><h3 class="panel-title">Batches</h3></div>
                    <div class="col-lg-4 col-xs-4 col-sm-4">
                        <div class="pad-top">
                                <input name="is_archived" id="is-archived-checkbox" class="magic-checkbox" type="checkbox"/>
                                <label for="is-archived-checkbox"><strong>Show Archive</strong></label>
                        </div>
                    </div>
                </div>
                

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
                @ifUserIs('admin')
                    <div class="col-sm-6 col-lg-2">
                        <a href="{{ route('batches.create') }}" class=" btn btn-success"><i class="pli-plus"></i> Add New</a>
                    </div>   
                @endif       
                                                   
                </div>
               
                <table id="batches-table" class="text-center table table-striped table-bordered" cellspacing="0" width="100%"></table>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Add Row -->

    </div>
    <!--===================================================-->
    <!--End page content-->
@endsection
