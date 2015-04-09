@section('meta')
<title>Invite Codes - Berdict</title>
@stop

@section('container')


<div class="container" style="min-height: 460px;">
    <div class="row">
		<div class="col-sm-6 col-sm-offset-3 invite-box">
			<h3>Invite Friends & Win Rewards</h3>
			<div style="font-size:13px;margin-bottom:10px">
				{{count($left)}} invite codes left. Use them wisely. 
			
				@if (Session::has('flash_error'))        
				
				<font id="flass_success" color="red"> {{ Session::get('flash_error') }} </font>
				@elseif (Session::has('flash_success'))  
				<font color="green"> {{ Session::get('flash_success') }}</font>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<div class="input-group pad0 col-xs-12">
							<input type="text" placeholder="Friend's email" id="invite-friend-email" name="email" maxlength="80" size="30" class="form-control" value="">					
						</div>
					</div>    
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<div class="input-group pad0 col-xs-12">
							<a href="#" class="btn btn-primary btn-lg btn-block" id="invite-friend-submit">Send Invite Code</a>
						</div>
					</div>    
				</div>
			</div>
		
			@if($used)
			<div class="row" style="">
				<div class="col-xs-12">
					<div class="col-xs-9 pad0">
						<m>Email Invites Sent</m>
					</div>    
					<div class="col-xs-3 pad0">
						<m>Status</m>
					</div>
					@foreach($used as $used)
					<div class="col-xs-9 pad0">
						{{$used->ic_friend_email}}
					</div>    
					<div class="col-xs-3 pad0">
						@if($used->ic_status==1)
							Used
						@else
							Not Used
						@endif
					</div> 
					@endforeach
				</div>
			</div>
			@endif
			
		</div>
		

		<div class="col-sm-6 col-sm-offset-3" style="text-align:center;">
		<br/>
			Invite 5 friends to win a free movie ticket  or  <br/> to upgrade your account to a "Movie Buff"
		</div>
    </div>	
</div>






@stop