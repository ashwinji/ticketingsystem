<aside id="minileftbar" class="minileftbar bhoechie-tab-container">

    <ul class="menu_list">
        <li>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{url('/')}}/assets/images/{{$webSetting->website_logo}}" alt="{{$webSetting->website_name}}"></a>
        </li>          
        <li>
            <div class="bhoechie-tab-menu">
                <div class="list-group">
                    <a href="#" data-toggle="tooltip" data-placement="right" title="" class="list-group-item @if(Request::segment(1)==='home') active @endif text-center">
                     <img src="{{url('/')}}/assets/images/home.png" alt="Home"><p class="leftmenu-heading">Home</p>
                    </a>

                    <a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item text-center @if(
                    Request::segment(1)==='ticket-generated' ||
                    Request::segment(1)==='ticket-processing' ||
                    Request::segment(1)==='ticket-updates' || Request::segment(1)==='ticket-list') active @endif" title="">                    
                    <img src="{{url('/')}}/assets/images/ticket.png" alt="Ticket">
                    <p class="leftmenu-heading">Ticket</p> 
                    </a>

                    <a href="#" data-toggle="tooltip" data-placement="right" title="" class="list-group-item @if(Request::segment(1)==='ticket-report') active @endif text-center">
                    <img src="{{url('/')}}/assets/images/reports.png" alt="Report">
                    <p class="leftmenu-heading">Report</p>
                    </a>

                    <a href="#" data-toggle="tooltip" data-placement="right" title="" class="list-group-item @if(Request::segment(1)==='knowledge-base-siteInfo' || Request::segment(1)==='knowledge-base-contactlist' || Request::segment(1)==='knowledge-base-enggDriver' || Request::segment(1)==='knowledge-base-nofbis') active @endif text-center">
                        <img src="{{url('/')}}/assets/images/Knowledge.png" alt="Knowledge Base">
                            <p class="leftmenu-heading">KB</p>
                    </a>


                    <a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item text-center @if(
                    Request::segment(1)==='users' ||
                    Request::segment(1)==='service' ||
                    Request::segment(1)==='ticket-status' ||
                    Request::segment(1)==='client' ||
                    Request::segment(1)==='department') active @endif" title="">
                         <img src="{{url('/')}}/assets/images/user-add.png" alt="Masters"><p class="leftmenu-heading">Masters</p>
                    </a>
                    
                    <a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item text-center @if(
                    Request::segment(1)==='sms_setting') active @endif" title="">
                      <img src="{{url('/')}}/assets/images/sms.png" alt="SMS">
                     <p class="leftmenu-heading">SMS</p>
                    </a>


                    <a href="#" data-toggle="tooltip" data-placement="right" class="list-group-item text-center @if(Request::segment(1)==='roles' ||
                    Request::segment(1)==='permissions' ||
                    Request::segment(1)==='websitesetting') active @endif" title="">
                        <img src="{{url('/')}}/assets/images/Role.png" alt="Role"><p class="leftmenu-heading">Role</p>
                    </a>
                </div>
            </div>
        </li>

        <li class="power">
            <a href="javascript:void(0);" class="fullscreen" data-provide="fullscreen" data-toggle="tooltip" data-placement="right" title="Full Screen"><i class="zmdi zmdi-fullscreen"></i></a>
            <a href="javascript:void(0);" class="menu-sm" data-toggle="tooltip" data-placement="right" title="Collapse Menu"><i class="zmdi zmdi-swap"></i>
            </a>
            <a href="javascript:void(0);" class="js-right-sidebar" data-toggle="tooltip" data-placement="right" title="Settings"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a>            
            <a href="{{ route('applogout') }}" class="mega-menu" data-toggle="tooltip" data-placement="right" title="Logout"><i class="zmdi zmdi-power"></i></a>
        </li>
    </ul>    
</aside>

<aside class="right_menu">
    <div id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting">Setting</a></li>        
            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity">Activity</a></li> -->
        </ul>
        <div class="tab-content slim_scroll">
            <div class="tab-pane slideRight active" id="setting">
                <div class="card">
                    <div class="header">
                        <h2><strong>Colors</strong> Skins</h2>
                    </div>
                    <div class="body">
                        <ul class="choose-skin list-unstyled m-b-0">
                            <li data-theme="black" @if($service->getThemeClass()=='theme-black') class="active" @endif>
                                <div class="black"></div>
                            </li>
                            <li data-theme="purple" @if($service->getThemeClass()=='theme-purple') class="active" @endif> 
                                <div class="purple"></div>
                            </li>   
                             
                            <li data-theme="blue" @if($service->getThemeClass()=='theme-blue') class="active" @endif>
                                <div class="blue"></div>                    
                            </li>

                            <li data-theme="cyan" @if($service->getThemeClass()=='theme-cyan') class="active" @endif>
                                <div class="cyan"></div>
                            </li>
                            
                            <li data-theme="green" @if($service->getThemeClass()=='theme-green') class="active" @endif>
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange" @if($service->getThemeClass()=='theme-orange') class="active" @endif>
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush" @if($service->getThemeClass()=='theme-blush') class="active" @endif>
                                <div class="blush"></div>                    
                            </li>
                        </ul>
                    </div>
                </div>   

                <!-- <div class="card">
                    <div class="header">
                        <h2><strong>Left</strong> Menu</h2>
                    </div>
                    <div class="body theme-light-dark">
                        <button class="t-dark btn btn-primary btn-round btn-block">Dark</button>
                    </div>
                </div>  -->              
            </div>
            <div class="tab-pane slideLeft" id="activity">
                <div class="card activities">
                    <div class="header">
                        <h2><strong>Recent</strong> Activity Feed</h2>
                    </div>
                    <div class="body">
                        <div class="streamline b-accent">
                            <div class="sl-item">
                                <div class="sl-content">
                                    <div class="text-muted">Just now</div>
                                    <p>Finished task <a href="#" class="text-info">#features 4</a>.</p>
                                </div>
                            </div>                            
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="text-muted">1 Month ago</div>
                                    <p><a href="#" class="text-info">Jessi</a> commented your post.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Bar Tab-->
    <div id="leftsidebar" class="sidebar">
    <div class="menu">
        <div class="bhoechie-tab">
            <!-- imo section -->
            <div class="bhoechie-tab-content @if(Request::segment(1)==='home' || Request::segment(1)==='edit-profile' || Request::segment(1)==='infobalance') active @endif">
                <ul class="list list-inline">
                    <li class="header">Tickets</li>
                    <li class="@if(Request::segment(1)==='home') active open @endif"> <a href="{{route('home')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                    <li class="@if(Request::segment(1)==='infobalance') active open @endif"><a href="{{ route('infobalance') }}" ><i class="zmdi zmdi-balance-wallet"></i>
                          <span>Balance</span></a>
                    </li>
                    <li class="@if(Request::segment(1)==='infobalance') active open @endif"><a href="{{ route('edit-profile')}} " ><i class="zmdi zmdi-account"></i>
                          <span>Edit Profile</span></a>
                    </li>
                </ul>
            </div>
            <!-- tikcet section -->
       
           <div class="bhoechie-tab-content @if(Request::segment(1)==='ticket-generated' || Request::segment(1)==='ticket-processing' || Request::segment(1)==='ticket-updates' ||  Request::segment(1)==='ticket-list') active @endif">
                <ul class="list">
                    <li class="header">Tickets Status</li>
         
                    @can('open-ticket-list')
                    <li class="@if(Request::segment(1)==='ticket') active open @endif">
                        <a href="{{ route('ticket-processing') }}" data-toggle="tooltip" data-placement="right" title="Open Tickets"> <i class="zmdi zmdi-account-add"></i> <span>Open Tickets </span></a>
                    </li>
                    @endcan
           
                    @can('closed-ticket-list')
                       <li class="@if(Request::segment(1)==='ticket') active open @endif">
                        <a href="{{ route('ticket-list-closed') }}" data-toggle="tooltip" data-placement="right" title="Closed Tickets"> <i class="zmdi zmdi-close-circle-o"></i> <span>Closed Tickets </span></a>
                    </li>
                    @endcan

                    @can('pending-ticket-list')
                       <li class="@if(Request::segment(1)==='ticket') active open @endif">
                        <a href="{{ route('ticket-list-Pending') }}" data-toggle="tooltip" data-placement="right" title="Peding Tickets"> <i class="zmdi zmdi-refresh-sync"></i> <span>Pending Tickets </span></a>
                    </li>
                    @endcan
                    @can('cancelled-ticket-list')
                       <li class="@if(Request::segment(1)==='ticket') active open @endif">
                        <a href="{{ route('ticket-list-Cancelled') }}" data-toggle="tooltip" data-placement="right" title="Cancelled"> <i class="zmdi zmdi-scissors"></i> <span>Cancelled </span></a>
                    </li>
                    @endcan
                    <li class="@if(Request::segment(1)==='ticket') active open @endif">
                        <a href="{{ route('to-do-list') }}" data-toggle="tooltip" data-placement="right" title="To Do List"> <i class="zmdi zmdi-file"></i> <span>To Do List </span></a>
                    </li>
               </ul>
            </div>

            <!-- Ticket Report Genrate -->
            <div class="bhoechie-tab-content @if(Request::segment(1)==='ticket-report' || Request::segment(1)==='ticket-report-chart' || Request::segment(1)==='fault-report' || Request::segment(1)==='fault_ticket_page' || Request::segment(1)==='ticket-report-escort' || Request::segment(1)==='ticket-report-request-access' || Request::segment(1)==='ticket-report-faultAnalysis' ||  Request::segment(1)==='showfaultreportlist') active @endif">
                  <ul class="list">
                    <li class="header">Reports</li>
                    
                    <li class="@if(Request::segment(1)==='ticket-report') active open @endif">
                         @can('report-rfo')
                        <a href="{{ route('ticket-report-list') }}" ><i class="zmdi zmdi-assignment-account"></i><span>RFO reports</span></a>
                         @endcan
                    </li>   
                   
                  
                    <li class="@if(Request::segment(1)==='ticket-report-chart') active open @endif"> 
                         @can('report-mttr')
                           <a href="{{ route('ticket-report-FEchart') }}" ><i class="zmdi zmdi-collection-text"></i><span> MTTR for FEs</span></a>  
                         @endcan      
                    </li>
              
                    <li class="@if(Request::segment(1)==='fault-report' || Request::segment(1)==='fault_ticket_page' || Request::segment(1)==='showfaultreportlist') active open @endif"> 
                        @can('report-fault')
                         <a href="{{ route('fault-report') }}" ><i class="zmdi zmdi-file-text"></i><span> Fault Reports</span></a>   
                          @endcan                            
                    </li>
                 
                    <li class="@if(Request::segment(1)==='ticket-report-escort') active open @endif"> 
                         @can('report-escort')
                          <a href="{{ route('ticket-report-EscortView') }}" ><i class="zmdi zmdi-view-toc"></i><span> Escort Reports</span></a>
                         @endcan                                  
                    </li>
                
                    <li class="@if(Request::segment(1)==='ticket-report-request-access') active open @endif"> 
                        @can('report-access')
                         <a href="{{ route('ticket-report-Request-AccessView') }}" ><i class="zmdi zmdi-developer-board"></i><span> Access Reports</span></a>      
                        @endcan              
                    </li>
                  

                    <li class="@if(Request::segment(1)==='ticket-report-faultAnalysis') active open @endif"> 
                          @can('report-fault-analysis')
                         <a href="{{ route('ticket-report-faultAnalysis') }}" ><i class="zmdi zmdi-group"></i><span>Fault Analysis</span></a> 
                          @endcan                       
                    </li>
                 
                  
                   </ul>       
            </div>

        <!-- knowlege base -->
    <div class="bhoechie-tab-content @if(Request::segment(1)==='knowledge-base-siteInfo' || Request::segment(1)==='knowledge-base-contactlist' || Request::segment(1)==='knowledge-base-enggDriver' || Request::segment(1)==='knowledge-base-nofbis') active @endif">
                <ul class="list">
                    <li class="header">Knowledge Base</li>                   
                    <li class="@if(Request::segment(1)==='knowledge-base-siteInfo') active open @endif">
                        @can('kb-site-list')
                        <a href="{{ route('knowledge-base-siteInfo') }}" ><i class="zmdi zmdi-format-align-left"></i><span>Site Ids </span></a>
                        @endcan
                    </li> 
                      
                    <li class="@if(Request::segment(1)==='knowledge-base-contactlist') active open @endif">
                         @can('kb-client-list')
                        <a href="{{ route('knowledge-base-contactlist') }}" ><i class="zmdi zmdi-view-list"></i><span>Clients contact </span></a>
                         @endcan
                    </li> 
                     <li class="@if(Request::segment(1)==='knowledge-base-enggDriver') active open @endif">
                         @can('kb-soliton-list')
                        <a href="{{ route('knowledge-base-enggDriver') }}" ><i class="zmdi zmdi-view-list"></i><span>Soliton Resources </span></a>
                         @endcan
                    </li> 

                    <li class="@if(Request::segment(1)==='knowledge-base-nofbis') active open @endif">
                        @can('kb-maintenance-list')
                        <a href="{{ route('knowledge-base-nofbis') }}" ><i class="zmdi zmdi-view-list"></i><span>Maintenance List </span></a>
                         @endcan
                    </li>
                                   
                </ul>       
            </div>

    <!-- User Master  -->

            <div class="bhoechie-tab-content @if(Request::segment(1)==='users' || Request::segment(1)==='service' || Request::segment(1)==='natureoffault'|| Request::segment(1)==='ticket-status' || Request::segment(1)==='client' || Request::segment(1)==='department' || Request::segment(1)==='region-list') active @endif">
                <ul class="list">
                    <li class="header">Master</li>
                    @can('users-list')
                    <li class="@if(Request::segment(1)==='users') active open @endif">
                        <a href="{{ route('users-list') }}" data-toggle="tooltip" data-placement="right" title="Manage User"> <i class="zmdi zmdi-accounts-list-alt"></i> <span>User</span></a>
                    </li>
                    @endcan

                    @can('client-list')
                    <li class="@if(Request::segment(1)==='client') active open @endif">
                        <a href="{{ route('client-list') }}" data-toggle="tooltip" data-placement="right" title="Manage Client"> <i class="zmdi zmdi-accounts"></i> <span>Client</span></a>
                    </li>
                    @endcan

                    @can('service-list')
                    <li class="@if(Request::segment(1)==='service') active open @endif">
                        <a href="{{ route('service-list') }}" data-toggle="tooltip" data-placement="right" title="Manage Service"> <i class="zmdi zmdi-view-list"></i> <span>Service</span></a>
                    </li>
                    @endcan

                    
                     @can('natureoffault-list')
                    <li class="@if(Request::segment(1)==='natureoffault') active open @endif">
                        <a href="{{ route('natureoffault-list') }}" data-toggle="tooltip" data-placement="right" title="Nature Of Fault"> <i class="zmdi zmdi-view-list"></i> <span>Nature Of Fault</span></a>
                    </li>
                    @endcan

                    @can('ticket-status-list')
                    <li class="@if(Request::segment(1)==='ticket-status') active open @endif">
                        <a href="{{ route('ticket-status-list') }}" data-toggle="tooltip" data-placement="right" title="Manage Ticket Status"> <i class="zmdi zmdi-view-list"></i> <span>Ticket Status</span></a>
                    </li>
                    @endcan

                    @can('department-list')
                    <li class="@if(Request::segment(1)==='department') active open @endif">
                        <a href="{{ route('department-list') }}" data-toggle="tooltip" data-placement="right" title="Manage Department"> <i class="zmdi zmdi-view-list"></i> <span>Department Status</span></a>
                    </li>
                    @endcan

                    <li class="@if(Request::segment(1)==='region-list') active open @endif">
                        <a href="{{ route('region-list') }}" data-toggle="tooltip" data-placement="right" title="Regions List"> <i class="zmdi zmdi-gps-dot"></i><span>Regions List</span></a>
                    </li>                                       
                </ul>
            </div>

    <!-- SMS setting menu start here -->
    
       <div class="bhoechie-tab-content @if(Request::segment(1)==='sms_setting' ) active @endif">
                <ul class="list">
                    <li class="header">SMS Settings </li>                 
                    <li class="@if(Request::segment(1)==='sms_setting') active open @endif">
                    @can('sms-list')
                        <a href="{{ route('sms_setting') }}" data-toggle="tooltip" data-placement="right" title="SMS Options"> <i class="zmdi zmdi-settings"></i> <span>SMS Options</span></a>
                    @endcan
                    </li>                                    
                </ul>
        </div>

 <!-- SMS setting menu end here -->

            <div class="bhoechie-tab-content @if(Request::segment(1)==='roles' || Request::segment(1)==='permissions' || Request::segment(1)==='websitesetting') active @endif">
                <ul class="list">
                    <li class="header">Roles & Permissions</li>
                    @can('role-list')
                    <li class="@if(Request::segment(1)==='roles') active open @endif">
                        <a href="{{ route('roles.index') }}" data-toggle="tooltip" data-placement="right" title="Manage Role"> <i class="material-icons">accessible</i> <span>Manage Role</span></a>
                    </li>
                    @endcan
                    @can('permission-list')
                    <li class="@if(Request::segment(1)==='permissions') active open @endif">
                        <a href="{{ route('permissions.index') }}" data-toggle="tooltip" data-placement="right" title="Manage Permission"> <i class="material-icons">accessibility</i> <span>Manage Permission</span></a>
                    </li>
                    @endcan
                    @can('app-setting')
                    <li class="@if(Request::segment(1)==='websitesetting') active open @endif">
                        <a href="{{ route('websitesetting') }}" data-toggle="tooltip" data-placement="right" title="Website Setting"> <i class="material-icons">build</i> <span>Website Setting</span></a>
                    </li>
                    @endcan
                    
                </ul>
            </div>
        </div>

    </div>
</div>
    <!-- Menu Bar End-->
</aside>