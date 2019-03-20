@extends('layouts.masters')
@section('content')

<style type="text/css">
    .tab-headding{
            background-color: #2c3644;
            color: #ffffff;
    }
    .inner-tab-headding{
        background-color: lightgray;
    }
</style>
<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>RFO reports</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>   
                                <?php
                                if(!empty($part35)){
                                    if($part35->resolution_time){ 
                                    $strStart2 = $part1->created_at; 
                                    $strEnd2   = $part35->resolution_time; 
                                    $dteStart2 = new DateTime($strStart2); 
                                    $dteEnd2   = new DateTime($strEnd2); 
                                    $dteDiffs2  = $dteStart2->diff($dteEnd2); 
                                    
                                    }
                                }
                                ?>              
            <div class="body" id="myprint" style="padding-top: 35px;">   
               <style type="text/css">
                   
                    @media print {.tab-headding{
                        box-shadow:  inset 0 0 0 1000px #2c3644 !important;
                        color: #ffffff;
                           -webkit-print-color-adjust: exact; 
                        }
                    }
                    @media print {
                        .inner-tab-headding{
                         box-shadow:  inset 0 0 0 1000px lightgray !important;
                        }
                    }
                @media print{
                          @page { margin: 0; }
                          body { margin: 1.5cm; }
                }
                </style>
                    <div class="col-md-12 logo text-center">
                         <img src="{{url('/')}}/assets/images/company_logo.png" alt="logo" width="140px">
                    </div>

                    <div class="table-responsive" >
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <tbody>  
                                <tr>
                                   <strong> # Ticket Number : {{ $part1->ticket_id }} </strong>
                                   <input type="hidden" id="docprinttktid" value="{{ $part1->ticket_id }}">
                                </tr>                                                                      
                                <tr>                                           
                                    <td colspan="8" class="tab-headding" ><strong>Part 1. Incident Report </strong></td>                
                                </tr>
                                <tr>
                                <td colspan="8"><strong>STATION/LINK :</strong> {{ $part1->link_affected }} </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="inner-tab-headding"><strong>Date Reported</strong></td>
                                    <td colspan="2" class="inner-tab-headding"><strong>Time Reported</strong></td>
                                    <td colspan="2" class="inner-tab-headding"><strong>Reported By</strong></td>
                                    <td colspan="2" class="inner-tab-headding"><strong>Designation</strong></td>
                                </tr>
                                <tr>
                                    <?php $lst = explode(' ',$part1->reporting_time); ?>
                                    <td colspan="2"><?php echo $lst[0]; ?></td>
                                    <td colspan="2"><?php echo $lst[1]; ?></td>
                                    <td colspan="2">{{ $part1->fault_reported_by}} </td>
                                    <td colspan="2">{{ $part1->Departmentsinfo->name}} </td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="tab-headding"><strong>Part 2. Soliton Staff assigned </strong></td>
                                </tr>  
                                <tr>
                                    <td colspan="1" class="inner-tab-headding">#</td>
                                    <td colspan="4" class="inner-tab-headding"><strong>Name</strong></td>
                                    <td colspan="3" class="inner-tab-headding"><strong>Designation</strong></td>
                                </tr>    
                                <tr>
                                    <td colspan="1">1.</td>
                                    <td colspan="4">{{ $part1->NOCUserinfo->name}} {{ $part1->NOCUserinfo->lastName}}</td>
                                    <td colspan="3">{{ $part1->Departmentsinfo->name}}</td>
                                </tr> 
                                   <!--  this data fetch by ticket update table behalf of ticket_id how many engg are assine to this task --> 
                                   <?php 
                                   $i= 2; ?>
                                     @foreach($part2 as $feName) 
                                     <tr>
                                        <td colspan="1"><?php echo $i++; ?>.</td>
                                        <td colspan="4">{{ $feName->Userinfo->name}} {{ $feName->Userinfo->lastName}}</td>

                                        @if($feName->Userinfo->userType == 1) 
                                                <?php $feDepartment = 'Network Operation Centre (NOC)';  ?>
                                        @elseif($feName->Userinfo->userType == 2)
                                                <?php $feDepartment = 'Service Centre';  ?>
                                        @elseif($feName->Userinfo->userType == 3)
                                                <?php $feDepartment = 'Field Engineer';  ?>
                                        @else
                                                <?php $feDepartment = 'Admin';  ?>
                                        @endif

                                        <td colspan="3">{!! $feDepartment !!}</td>
                                     </tr>
                                   @endforeach                                
                                    <!-- part 2  loop end here  -->
                                    <!-- part 3 natured of fault feached data in ticket closed table -->
                                <tr>
                                    <td colspan="8" class="tab-headding"><strong>Part 3. Nature Of Fault</strong> </td>
                                </tr>
                                 @if(!empty($part35))
                                <tr>
                                    <td colspan="4"><strong>NATURE OF FAULT</strong></td>
                                    <td colspan="4">{{ $part35->cause_of_fault }}</td>
                                </tr>
                                 @else
                                <tr>
                                     <td colspan="8">No record are found..</td>
                                </tr>
                                    @endif
                                    <!-- part 3 natured of fault section end here -->
                                    <!-- part 4 clears section data feached by ticket update table and same loop are used which in used in part2 section  -->
                                    <?php $p4 =1; ?>
                                <tr>
                                    <td colspan="8" class="tab-headding"><strong>Part 4. Clears </strong></td>
                                </tr>
                                <tr>
                                    <td colspan="1">#</td>
                                    <td colspan="7">Please provide Detailed Comments on your findings on this fault</td>
                                </tr>
                                   <?php $des = 0 ?>
                                 @foreach($part2 as $feName)
                                    <tr>
                                        <?php if($des==0){ 
                                        echo '</tr><tr><td colspan="1">'.$p4++.'</td><td colspan="7">'.$part1->created_at.'-'.$part1->description.'</td></tr><tr>';
                                        }else{} ?>

                                       <?php if($feName->comments == ''){} else{ ?>
                                        <!--<td colspan="1"><? //= $p4++; ?></td>
                                        <td colspan="7"><!-{{ $feName->opening_time }}  - {{ $feName->comments }} -> </td>-->

                                         <?php } ?>

                                    </tr> <?php $des++; //$p4++; ?>                            
                               @endforeach 
                               <!-- Ashwin     -->
                               
                               
                               <!--Juwekar -->
                               @foreach($partreply as $pRName)
                                    <tr>
                                        <td colspan="1"><?= $p4 ?></td>
                                        <td colspan="7">{{ $pRName->created_at }} - {{ $pRName->message }}</td>
                                        
                                    </tr>      <?php $p4++; ?>   
                                         

                               @endforeach 
                               <tr>
                                 <td colspan="8">
                                        @foreach($partreply as $pp)
                                        @if($pp->attachment=='')
                                            @else
                                            <a download="{{$pp->attachment}}" href="{!!URL('/')!!}/assets/images/uploads/{{ $pp->attachment }}" ><img height="500" width="485" src="{!!URL('/')!!}/assets/images/uploads/{{ $pp->attachment }}" alt="No image" title="click to download image" class="img-responsive"></a>
                                            @endif
                                        @endforeach
                                        </td>
                                </tr> 
                                <tr>
                                      <td colspan="8" class="tab-headding"><strong>Part 5. SLA ANALYSIS </strong></td> 
                                </tr>
                                <tr>
                                    <td  colspan="1"></td>
                                    <td  colspan="7">
                                        <p><strong>Fault Reported Time: </strong>{{ $part1->reporting_time}}</p>

                                        <p><strong>Fault Cleared Time: </strong> @if(!empty($part35)) {{ $part35->resolution_time }} @endif</p>

                                        <!-- <p><strong>Access Request:</strong>@if(!empty($accessRequestTime)) {{ $accessRequestTime }}  @endif</p> -->
                                         <?php if(!empty($ttlacc)){ ?>
                                        <p><strong>Access Request:</strong>{{$ttlacc}}</p>
                                        <?php }else{} ?>
                                        
                                        
                                        <!-- <p><strong>Security Escort:</strong>@if(!empty($escortRequestTime)) {{ $escortRequestTime }}  @endif</p> -->
                                        
                                        <?php if(!empty($ttlesc)){ ?>
                                        <p><strong>Security Request:</strong>{{$ttlesc}}</p>
                                        <?php }else{} ?>
                                        
                                        <p><strong>Pending Time:</strong>{{$totalpendingdaytime}}</p>
                                        
                                        
                        <p><strong>SLA TIME: </strong> <?php echo $accurateslt; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                     <td  colspan="1"> Resolution Remarks </td>
                                     <td  colspan="7">@if(!empty($part35))  {{ $part35->resolution_remark }} @endif</td>
                                </tr>


                                <tr>
                                      <td colspan="8" class="tab-headding"><strong>Part 6. Clearance Information </strong></td> 
                                </tr>
                                <tr>
                                    <td colspan="2" class="inner-tab-headding">Date Of Clearance </td>
                                    <td colspan="2" class="inner-tab-headding">Time Of Customer Clearance </td>
                                    <td colspan="2" class="inner-tab-headding">Clearance Officer </td>
                                    <td colspan="2" class="inner-tab-headding">Name of Client's officer Informed </td>
                                </tr>
                                @if(!empty($part35))
                                <tr>
                                    <?php $resoarray = explode(' ',$part35->resolution_time) ?>
                                    <td colspan="2">{{ $resoarray[0] }} </td>
                                    <td colspan="2">{{ $resoarray[1] }} </td>
                                    <td colspan="2">{{ $part35->NocEngginfo->name }} {{ $part35->NocEngginfo->lastName }} </td>
                                    <td colspan="2">{{ $part35->clearence_officer_onclient_side }} </td>
                                </tr>
                                @else
                                <tr>
                                     <td colspan="8">No record are found..</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>                         
                    </div>
                </div>
                <div class="printButton text-center">    
                    <button onclick="printRecord('myprint')" class="btn btn-primary">  PDF</button>
                    <button onclick="Export2Doc();" class="btn btn-primary">   Export to Doc</button>
                </div>          
    </div>
    <!-- Content Section End-->
</div>  

@endsection
@section('extrajs')

@endsection

<script>
    function Export2Doc(filename = ''){
                var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
                var postHtml = "</body></html>";
                var html = preHtml+document.getElementById('myprint').innerHTML+postHtml;
                var tktid = document.getElementById('docprinttktid').value;
                var blob = new Blob(['\ufeff', html], {
                    type: 'application/msword'
                });
                
                // Specify link url
                var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
                
                // Specify file name
                filename = tktid+'_RFO_report.doc';
                
                // Create download link element
                var downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);
                
                if(navigator.msSaveOrOpenBlob ){
                    navigator.msSaveOrOpenBlob(blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = url;
                    
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }
                
                document.body.removeChild(downloadLink);
            }
</script>