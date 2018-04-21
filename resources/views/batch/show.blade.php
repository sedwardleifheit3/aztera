@extends('layouts.app')


@section('content')
    <div id="page-head">
        <?php 
            $stateId = $batch['sensor_state_id']; 
            $statusColor = "btn-default";
            $statusColor = ($stateId == 2) ?  "btn-success" : $statusColor;                                            
            $statusColor =  ($stateId == 3) ?  "btn-warning" : $statusColor;                                            
            $statusColor =  ($stateId >= 4) ?  "btn-danger" : $statusColor;                                            
        ?>
    </div>

    <div id="page-content">
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
            </div>

        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <a href="{{ url('/') }}" class="btn back-btn btn-danger pull-left" type="submit">Back</a>
                        <h3 class="panel-title">
                            Batch #{{ $batch->id }} Information
                            @if(!empty($batch->sensor_state_name))
                            <div class="btn {{ $statusColor }}"> <strong>Status: </strong> {{ $batch->sensor_state_name . ' ('. $batch->sensor_state_description .')' }}   </button>      
                         @endif

                        </h3>
                    </div>

                    <div class="panel-body">
                            <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Wine Id:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-xs-6">
                                                    <p class="form-control-static">{{ $batch->wine_id }}</p>         
                                            </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Dosing Rate:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-xs-6">
                                                    <p class="form-control-static">{{ $batch->dosing_rate }} mg/L/day</p>         
                                            </div>
                                    </div>                                    
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Vintage:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-xs-6">
                                                    <p class="form-control-static">{{ $batch->vintage }}</p>         
                                            </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Total O2:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                    <p class="form-control-static">{{ $batch->current_o2 }} mg/L</p>         
                                            </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-6">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Varietal:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                    <p class="form-control-static">{{ $batch->varietal }}</p>         
                                            </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Time Remaining:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">                                              
                                                @if(!empty($batch->sensor_state_name))
                                                    <p class="form-control-static countdown">{{ \Carbon\Carbon::parse($batch->dose_end)->format('Y/m/d h:m:s')  }}</p>         
                                                @else
                                                    <p class="form-control-static countdown">{{ \Carbon\Carbon::now()->format('Y/m/d h:m:s')  }}</p>         
                                                @endif    
                                            </div>
                                    </div>                                    
                                    <div class="col-lg-6  col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Tank:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                    <p class="form-control-static">{{ $batch->tank }}</p>         
                                            </div>
                                    </div>
                                    <div class="col-lg-6  col-sm-6 col-xs-12">
                                            <div class="col-lg-2 col-sm-6 col-xs-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Batch Size:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                    <p class="form-control-static">{{ $batch->batch_size }}L</p>         
                                            </div>
                                    </div>   
                                    <?php /*                           
                                    <div class="col-lg-6  col-sm-6">
                                            <div class="col-lg-2 col-sm-6">
                                                <p class="form-control-static">
                                                    <label class="control-label text-left text-bold">Status:</label>
                                                </p>
                                            </div>
                                            <div class="col-lg-4">
                                                    @if(!empty($batch->sensor_state_name))
                                                        <p class="form-control-static">{{ $batch->sensor_state_name . ' ('. $batch->sensor_state_description .')' }}</p>         
                                                    @endif
                                            </div>
                                    </div>     
                                    */ ?>
                            </div>         
                        </div>
                        <div class="panel-footer text-right">
                            <button data-toggle="modal" data-target="#batch-analysis-modal"  class="btn btn-success"> 
                                <img class="img-icon"  src="/images/analysis.png" title="Current Analysis">                                         
                                Batch Analysis
                            </button>                            
                            @if(empty($batch->sensor_state_name))
                                <button data-toggle="modal" data-target="#attach-sensor-modal" class="btn btn-success">Attach Sensor</button>                            
                            @endif
                        </div>
                </div>
            </div>
        </div>
        <?php  /* Start Attached Sensors  -- hide if there's no attached sensor */ ?>
        @if(sizeof($attachedSensors) > 0)
            <h5 class="text-main pad-btm bord-btm"> Attached Sensor </h5>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    
                
                
                    <div class="panel-group accordion" id="sensors-accordion">
                            @foreach($attachedSensors as $sensor)    
                                <?php $sensorId = $sensor['sensor_id']; ?>
                                <?php 
                                    $stateId = $sensor['sensor_state_id']; 
                                    $statusColor = "panel-default";
                                    $statusColor = ($stateId == 2) ?  "panel-success" : $statusColor;                                            
                                    $statusColor =  ($stateId == 3) ?  "panel-warning" : $statusColor;                                            
                                    $statusColor =  ($stateId >=4 ) ?  "panel-danger" : $statusColor;                                            
                                ?>
        
                                <div class="panel {{ $statusColor }}">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                                <a aria-expanded="true" data-parent="#sensors-accordion"  href="javascript:;" aria-expanded="true" class="collapsed"> {{ ucwords($sensor['sensor_type_name']) }}: {{ucwords($sensor['sensor_state_name'])}}, Dosing Rate: {{$sensor['dosing_rate'] }} mg/L/day</a>
                                            </h4>
                                    </div>
                                
                                    <div class="panel-collapse collapse in" id="sensors-accordion-{{$sensorId}}" aria-expanded="true">
                                        <div class="panel-body">
                                            <form method="POST" action="{{ url('/sensors', ['id' => $sensorId]) }}" class=" form-horizontal form-padding">
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                                                        
                                                <input type="hidden" name="batch_id" value="{{ $batch->id }}">                                                                                        
                                                <div class="row"> 
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6 text-left text-bold">
                                                            <p class="form-control-static">
                                                                    MAC
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <p class="form-control-static">{{$sensor['mac_address'] }}</p>                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6  text-left text-bold">
                                                            <p class="form-control-static">
                                                                Batch ID
                                                            </p>    
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <p class="form-control-static">{{$sensor['batch_id'] }}</p>                                            
                                                        </div>
                                                    </div>    
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6 text-left text-bold">
                                                            <p class="form-control-static">
                                                                Physical Location
                                                            </p>    
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <p class="form-control-static"> {{ $sensor['physical_location'] }} </p>
                                                        </div>
                                                    </div>    
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">                                                            
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6 text-left text-bold">
                                                            <p class="form-control-static">
                                                                State
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <p class="form-control-static"> {{ ucwords($sensor['sensor_state_name']) }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6 text-left text-bold">
                                                            <p class="form-control-static">                                                                        
                                                                Dosing Rate
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <p class="form-control-static"> {{ $sensor['dosing_rate'] }} mg/L/day</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">                                                            
                                                        <div class=" col-lg-4 col-sm-6 col-xs-6 text-left text-bold">
                                                            <p class="form-control-static">  
                                                                Dosing Type
                                                            </p>
                                                        </div>                                                                        
                                                        <div class="col-lg-4  col-sm-6">
                                                            <p class="form-control-static"> {{ ucwords($sensor['sensor_type_name']) }}</p>
                                                        </div>
                                                    </div>           
                                                </div> 
                                                <?php /* START DOSING RATE FORM*/ ?>
                                                @if($stateId == 1)
                                                    <div class="row pad-top">
                                                        <hr/>
                                                        <div class="col-lg-12 col-sm-12 doserate-form">
                                                            <div class="form-group {{ $errors->has('dosing_rate') ? ' has-error' : '' }}">
                                                                <label class="pad-no col-xs-12 col-lg-2 control-label text-left text-bold">Dosing Rate</label>
                                                                <div class="pad-no col-lg-6 col-xs-8 ">
                                                                        <input step="0.0000001" min="0"  type="number" class=" form-control" name="dosing_rate" value="{{ isset($sensor['dosing_rate']) ? $sensor['dosing_rate'] : "" }}"/>                                                                                                                                                                                    
                                                                        @if ($errors->has("dosing_rate"))
                                                                        <span class="help-block"> <strong>{{ $errors->first("dosing_rate") }}</strong></span>
                                                                        @endif                                                                          
                                                                </div>
                                                                <div class="col-lg-2 col-xs-4">
                                                                    <select class="form-control" name="dosing_rate_unit">
                                                                        <option value=""></option>
                                                                        @foreach(\App\SensorInformation::getDosingRateUnits() as $key => $value)
                                                                            <option value="{{$key}}" @if($key == "mg/L/month" && empty($sensor['dosing_rate_unit'])) selected="selected" @elseif(($key == $sensor['dosing_rate_unit'])) selected="selected" @endif>{{$value}}</option>
                                                                        @endforeach    
                                                                    </select>                                                                                
                                                                </div>                                                                                                                                                      
                                                            </div>       
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-sm-12 doserate-form">
                                                            <div class="form-group {{ $errors->has('total_duration') ? ' has-error' : '' }}">
                                                                <label class=" pad-no col-xs-12 col-lg-2 control-label text-left text-bold">Duration</label>
                                                                <div class="pad-no col-lg-6 col-xs-8 ">
                                                                        <input type="number" min="0"  step="0.0000001" class="  form-control" name="total_duration" value="{{ isset($sensor['total_duration']) ? $sensor['total_duration'] : "" }}"/>
                                                                    
                                                                        @if ($errors->has("total_duration"))
                                                                        <span class="help-block"> <strong>{{ $errors->first("total_duration") }}</strong></span>
                                                                    @endif                                                                            
                                                                </div>
                                                                <div class="col-lg-2 col-xs-4">
                                                                    <select class="form-control" name="duration_unit">
                                                                        <option value=""></option>
                                                                        @foreach(\App\SensorInformation::getDurationUnits() as $key => $value)
                                                                            <option value="{{$key}}" @if($key == "seconds" && empty($sensor['duration_unit'])) selected="selected" @elseif(($key == $sensor['duration_unit'])) selected="selected" @endif>{{$value}}</option>                                                                        
                                                                        @endforeach    
                                                                                  
                                                                    </select>                                                                                
                                                                </div>
                                                                                                
                                                            </div>       
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="pad col-lg-12 col-xs-12 col-sm-12">
                                                            <button class="btn btn-success pull-right" type="submit">Save</button>
                                                        </div>                                                                    
                                                    </div>      
                                                @endif                                                                        
                                            </form> <!-- End Form-->
                                            <hr/>
                                            <div class="row">
                                                <div class="col-lg-12 pad-lg">
                                                        @if($stateId == 1)
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-fill-btn btn btn-primary btn-command btn-rounded">Fill</button>
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-empty-btn btn btn-info btn-command btn-rounded">Empty</button>
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-start-btn btn btn-success btn-command btn-rounded">Start</button>
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}" class="btn btn-dark sensor-detach-btn btn-rounded">Detach</button>                                                                        
                                                        @elseif ($stateId == 3)    
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-fill-btn btn btn-primary btn-command btn-rounded">Fill</button>
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-empty-btn btn btn-info btn-command btn-rounded">Empty</button>
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-stop-btn btn btn-danger btn-command btn-rounded">Stop</button>
                                                            <button  data-user-id="{{ Auth::id() }}"  data-sensor-id="{{$sensorId}}"  class="sensor-start-btn btn btn-success btn-command btn-rounded">Start</button>
                                                        @else    
                                                            <button  data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-stop-btn btn btn-danger btn-command btn-rounded">Stop</button>
                                                            <button data-user-id="{{ Auth::id() }}" data-sensor-id="{{$sensorId}}"  class="sensor-pause-btn btn btn-primary btn-warning btn-rounded">Pause</button>
                                                        @endif
                                                        
                                                </div>          
                                            </div>                                                                                                                                                                     
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                
                            </div>               
                    
                </div>
            </div> 
    

        <!-- Start charts/graphs panel -->
        <h5 class="text-main pad-btm bord-btm"> Graphs </h5>
        <?php $startDate = (Carbon\Carbon::now()->subDays(7))->format('Y-m-d'); ?>
        <?php $endDate = (Carbon\Carbon::now())->format('Y-m-d'); ?>
        <div class="row">
            <div class="col-sm-12 col-lg-6">                                  
                <div class="panel"> 
                    <div class="panel-heading">
                        <h3 class="panel-title">Dosing Rate</h3>
                    </div>                
                    <div class="panel-body">
                            <div class="row">
                                <div data-sensor_id="{{ $attachedSensors[0]['sensor_id'] }}" class="pad-btm col-lg-12 col-xs-12  col-sm-12 graph-dp-range" id="dosing-point-dates">
                                    <button data-date="{{ $startDate }}" class="dp-btn btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-range-start">{{  $startDate }}</button> 
                                    to
                                    <button data-date="{{  $endDate }}" class="dp-btn btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-range-end">{{  $endDate }}</button>
                                </div>  
                            </div>    
                            <div class="row">
                                <div class="col-lg-12 col-xs-12  col-sm-12">
                                    <div class="sensor-chart"  id="dosing-point-chart"></div>      
                                </div>                                                  
                            </div>               
                    </div>    
                </div>        
            </div>        
            <div class="col-sm-12 col-lg-6">                                  
                <div class="panel"> 
                    <div class="panel-heading">
                        <h3 class="panel-title">Dosed Amount</h3>
                    </div>                
                    <div class="panel-body">
                        <div data-sensor_id="{{ $attachedSensors[0]['sensor_id'] }}" class="pad-btm col-lg-12 col-xs-12  col-sm-12 graph-dp-range" id="dosed-amount-dates">
                            <button class="dp-btn btn-lg btn-labeled pli-calendar-4 btn btn-primary dp-da-start">{{  (Carbon\Carbon::now()->subDays(7))->format('Y-m-d')  }}</button> 
                                to 
                            <button class="dp-btn btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-da-end">{{  (Carbon\Carbon::now())->format('Y-m-d')  }}</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12  col-sm-12">
                                <div class="sensor-chart"  id="dosed-amount-chart"></div>      
                            </div>                                                  
                        </div>               
                    </div>    
                </div>        
             </div>       
            <div class="col-sm-12 col-lg-6">                                  
                    <div class="panel"> 
                        <div class="panel-heading">
                            <h3 class="panel-title">Temperature</h3>
                        </div>                
                        <div class="panel-body">
                            <div data-sensor_id="{{ $attachedSensors[0]['sensor_id'] }}" class="pad-btm col-lg-12 col-xs-12  col-sm-12 graph-dp-range" id="temperature-dates">
                                <button class="dp-btn btn-lg btn-lg btn-labeled pli-calendar-4 btn btn-primary dp-t-start">{{  (Carbon\Carbon::now()->subDays(7))->format('Y-m-d')  }}</button> 
                                    to 
                                <button class="dp-btn btn-lg btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-t-end">{{  (Carbon\Carbon::now())->format('Y-m-d')  }}</button>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12  col-sm-12">
                                    <div class="sensor-chart"  id="temperature-chart"></div>      
                                </div>                                                  
                            </div>               
                        </div>    
                    </div>        
            </div>      
            <div class="col-sm-12 col-lg-6">                                  
                    <div class="panel"> 
                        <div class="panel-heading">
                            <h3 class="panel-title">Inlet Pressure</h3>
                        </div>                
                        <div class="panel-body">
                            <div data-sensor_id="{{ $attachedSensors[0]['sensor_id'] }}" class="pad-btm col-lg-12 col-xs-12  col-sm-12 graph-dp-range" id="inlet-pressure-dates">
                                <button class="dp-btn btn-lg btn-labeled pli-calendar-4 btn btn-primary dp-ip-start">{{  (Carbon\Carbon::now()->subDays(7))->format('Y-m-d')  }}</button> 
                                    to 
                                <button class="dp-btn  btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-ip-end">{{  (Carbon\Carbon::now())->format('Y-m-d')  }}</button>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12  col-sm-12">
                                    <div class="sensor-chart"  id="inlet-pressure-chart"></div>      
                                </div>                                                  
                            </div>               
                        </div>    
                    </div>        
            </div>    
            <div class="col-sm-12 col-lg-6">                                  
                    <div class="panel"> 
                        <div class="panel-heading">
                            <h3 class="panel-title">Outlet Pressure</h3>
                        </div>                
                        <div class="panel-body">
                            <div data-sensor_id="{{ $attachedSensors[0]['sensor_id'] }}" class="pad-btm col-lg-12 col-xs-12  col-sm-12 graph-dp-range" id="outlet-pressure-dates">
                                <button class="dp-btn btn-lg btn-labeled pli-calendar-4 btn btn-primary dp-op-start">{{  (Carbon\Carbon::now()->subDays(7))->format('Y-m-d')  }}</button> 
                                    to 
                                <button class="dp-btn btn-lg btn-labeled pli-calendar-4  btn btn-primary dp-op-end">{{  (Carbon\Carbon::now())->format('Y-m-d')  }}</button>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12  col-sm-12">
                                    <div class="sensor-chart"  id="outlet-pressure-chart"></div>      
                                </div>                                                  
                            </div>               
                        </div>    
                    </div>        
            </div>                                            
        </div>          
        @endif  
@endsection

<?php /* Attach Sensor Modal */ ?>
<div class="modal fade" id="attach-sensor-modal" tabindex="-1" role="dialog" aria-labelledby="attach-sensor-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sensors</h4>
            </div>
            <div class="modal-body">
                <div class="panel-group accordion" id="acc-info-outline">
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#acc-info-outline" data-toggle="collapse" href="#acd-info-outline-1">Inactive Sensor(s)</a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse in" id="acd-info-outline-1">
                            <div class="panel-body">                                
                                <table class="table table-hover table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Sensor</th>
                                            <th>Physical Location</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inActiveSensors as $inactiveSensor)
                                        <tr>
                                            <td>{{$inactiveSensor['sensor_type_name']}}</td>
                                            <td>{{$inactiveSensor['physical_location']}}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary sensor-attach-btn" data-batch-id="{{$batch->id}}" data-sensor-id="{{$inactiveSensor['sensor_id']}}">Attach</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-bordered panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-parent="#acc-info-outline" data-toggle="collapse" href="#acd-info-outline-2">Active Sensor(s)</a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="acd-info-outline-2">
                            <div class="panel-body">
                                <table class="table table-hover table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th>Sensor</th>
                                                    <th>Physical Location</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activeSensors as $activeSensor)
                                                <tr>
                                                    <td>{{$activeSensor['sensor_type_name']}}</td>
                                                    <td>{{$activeSensor['physical_location']}}</td>
                                                    <td>
                                                        <a href="javascript:;" class="btn btn-primary sensor-migrate-btn"  data-batch-id="{{$batch->id}}" data-sensor-id="{{$activeSensor['sensor_id']}}">Migrate</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>                                  
            </div>
        </div>
    </div>
</div>  

<?php /* Batch Analysis Modal */ ?>
<div class="modal fade" id="batch-analysis-modal" tabindex="-1" role="dialog" aria-labelledby="batch-analysis-modal">
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Batch Analysis</h4>
                </div>
                <?php $analysis = $batch->analysis;?>
                <div class="modal-body">
                    <div class="bootbox-body">
                        <div class="row"> 
                            <div class="col-md-12 ba-form-container"> 
                                <form id="batch-analysis-form"  method="POST" action="{{ url('/batch-analyses', ['id' => $batch->id]) }}"  class="form-horizontal" > 
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                                                        
                                    <input type="hidden" name="_method" value="PATCH">                                    
                                    <div class="form-group"> 
                                        <label class="col-md-4 col-xs-4 control-label" for="temperature">Temperature</label> 
                                        <div class="col-md-6 col-xs-8 input-group"> <input name="temperature" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->temperature) ? $analysis->temperature : ""}}"> 
                                            <span class="input-group-addon">(Kelvin)</span> 
                                        </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4 control-label" for="ph">pH</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="ph" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->ph) ? $analysis->ph : ""}}"> 
                                                <span class="input-group-addon">(pH)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="alchohol">Alchohol</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="alchohol" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->alchohol) ? $analysis->alchohol : ""}}"> 
                                                <span class="input-group-addon">(% v/v)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="dissolved_oxygen">Dissolved Oxygen</label> 
                                            <div class="col-md-6 col-xs-8 input-group"> <input name="dissolved_oxygen" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->dissolved_oxygen) ? $analysis->dissolved_oxygen : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="volatile_acidity">Volatile Acidity</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="volatile_acidity" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->volatile_acidity) ? $analysis->volatile_acidity : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="co2_level">CO2 Level</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="co2_level" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->co2_level) ? $analysis->co2_level : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="free_so2">Free SO2</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="free_so2" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->free_so2) ? $analysis->free_so2 : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="total_so2">Total SO2</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="total_so2" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->total_so2) ? $analysis->total_so2 : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="malic_acid">Malic Acid</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="malic_acid" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->malic_acid) ? $analysis->malic_acid : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="tartaric_acid">Tartaric Acid</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="tartaric_acid" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->tartaric_acid) ? $analysis->tartaric_acid : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="lactic_acid">Lactic Acid</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="lactic_acid" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->lactic_acid) ? $analysis->lactic_acid : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="gluconic_acid">Gluconic Acid</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="gluconic_acid" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->gluconic_acid) ? $analysis->gluconic_acid : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="titratable_acidity">Titratable Acidity</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="titratable_acidity" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->titratable_acidity) ? $analysis->titratable_acidity : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="conductivity">Conductivity</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="conductivity" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->conductivity) ? $analysis->conductivity : ""}}"> 
                                                <span class="input-group-addon">(μS)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="acetaldehyde">Acetaldehyde</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="acetaldehyde" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->acetaldehyde) ? $analysis->acetaldehyde : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="assimble_amino_nitrogen">Assimible Amino Nitrogen</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="assimble_amino_nitrogen" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->assimble_amino_nitrogen) ? $analysis->assimble_amino_nitrogen : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="ammonia_nitrogen">Ammonia Nitrogen</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="ammonia_nitrogen" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->ammonia_nitrogen) ? $analysis->ammonia_nitrogen : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4   col-xs-4 control-label" for="yeast_assimble_nitrogen">Yeast Assimible Nitrogen</label> 
                                            <div class="col-md-6  col-xs-8 input-group"> <input name="yeast_assimble_nitrogen" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->yeast_assimble_nitrogen) ? $analysis->yeast_assimble_nitrogen : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="glucose_fructose">Glucose+Fructose</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="glucose_fructose" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->glucose_fructose) ? $analysis->glucose_fructose : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="od280_au">od280</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="od280_au" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->od280_au) ? $analysis->od280_au : ""}}"> 
                                                <span class="input-group-addon">(au)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="od280_mg_l">od280</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="od280_mg_l" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->od280_mg_l) ? $analysis->od280_mg_l : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="od420">od420</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="od420" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->od420) ? $analysis->od420 : ""}}"> 
                                                <span class="input-group-addon">(au)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="od520">od520</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="od520" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->od520) ? $analysis->od520 : ""}}"> 
                                                <span class="input-group-addon">(au)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="od620">od620</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="od620" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->od620) ? $analysis->od620 : ""}}"> 
                                                <span class="input-group-addon">(au)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="copper">Copper</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="copper" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->copper) ? $analysis->copper : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="iron">Iron</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="iron" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->iron) ? $analysis->iron : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="potassium">Potassium</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="potassium" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->potassium) ? $analysis->potassium : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="sugar">Sugar</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="sugar" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->sugar) ? $analysis->sugar : ""}}"> 
                                                <span class="input-group-addon">(°Bx)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="turbidity">Turbidity</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="turbidity" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->turbidity) ? $analysis->turbidity : ""}}"> 
                                                <span class="input-group-addon">(NTU)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="total_anthocyanins">Total Anthocyanins</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="total_anthocyanins" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->total_anthocyanins) ? $analysis->total_anthocyanins : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="free_anthocyanins">Free Anthocyanins</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="free_anthocyanins" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->free_anthocyanins) ? $analysis->free_anthocyanins : ""}}"> 
                                                <span class="input-group-addon">(mg/L)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="total_phenolics_ipt">Total Phenolics - IPT</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="total_phenolics_ipt" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->total_phenolics_ipt) ? $analysis->total_phenolics_ipt : ""}}"> 
                                                <span class="input-group-addon">(au)</span> 
                                            </div> 
                                    </div>  
                                    <div class="form-group"> 
                                            <label class="col-md-4 col-xs-4  control-label" for="total_tannin">Total Tannin</label> 
                                            <div class="col-md-6 col-xs-8  input-group"> <input name="total_tannin" type="number" placeholder="0" class="form-control input-md" value="{{ isset($analysis->total_tannin) ? $analysis->total_tannin : ""}}"> 
                                                <span class="input-group-addon">(g/L)</span> 
                                            </div> 
                                    </div>                                                                                                
                                </form> 
                            </div> 
                        </div>    
                    </div>                    
                </div>
                           
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>                    
                    <button type="button" class="btn btn-success" data-batch-id="{{$batch->id}}" id="save-batch-analysis-btn">Save</button>                    
                </div>
            </div>
        </div>
    </div>  