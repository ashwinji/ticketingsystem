@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Website Setting</strong></h2>
                    <ul class="header-dropdown">
                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                            <ul class="dropdown-menu slideUp">
                                <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    
					{!! Form::open(array('route' => 'websitesettingupdate', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
					{!! Form::token() !!}
					{!! Form::hidden('old_logo',$websitesetting->website_logo,array('class'=>'form-control')) !!}
						<div class="row clearfix"> 
							<div class="col-md-6">
								<label for="website_logo">App Logo
								</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="{{url('/assets/images/')}}/{!! $websitesetting->website_logo !!}"> 
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-primary btn-file">
											<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
											{!! Form::file('website_logo',array('id'=>'website_logo','data-icon'=>'false', 'accept'=>'image/*')) !!}
											
										</span> 
									</div>
									@if($errors->first('website_logo')!='')
									<code>{{ $errors->first('website_logo') }}</code>
									@endif
								</div>
							</div>
						</div>
						<hr>

						<div class="row clearfix"> 
						<div class="col-md-6">
							<label for="website_name">App Name</label>
							{!! Form::text('website_name',$websitesetting->website_name,array('id'=>'website_name','class'=>'form-control', 'placeholder'=>'App Name', 'autocomplete'=>'off')) !!}
							@if($errors->first('website_name')!='')
							<code>{{ $errors->first('website_name') }}</code>
							@endif
						</div>

						<div class="col-md-6">
							<label for="locktimeout">Auto Lock Time (In Minute)</label>
							{!! Form::number('locktimeout',$websitesetting->locktimeout,array('id'=>'locktimeout','class'=>'form-control', 'placeholder'=>'Auto Lock Time', 'autocomplete'=>'off')) !!}
							@if($errors->first('locktimeout')!='')
							<code>{{ $errors->first('locktimeout') }}</code>
							@endif
						</div>

						<div class="col-md-6">
							<label for="email">Mail Send Email</label>
							{!! Form::email('email',$websitesetting->email,array('id'=>'email','class'=>'form-control', 'placeholder'=>'Mail Send Email', 'autocomplete'=>'off')) !!}
							@if($errors->first('email')!='')
							<code>{{ $errors->first('email') }}</code>
							@endif
						</div>

						<div class="col-md-6">
							<label for="address">Address</label>
							{!! Form::text('address',$websitesetting->address,array('id'=>'address','class'=>'form-control', 'placeholder'=>'Address', 'autocomplete'=>'off')) !!}
							@if($errors->first('address')!='')
							<code>{{ $errors->first('address') }}</code>
							@endif
						</div>

						<div class="col-md-6">
							<label for="mobilenum">Contact Number</label>
							{!! Form::text('mobilenum',$websitesetting->mobilenum,array('id'=>'mobilenum','class'=>'form-control', 'placeholder'=>'Contact Number', 'autocomplete'=>'off')) !!}
							@if($errors->first('mobilenum')!='')
							<code>{{ $errors->first('mobilenum') }}</code>
							@endif
						</div>

						<div class="col-md-6">
							<label for="openingTime">Opening & Closing Day - Time</label>
							{!! Form::text('openingTime',$websitesetting->openingTime,array('id'=>'openingTime','class'=>'form-control', 'placeholder'=>'Opening & Closing Day - Time', 'autocomplete'=>'off')) !!}
							@if($errors->first('openingTime')!='')
							<code>{{ $errors->first('openingTime') }}</code>
							@endif
						</div>
						<div class="col-md-6">
							<label for="sms_username">Username</label>
							{!! Form::text('sms_username',$websitesetting->sms_username,array('id'=>'sms_username','class'=>'form-control', 'placeholder'=>'username', 'autocomplete'=>'off')) !!}
							@if($errors->first('sms_username')!='')
							<code>{{ $errors->first('sms_usrname') }}</code>
							@endif
						</div>
						<div class="col-md-6">
							<label for="sms_senderid">Sender Id</label>
							{!! Form::text('sms_senderid',$websitesetting->sms_senderid,array('id'=>'sms_senderid','class'=>'form-control', 'placeholder'=>'Sender Id', 'autocomplete'=>'off')) !!}
							@if($errors->first('sms_senderid')!='')
							<code>{{ $errors->first('sms_senderid') }}</code>
							@endif
						</div>
						<div class="col-md-6">
							<label for="sms_passwrd">Password</label>
							{!! Form::text('sms_passwrd',$websitesetting->sms_passwrd,array('id'=>'sms_passwrd','class'=>'form-control', 'placeholder'=>'Password', 'autocomplete'=>'off')) !!}
							@if($errors->first('sms_passwrd')!='')
							<code>{{ $errors->first('sms_passwrd') }}</code>
							@endif
						</div>
						<div class="col-md-12">
							<label for="sms_message">Message</label>
							{!! Form::textarea('sms_message',$websitesetting->sms_message,array('id'=>'sms_message','class'=>'form-control', 'placeholder'=>'Message', 'autocomplete'=>'off','rows'=>'4')) !!}
							@if($errors->first('sms_message')!='')
							<code>{{ $errors->first('sms_message') }}</code>
							@endif
						</div>
						<div class="col-md-12">
							<label for="sms_after_four_hr">SMS after 4 hr</label>
							{!! Form::textarea('sms_after_four_hr',$websitesetting->sms_after_four_hr,array('id'=>'sms_after_four_hr','class'=>'form-control', 'placeholder'=>'Message', 'autocomplete'=>'off','rows'=>'4')) !!}
							@if($errors->first('sms_after_four_hr')!='')
							<code>{{ $errors->first('sms_after_four_hr') }}</code>
							@endif
						</div>
						<div class="col-md-12">
							<label for="sms_after_resolution">Message after Resolution</label>
							{!! Form::textarea('sms_after_resolution',$websitesetting->sms_after_resolution,array('id'=>'sms_after_resolution','class'=>'form-control', 'placeholder'=>'Message after resolution', 'autocomplete'=>'off','rows'=>'4')) !!}
							@if($errors->first('sms_after_resolution')!='')
							<code>{{ $errors->first('sms_after_resolution') }}</code>
							@endif
						</div>
						<div class="col-md-12">
							<label for="sms_after_everyhr">SLA Escalation sms to higher authorities</label>
							{!! Form::textarea('sms_after_everyhour',$websitesetting->sla_escalation_3hrs_sms,array('id'=>'sms_after_everyhour','class'=>'form-control', 'placeholder'=>'Message after every hour', 'autocomplete'=>'off','rows'=>'4')) !!}
							@if($errors->first('sms_after_resolution')!='')
							<code>{{ $errors->first('sms_after_everyhour') }}</code>
							@endif
						</div>

						<div class="col-md-12">
							<hr>
							<label class="text-danger">Social Site Link</label>
							<div class="row">
							<div class="col-md-6">
								<label for="fb_link">Facebook</label>
								{!! Form::text('fb_link',$websitesetting->fb_link,array('id'=>'fb_link','class'=>'form-control', 'placeholder'=>'Facebook', 'autocomplete'=>'off')) !!}
								@if($errors->first('fb_link')!='')
								<code>{{ $errors->first('fb_link') }}</code>
								@endif
							</div>

							<div class="col-md-6">
								<label for="tw_link">Twitter</label>
								{!! Form::text('tw_link',$websitesetting->tw_link,array('id'=>'tw_link','class'=>'form-control', 'placeholder'=>'Twitter', 'autocomplete'=>'off')) !!}
								@if($errors->first('tw_link')!='')
								<code>{{ $errors->first('tw_link') }}</code>
								@endif
							</div>

							<div class="col-md-6">
								<label for="li_link">Linked In</label>
								{!! Form::text('li_link',$websitesetting->li_link,array('id'=>'li_link','class'=>'form-control', 'placeholder'=>'Linked In', 'autocomplete'=>'off')) !!}
								@if($errors->first('li_link')!='')
								<code>{{ $errors->first('li_link') }}</code>
								@endif
							</div>

							<div class="col-md-6">
								<label for="yt_link">You tube</label>
								{!! Form::text('yt_link',$websitesetting->yt_link,array('id'=>'yt_link','class'=>'form-control', 'placeholder'=>'You tube', 'autocomplete'=>'off')) !!}
								@if($errors->first('yt_link')!='')
								<code>{{ $errors->first('yt_link') }}</code>
								@endif
							</div>

							<div class="col-md-6">
								<label for="in_link">Instgram</label>
								{!! Form::text('in_link',$websitesetting->in_link,array('id'=>'in_link','class'=>'form-control', 'placeholder'=>'Instgram', 'autocomplete'=>'off')) !!}
								@if($errors->first('in_link')!='')
								<code>{{ $errors->first('in_link') }}</code>
								@endif
							</div>

							<div class="col-md-6">
								<label for="gp_link">Google +</label>
								{!! Form::text('gp_link',$websitesetting->gp_link,array('id'=>'gp_link','class'=>'form-control', 'placeholder'=>'Google +', 'autocomplete'=>'off')) !!}
								@if($errors->first('gp_link')!='')
								<code>{{ $errors->first('gp_link') }}</code>
								@endif
							</div>

							</div>
						</div>

						<div class="col-md-12">
							<hr>
							<label for="ga">Google Analytics Code <small class="text-danger">(Without Script tag)</small></label>
							{!! Form::textarea('ga',$websitesetting->ga,array('id'=>'ga','class'=>'form-control', 'placeholder'=>'Google Analytics', 'autocomplete'=>'off','rows'=>'4')) !!}
							@if($errors->first('ga')!='')
							<code>{{ $errors->first('ga') }}</code>
							@endif
						</div>
						
						<div class="col-md-12 text-center">
							<hr>
							{!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
						</div>
					{!! Form::close() !!} 
                </div>
            </div>
        </div>
        <!-- Content Section End-->
    </div>
    <!-- Content Section End-->
</div>
    @endsection
    @section('extrajs')

    @endsection
