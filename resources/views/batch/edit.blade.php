@extends('layouts.app')

@section('content')
    <div id="page-head">

    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Batch</h3>
                    </div>

                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="POST" action="{{ url('/batches', ['id' => $batch->batch_id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="panel-body">                           
                            <div class="row">
                                <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('wine_id') ? ' has-error' : '' }}">
                                                <label class="control-label">Wine Id</label>
                                                <input name="wine_id" type="text" class="form-control" value="{{ $batch->wine_id }}">
                                                @if ($errors->has('wine_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('wine_id') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('vintage') ? ' has-error' : '' }}">
                                                <label class="control-label">Vintage</label>
                                                <input  name="vintage" type="number" class="form-control" value="{{  $batch->vintage  }}">
                                                @if ($errors->has('vintage'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('vintage') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $errors->has('varietal') ? ' has-error' : '' }}">
                                                    <label class="control-label">Varietal</label>
                                                    <input name="varietal" type="text" class="form-control" value="{{ $batch->varietal }}">
                                                    @if ($errors->has('varietal'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('varietal') }}</strong>
                                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $errors->has('tank') ? ' has-error' : '' }}">
                                                    <label class="control-label">Tank Id</label>
                                                    <input  name="tank" type="text" class="form-control" value="{{  $batch->tank   }}">
                                                    @if ($errors->has('tank'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tank') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="row">
                                                <div class="col-sm-6 col-lg-6">
                                                            <div class="form-group {{ $errors->has('batch_size') ? ' has-error' : '' }}">
                                                                <label class="control-label">Batch Size</label>
                                                                <input name="batch_size" type="text" class="form-control" value="{{ $batch->batch_size }}">
                                                                @if ($errors->has('batch_size'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('batch_size') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>         
                                                        <div class="col-sm-2 col-lg-1">
                                                                <div class="form-group">
                                                                    <label class="control-label">&nbsp;</label>
                                                                    <select name="unit_id" class="form-control">
                                                                        <option value=""></option>
                                                                        @foreach($units as $unit)
                                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                                        @endforeach            
                                                                    </select>
                                                                </div>
                                                </div>                                       
                                        </div>                                           
                                                                               

                        </div>
                        <div class="panel-footer text-right">
                            <a href="/" class="btn btn-danger" type="submit">Cancel</a>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                    
                    <!--===================================================-->
                    <!--End Block Styled Form -->

                </div>

                
            </div>
        </div>

     
    </div>
    <!--===================================================-->
    <!--End page content-->

@endsection
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sensors</h4>
      </div>
      <div class="modal-body">
            
                    <!--Bordered Accordion-->
                    <!--===================================================-->
                    <div class="panel-group accordion" id="demo-acc-info-outline">
                        <div class="panel panel-bordered panel-info">
            
                            <!--Accordion title-->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-parent="#demo-acc-info-outline" data-toggle="collapse" href="#demo-acd-info-outline-1">Inactive Sensor(s)</a>
                                </h4>
                            </div>
            
                            <!--Accordion content-->
                            <div class="panel-collapse collapse in" id="demo-acd-info-outline-1">
                                <div class="panel-body">
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-bordered panel-success">
            
                            <!--Accordion title-->
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-parent="#demo-acc-info-outline" data-toggle="collapse" href="#demo-acd-info-outline-2">Active Sensor(s)</a>
                                </h4>
                            </div>
            
                            <!--Accordion content-->
                            <div class="panel-collapse collapse" id="demo-acd-info-outline-2">
                                <div class="panel-body">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--===================================================-->
                    <!--End Bordered Accordion-->
                                  
      </div>
    </div>
  </div>
</div>   