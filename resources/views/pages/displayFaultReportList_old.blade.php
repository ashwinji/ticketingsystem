@extends('layouts.masters')
@section('content')


<div class="body">
<div class="table-responsive">


    <table  class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
        <tr>
           <th>Ticket id</th>
            <th>Client Name</th>
            <th>Client Ticket No</th>
            <th>Region</th>
            <th>Date/Time Fault Escalated(opening time)</th>
            <th>Opening NOC operator</th>
            <th>Field Engg</th>
            <th>Link Affected</th>
            
            
            <th>Time Cleared(Resolution time)</th>
            <th>Closing Noc engineer</th>
            <th>Nature of Fault</th>
            <th>Access Request</th>
            <th>Security Escort </th>
            <th>SLA</th>
            
            <th>Resolution Remark</th>
            
           
           
        </tr>
    </thead>
    <tbody>
        
           @foreach($fulldata as $row)
           <tr>
            <td>
                {{$row->ticket_id}}
            </td>
<td>
                {{$row->clientname}}
            </td>
            <td>
                {{ $row->clientticketno }}
            </td> 
             <td>
                {{$row->region}}
            </td>
             <td>
                {{$row->opening_time}}
            </td>
            <td>
                {{$row->openingnoc}}<?php echo ' '; ?>{{$row->openingnocsurname}}
            </td>
            <td>
                @foreach($empdata as $key=>$value)
                  @if($key == $row->employee_id)
                {{$value}}
                  @else
                  @endif
                @endforeach
            </td>
            <td>
                {{$row->link_affected}}
            </td>
            
           
           
            
            
            <td>{{$row->resolution_time}}</td>
              <td>
                {{$row->closingnoc}}<?php echo ' '; ?>{{$row->closingnocsurname}}
            </td>

              <td>
                {{$row->cause_of_fault}}
            </td>
            <td>
                <?php
                
            $accreq = $row->acc_request_time; 
            $accgra   = $row->acc_granted_time; 
            $dteStart2 = new DateTime($accreq); 
            $dteEnd2   = new DateTime($accgra); 
            $accDiffs  = $dteEnd2->diff($dteStart2); 
              print $accDiffs->format("%a days %H hrs %i mins");  
                 ?>

            </td>
            <td>
                <?php
              //  $prevesctime=0;
            $escreq = $row->escort_request_time; 
            $escgra   = $row->escort_granted_time; 
            $dteStart2 = new DateTime($escreq); 
            $dteEnd2   = new DateTime($escgra); 
            $escDiffs  = $dteEnd2->diff($dteStart2); 
            
            //$prevesctime=$prevesctime+$escDiffs;
               print $escDiffs->format("%a days %H hrs %i mins");  
             // print $prevesctime->format("%a days %H hrs %i mins");  

                 ?>
                 
            </td>


            <?php
                            $pendingmins = $row->pendingtime_min;
                            $ttm =0;$tth=0;$ttd=0;
                            if($pendingmins>1440)
                            {
                                 $ttd = round($pendingmins/60,0);
                                 $ttd = $ttd/24;

                                $x = $pendingmins%60;
                                  if($x>60)
                                  {
                                    $tth = round($x/60,0);
                                    $tth = $tth/60;
                                    $y = $x%60;
                                    $ttm = $y;
                                  }
                                  else
                                  {
                                    $tth =0;
                                    $ttm = $x;
                                  }
                            }
                            // echo $ttd.'=='.$tth.'==aa'.$ttm;die;
                            $strStart2 = $row->opening_time; 
                            $strEnd2   = $row->resolution_time; 
                            $dteStart2 = new DateTime($strStart2); 
                            $dteEnd2   = new DateTime($strEnd2);
                            $dteDiffs2  = $dteStart2->diff($dteEnd2);

                            $ttd2 = $dteDiffs2->format("%a");// days %H hrs %i min");
                            $tth2 = $dteDiffs2->format("%H");
                            $ttm2 = $dteDiffs2->format("%i");
                             if($ttm > $ttm2)
                             {  $a = $ttm-$ttm2;
                                $ttm2 = $a+$ttm;
                                $tth2 = $tth2-1;
                             }
                             else
                             {  $ttm2 = $ttm2-$ttm;   }
                             if($tth>$tth2)
                             {  $b = $tth-$tth2;
                                $tth2 = $b+$tth;
                                $ttd2 = $ttd2-1;     }
                             else
                             {  if($tth !=0){
                                  $tth2 = $tth2-1;}
                             }
                             if($ttd !=0)
                             {  $ttd2 = $ttd2-$ttd;
                             }

            ?>
            <td><?php echo $ttd2.' days '.$tth2.' hrs '.$ttm2.' mins '; //print $dteDiffs2->format("%a days %H hrs %i min").'______'  ?></td>
              
            <td>
                {{$row->resolution_remark}}
            </td>
            
            
            </tr>
            @endforeach
        
       </tbody> 
    </table>
</div>
</div>
@endsection
