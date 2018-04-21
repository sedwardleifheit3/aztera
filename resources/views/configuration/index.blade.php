@extends('layouts.app')

@section('content')
    <div id="page-head"></div>
    <div id="page-content">
        <div class="panel">

            <div class="panel-heading">
                <h3 class="panel-title">Configurations</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                    <strong>Well Done!</strong>
                                    {{ Session::get('flash_message') }}
                            </div>
                        @endif
                    </div>                    
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                 <a data-toggle="tab" href="#system-tab" aria-expanded="true">System</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#dosing-point-tab" aria-expanded="false">Dosing Point</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#sensor-location-tab" aria-expanded="false">Sensor Physical Locations</a>
					         </li>
                             <li class="">
                                <a data-toggle="tab" href="#sensors-tab" aria-expanded="false">Sensors</a>
					         </li>
                            
                            <li class="">
                                <a data-toggle="tab" href="#user-tab" aria-expanded="false">User</a>
					         </li>
                        </ul>       
                        <div class="tab-content">
                            <div id="system-tab" class="tab-pane fade active in">
                                <form method="POST" action="{{ route('configurations.update', ['id' => 1]) }}" class=" form-horizontal form-padding">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
                                    <input type="hidden" name="system_config_group" value="system">
                                    <div class="form-group {{ $errors->has('recording_interval') ? ' has-error' : '' }}">
                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Recording Interval (seconds)</label>
                                        <div class="col-lg-2 col-md-9">
                                            <input type="number" class="form-control" name="recording_interval" value="{{ isset($system['recording_interval']) ? $system['recording_interval'] : "" }}"/>
                                        </div>
                                        @if ($errors->has('recording_interval'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('recording_interval') }}</strong>
                                            </span>
                                        @endif                                            
                                    
                                    </div>
                                    <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Language</label>
                                        <div class="col-lg-2 col-md-9">
                                            <input type="text" class="form-control" name="language" value="{{ isset($system['language']) ? $system['language'] : "" }}"/>
                                        </div>
                                        @if ($errors->has('language'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('language') }}</strong>
                                            </span>
                                        @endif                                            
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Date</label>
                                        <div class="col-lg-2 col-md-9">
                                            <p class="form-control-static">{{Carbon\Carbon::now()->format('D, j F Y')}}</p>                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Time</label>
                                        <div class="col-lg-2 col-md-9">
                                            <p class="form-control-static">{{Carbon\Carbon::now()->format('H:i:s e')}}</p>                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-3 text-right pull-right">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <div id="dosing-point-tab" class="tab-pane fade">
                                    <form method="POST" action="{{ route('configurations.update', ['id' => 1]) }}" class=" form-horizontal form-padding">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group  {{ $errors->has('dosing_point_gateway') ? ' has-error' : '' }}">
                                            <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Dosing Point Default Gateway</label>
                                            <div class="col-lg-2 col-md-9">
                                                <input type="text" class="ip-address-input form-control" name="dosing_point_gateway" value="{{ isset($system['dosing_point_gateway']) ? $system['dosing_point_gateway'] : "" }}"/>
                                            </div>
                                            @if ($errors->has('dosing_point_gateway'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dosing_point_gateway') }}</strong>
                                                </span>
                                            @endif                                            
                                        </div>
                                        <div class="form-group {{ $errors->has('dosing_point_subnet_mask') ? ' has-error' : '' }}">
                                            <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Dosing Point Subnet Mask</label>
                                            <div class="col-lg-2 col-md-9">
                                                <input type="text" class="ip-address-input form-control" name="dosing_point_subnet_mask" value="{{ isset($system['dosing_point_subnet_mask']) ? $system['dosing_point_subnet_mask'] : "" }}"/>
                                            </div>
                                            @if ($errors->has('dosing_point_subnet_mask'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dosing_point_subnet_mask') }}</strong>
                                                </span>
                                            @endif                                            
                                            
                                        </div>
    
                                        <div class="col-lg-2 col-md-3 col-sm-3 text-right pull-right">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </div>
                                    </form>                                
                            </div>

                            <div id="sensor-location-tab" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>MAC Address</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sensors as $sensor)
                                            <?php $sensorId = $sensor['sensor_id']; ?>
                                            <tr>
                                                <td> {{$sensorId}} </td>
                                                <td>{{$sensor['mac_address']}} </td>
                                                <td>{{$sensor['physical_location']}} </td>                                                    
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                            <div id="sensors-tab" class="tab-pane fade">
                                <form method="POST" action="{{ route('sensors.store') }}" class=" form-horizontal form-padding">
                                    {{ csrf_field() }}             
                                    <div class="panel-group accordion" id="sensors-accordion">
                                    @foreach($sensors as $sensor)    
                                        <?php $sensorId = $sensor['sensor_id']; ?>
                                        <?php 
                                            $stateId = $sensor['sensor_state_id']; 
                                            $statusColor = "panel-primary";
                                            $statusColor = ($stateId == 2) ?  "panel-success" : $statusColor;                                            
                                            $statusColor =  ($stateId > 2 && $stateId < 6) ?  "panel-warning" : $statusColor;                                            
                                            $statusColor =  ($stateId == 6) ?  "panel-danger" : $statusColor;                                            
                                        ?>
                   
                                        <div class="panel {{ $statusColor }}">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-parent="#sensors-accordion" data-toggle="collapse" href="#sensors-accordion-{{$sensorId}}" aria-expanded="false" class="collapsed"> {{ ucwords($sensor['sensor_type_name']) }}: {{ucwords($sensor['sensor_state_name'])}}, Dosing Rate: {{$sensor['dosing_rate'] }} mg/L/day</a>
                                                </h4>
                                            </div>
                                        
                                            <div class="panel-collapse collapse" id="sensors-accordion-{{$sensorId}}" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">MAC</label>
                                                        <div class="col-lg-2 col-md-9">
                                                            <p class="form-control-static">{{$sensor['mac_address'] }}</p>                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Batch ID</label>
                                                        <div class="col-lg-2 col-md-9">
                                                            <p class="form-control-static">{{$sensor['batch_id'] }}</p>                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group {{ $errors->has('information.' . $sensorId . '.physical_location') ? ' has-error ' : '' }}">
                                                            <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Physical Location</label>
                                                            <div class="col-lg-2 col-md-9">
                                                                <input placeholder="external" type="text" class="form-control" name="information[{{$sensorId}}][physical_location]" value="{{ isset($sensor['physical_location']) ? $sensor['physical_location'] : "" }}"/>
                                                            </div>
                                                            @if ($errors->has("information.{$sensorId}.physical_location"))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first("information.{$sensorId}.physical_location") }}</strong>
                                                                </span>
                                                            @endif                                                                                                    
                                                    </div>
                                                    <div class="form-group {{ $errors->has('information.' . $sensorId . '.max_period_length') ? ' has-error' : '' }}">
                                                            <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Max Period Length</label>
                                                            <div class="col-lg-2 col-md-9">
                                                                <div class="input-group mar-btm">
                                                                    <input placeholder="1000" type="number" class="form-control" name="information[{{$sensorId}}][max_period_length]" value="{{ isset($sensor['max_period_length']) ? $sensor['max_period_length'] : "" }}"/>
                                                                    <span class="input-group-addon">ms</span>
                                                                </div>                                                                
                                                            </div>
                                                            @if ($errors->has("information.{$sensorId}.max_period_length"))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first("information.{$sensorId}.max_period_length") }}</strong>
                                                                </span>
                                                            @endif                                                                                                    
                                                    </div>
                                                    <div class="form-group {{ $errors->has('information.' . $sensorId . '.max_over_flow_rate') ? ' has-error' : '' }}">
                                                            <label class=" col-lg-2 col-md-3 control-label text-left text-bold">Max Over Flow Rate</label>
                                                            <div class="col-lg-2 col-md-9">
                                                                <div class="input-group mar-btm">
                                                                    <input type="number" class="form-control" name="information[{{$sensorId}}][max_over_flow_rate]" value="{{ isset($sensor['max_over_flow_rate']) ? $sensor['max_over_flow_rate'] : "" }}"/>
                                                                    <span class="input-group-addon">%   </span>
                                                                </div>                                                                                                                                        
                                                            </div>
                                                            @if ($errors->has("information.{$sensorId}.max_over_flow_rate"))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first("information.{$sensorId}.max_over_flow_rate") }}</strong>
                                                                </span>
                                                            @endif                                                                                                    
                                                    </div>
                                                                                                                        
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                        
                                    </div>     
                                    <div class="col-lg-2 col-md-3 col-sm-3 text-right pull-right">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                        
                                </form>                               
                            </div>                            

                            
                            <div id="user-tab" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <a href="{{ route('users.create') }}" class=" btn btn-success"><i class="pli-plus"></i> Add New</a>
                                    </div>
                                </div>
                                <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>                                
                            </div>
                        </div>                                         
                    </div>
                </div>    
            </div>


        </div>

    </div>
@endsection
