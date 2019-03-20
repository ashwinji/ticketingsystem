@extends('layouts.masters')
@section('content')
@inject('service', 'App\library\InjectService')

<?php
//echo "<pre>";
//print_r($secondrows2);die;
?>
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
            <th>Pending Time</th>
            <th>Access Request</th>
            <th>Security Escort </th>
            <th>SLA</th>
            
            <th>Resolution Remark</th>
            
           
           
        </tr>
    </thead>
    <tbody>
          <!-- {{sizeof($secondrows2).sizeof($firstrows2).sizeof($accslt)}} -->
          
          <?php   $i = sizeof($firstrows2); 
           for($p=0;$p<$i;$p++) { ?>
           <tr>
            
              <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->ticket_id."</td>"; 
              }
              else
              {}
              ?>
            
            

                 <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->ClientData->name."</td>";
              }
              ?> 
            
                 <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->clientticketno."</td>";} ?>
            
                 <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->region."</td>"; } ?>
            

                 <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->created_at."</td>"; } ?>
           
            <?php 
            if(!empty($secondrows2[$p][0]))
            {
            
            if(strpos($secondrows2[$p][0]->noclist,'-')!== false)
              {
              $lstz = explode('-',$secondrows2[$p][0]->noclist);
              $qq1 = $lstz[0];
              echo "<td>".$service->getEmail($qq1)->name." ".$service->getEmail($qq1)->lastName."</td>";
             }
              else{
                  if($secondrows2[$p][0]->noclist != '')
                  {
                 $qq1 = $secondrows2[$p][0]->noclist;
                echo "<td>".$service->getEmail($qq1)->name." ".$service->getEmail($qq1)->lastName."</td>";
                  }
                  
              }

              }
             ?>
            
              <?php 
            if(!empty($secondrows2[$p][0])){
                
                             
               //$lst = explode('-',$secondrows2[$p][0]->emplist);
               //$qq = $lst[0]; 
           if(strpos($secondrows2[$p][0]->emplist,'-')!== false)
              {
              $lstm = explode('-',$secondrows2[$p][0]->emplist);
              $qq1 = $lstm[0];
              echo "<td>".$service->getEmail($qq1)->name." ".$service->getEmail($qq1)->lastName."</td>";
             }
              else{
                  if($secondrows2[$p][0]->emplist != '')
                  {
                  $qq1 = $secondrows2[$p][0]->noclist;
                echo "<td>".$service->getEmail($qq1)->name." ".$service->getEmail($qq1)->lastName."</td>";
                  }
                  
              }





              
              //echo "<td>".$service->getEmail($qq)->name." ".$service->getEmail($qq)->lastName."</td>"; 
            } 
                  ?>
            
                <?php if(!empty($firstrows2[$p][0]))
                {
                  echo "<td>".$firstrows2[$p][0]->link_affected."</td>";
                } else{} ?>
            
             <?php if(!empty($firstrows2[$p][0]))
                {echo "<td>".$firstrows2[$p][0]->resolution_time."</td>";} ?>
           
              <?php 
               if(!empty($secondrows2[$p][0])){
                 
                if(strpos($secondrows2[$p][0]->noclist,'-')!== false)
                 { 
                 $lst2 = explode('-',$secondrows2[$p][0]->noclist);
                 $lth2 = sizeof($lst2);

                 if($lth2==1){
                     $qq2 = $lst2[0];
                     
                 } else{
                     $zz = $lth2-1; $qq2 = $lst2[$zz];
                     
                    } 
                    
                    
                    
                echo "<td>".$service->getEmail($qq2)->name." ".$service->getEmail($qq2)->lastName."</td>"; 
               }
               else
               {
                   if($secondrows2[$p][0]->noclist != '')
                  {
                      $qqm = $secondrows2[$p][0]->noclist;
                      echo "<td>".$service->getEmail($qqm)->name." ".$service->getEmail($qqm)->lastName."</td>"; 
                  }
               }
                   
               }
               
                
                
                 ?>
            

            
                <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$firstrows2[$p][0]->cause_of_fault."</td>";} ?>


                <?php if(!empty($firstrows2[$p][0])){
                echo "<td>".$accslt[$p]['pendingtimelist'];
              } ?></td>
            <?php if(!empty($firstrows2[$p][0])){ echo "<td>".$accslt[$p]['ttlacc']."</td>"; } ?>
            <?php if(!empty($firstrows2[$p][0])){ echo "<td>".$accslt[$p]['ttlesc']."</td>"; } ?>
            <?php if(!empty($firstrows2[$p][0])){ echo "<td>".$accslt[$p]['accurateslt']."</td>"; } ?>
            <?php if(!empty($firstrows2[$p][0])){ echo "<td>".$firstrows2[$p][0]->resolution_remark."</td>"; } ?>
            
            
            </tr>
            <?php } ?>
        
       </tbody> 
    </table>
</div>
</div>
@endsection
