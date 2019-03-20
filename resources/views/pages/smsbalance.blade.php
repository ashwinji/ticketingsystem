@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>
                            @if(Request::segment(2)==='create')
                                <!-- Create -->
                            @elseif(Request::segment(2)==='edit')
                                <!-- Edit -->
                            @else
                                <!-- Manage -->
                            @endif
                            Balance Details
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                     
                                   
                                </ul>
                            </li>
                        </ul>
                    </div>

            
                <div class="body">
                    Remaining Balance is
                    <h1>{{$balancedetails['currency']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$balancedetails['balance']}}</h1>
                    <h5>How to pay</h5>
                    <h5>Using you MPESA-enabled phone, select "send money" from the M-PESA Menu</h5>
                    <h5>Enter Phone no.0721489544</h5>
                    <h5>Enter the amount of Credits you want to buy</h5>
                    <h5>Confirm that all the details are correct and press OK </h5>
                 <h5>Check your statement to see your payment. Your account will be updated immediately</h5>

                    
                </div>
            
        </div>
    </div>
    <!-- Content Section End-->
</div>

@endsection
@section('extrajs')

@endsection
