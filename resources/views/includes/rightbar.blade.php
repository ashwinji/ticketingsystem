<aside id="minirightbar" class="minirightbar">
    <ul class="menu_list">
        <li>
            <div class="image">
                <a href="{{route('edit-profile')}}">
                    @if(empty(Auth::user()->avatar))
                    <img src="{{url('/')}}/assets/images/profile_av.jpg" alt="{{Auth::user()->name}}" data-toggle="tooltip" data-placement="left" title="{{Auth::user()->name}} {{Auth::user()->lastName}}">
                    @else
                    <img src="{{url('/')}}/assets/images/uploads/avatar/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" data-toggle="tooltip" data-placement="left" title="{{Auth::user()->name}} {{Auth::user()->lastName}}">
                    @endif
                </a>
            </div>
        <li>
        <li><a href="{{route('edit-profile')}}" data-toggle="tooltip" data-placement="left" title="Edit Profile"><i class="fa fa-pencil-square-o"></i></a></li>
   <!--      <li class="menuapp-btn2"><a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Title"><i class="material-icons">accessibility</i></a></li> -->
        <li class=""><a href="{{ route('screenlock',['currtime'=>time(), 'id'=>Auth::user()->id ,'randnum'=>MD5(str_random(10))])}}" data-toggle="tooltip" data-placement="left" title="Lock Screen"><i class="material-icons">lock_outline</i></a></li>        

        <li class="power">        

            
             <a href="{{ route('sms_setting') }}" data-toggle="tooltip" data-placement="left" title="SMS Options" >
                <i class="zmdi zmdi-email-open zmdi-hc-fw"></i>
            </a>
           
            <a href="{{ route('knowledge-base-siteInfo') }}" data-toggle="tooltip" data-placement="left" title="Site Ids" >
                <i class="zmdi zmdi-assignment"></i>
            </a>

            <a href="{{ route('knowledge-base-contactlist') }}" data-toggle="tooltip" data-placement="left" title="Clients contact" >
                 <i class="zmdi zmdi-assignment"></i>
            </a>                    
            <a href="{{ route('knowledge-base-enggDriver') }}" data-toggle="tooltip" data-placement="left" title="Soliton Resources">
                <i class="zmdi zmdi-assignment"></i>
            </a>
             <a href="{{ route('knowledge-base-nofbis') }}" data-toggle="tooltip" data-placement="left" title="Maintenance List" >
                <i class="zmdi zmdi-assignment"></i>
            </a>


        </li>
    </ul>    
</aside>

<aside class="right_menu2">
    <div class="right-sidebar2">
        <div class="tab-content slim_scroll">
            <div class="tab-pane slideRight active">
                <div class="card">
                    <div class="header">
                        <h2><strong>Menu Name</h2>
                    </div>
                    <div class="body">
                        <ul class="list-unstyled menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                    <span>Right Menu</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                    <span>Right Menu</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                    <span>Right Menu</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>               
            </div>
        </div>
    </div>
</aside>