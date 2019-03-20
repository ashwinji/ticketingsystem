@extends('layouts.masters')

@section('content')
<div class="content-body">
        <!-- Content Section Strat-->
        <style type="text/css">
            .dashboard-ul li{
                border: none;
            }
        </style>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card visitors-map">
                    <div class="header">
                        <div class="row">
                          <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <ul class="list-group dashboard-ul">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                 <h6><strong>Unresolved Ticket</strong></h6>
                                               <span class="badge-pill">{{$pendingticketcount}}</span>
                                            </li>

                                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                             <strong>Group</strong> 
                                                <span class="badge-pill"><strong>Open</strong></span>
                                              </li>
                                              <?php $i=0;//sizeof($servicelist); $j=0; ?>
                                              @foreach($servicelist2 as $srow)
                                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{  $servicename[$i] }}
                                                 
                                                <span class="badge-pill">{{$srow->total}}</span>
                                              </li>
                                              <?php $i++; ?>
                                              @endforeach
                                              <?php $j =$i;   ?>
                                              @for($j=$i;$j<sizeof($servicelist);$j++)

                                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{  $servicelist[$j]->name }}
                                                 
                                                <span class="badge-pill">0</span>
                                              </li>
                                              
                                              @endfor
                                              
                                              
                                        </ul>
                                    </div>                                  
                                </div>
                          </div>                         
                          <div class="col-md-6">
                              <ul class="list-group dashboard-ul">
                             <li class="list-group-item d-flex justify-content-between align-items-center"><strong> To-do : </strong></li>
                            @foreach($todolist as $row)
                            <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                
                             </li> -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$row->task_dtl}}

                            <span class="pull-right button-group">

                             @if($row->status == 'Pending')
                                <a href="{{route('markascomplete',array('id'=>$row->id))}}" class="btn-success" style="padding: 3px; border-radius: 5px;">  Mark as Complete  </a>
                             @else    
                             <a href="{{route('markaspending',array('id'=>$row->id))}}" class="btn-success" style="padding: 3px; border-radius: 5px;">  Mark as Pending  </a>
                              @endif
                                <!-- <a onclick="return ConfirmDelete()" href="{{ route('delete-todo',array('id'=>$row->id)) }}" class="btn-danger" style="padding: 3px; border-radius: 5px;"> Delete</a> -->
                            </span>
                            </li>
                            @endforeach
                        </ul>
                          </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div> 

        <!-- Content Section End-->
</div>
@endsection