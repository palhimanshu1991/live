@extends('master_blank')

@section('meta')
<title>Sign Up - Berdict</title>
@stop



@section('container')

@if($show==0)
<div class="container"  style="margin-bottom:60px;">
    <div class="row-lg-4 col-lg-offset-2" align="center" style="margin: 0px 0px 20px 0px">
        <a href="./"><img src="{{Config::get('url.home')}}public/berdict/img/p_berdict_s.png  " width="180px">  </a>               
    </div>
</div>
    <!---- Request Invite Form --->
    <div id="email_form" class="col-lg-4 col-lg-offset-4 m-t-lg" align="" style="">
        <div id="" class="" align="center" style="margin-bottom: 10px">
			This invite code is invalid. {{$error}}
        </div>

            <div class="form-group">
                {{ Form::email('email', '', array('class' => 'form-control' , 'id' => 'invite-email', 'placeholder' => 'Your email')) }}
            </div>

           <a class="btn btn-primary btn-lg btn-block" id="invite-submit" href="#">Request Invite</a>


    </div>
@elseif($show==1)
<div class="container"  style="margin-bottom:60px;">
    <div class="row-lg-4 col-lg-offset-2" align="center" style="margin: 0px 0px 20px 0px">
        <a href="./"><img src="{{Config::get('url.home')}}public/berdict/img/p_berdict_s.png  " width="200px">  </a>               
    </div>


    <div id="btn_signup" class="col-lg-4 col-lg-offset-4 m-t-lg" align="" style="">
        <button id="facebook_signup" onclick="Login()" type="button" class="btn btn-primary btn-lg btn-facebook btn-block">Signup With Facebook</button>
    </div>


    <!---- Email Form --->
    <div id="email_form" class="col-lg-4 col-lg-offset-4 m-t-lg" align="" style="">
        <div id="" class="" align="center" style="margin-bottom: 10px">
            Or Fill up the form
        </div>
        <form action="" method="POST" name="signup_form"  id="signup_form" class="ajax">
            <div class="form-group">
                <div><label for="firstname" class="">Full Name</label></div>
                {{ Form::text('name', '', array('class' => 'form-control' , 'id' => 'name', 'placeholder' => 'Your full name')) }}
            </div>

            <div class="form-group">
                <div><label for="firstname" class="">Email</label></div>
                {{ Form::email('email', '', array('class' => 'form-control' , 'id' => 'email', 'placeholder' => 'Your email')) }}
            </div>

            <div class="form-group">
                <div><label for="firstname" class="">Username</label></div>
                {{ Form::text('username', '', array('class' => 'form-control' , 'id' => 'username', 'placeholder' => 'Your username')) }}
            </div>

            <div class="form-group">
                <div><label for="firstname" class="">Password</label></div>
                {{ Form::password('password',  array('class' => 'form-control' , 'id' => 'password', 'placeholder' => 'Your password')) }}
            </div>        

            <div class="form-group">
                <div><label for="firstname" class="">Confirm Password</label></div>
                {{ Form::password('re_password',  array('class' => 'form-control' , 'id' => 're_password', 'placeholder' => 'Confirm password')) }}
            </div>

            {{ Form::submit('Create Account', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => '')) }}

            {{ Form::close() }} 

    </div>

    <!---- Facebook Form --->
    <div id="facebook_form" class="col-lg-4 col-lg-offset-4 m-t-lg" align="" style="display: none;">

        <form action="" method="POST" name="facebook_form" id="fb_form" class="ajax">

            <div class="form-group">
                <div class="label" for="name"></div>
                {{ Form::text('fb_username', '', array('class' => 'form-control' , 'id' => 'fb_username', 'placeholder' => 'Your username')) }}
            </div>

            <div class="form-group">
                {{ Form::email('fb_email', '', array('class' => 'form-control' , 'id' => 'fb_email', 'placeholder' => 'Your email')) }}
            </div>

            <div class="form-group">
                {{ Form::password('fb_pass',  array('class' => 'form-control' , 'id' => 'fb_pass', 'placeholder' => 'Your password')) }}
            </div>        

            <div class="form-group">
                {{ Form::password('re_fb_pass',  array('class' => 'form-control' , 'id' => 're_fb_pass', 'placeholder' => 'Confirm password')) }}
            </div>

            {{ Form::submit('Create Account', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => 'fb_submit')) }}

            {{ Form::close() }} 
    </div>

    <div id="signup_loading" class="col-lg-4 col-lg-offset-4 m-t-lg" align="" style="display:none;margin-top:12%">
        <div class="" align="center">
            <img class="" src="{{Config::get('url.home')}}public/berdict/img/progress.gif">
        </div> 
    </div>  
</div>
	
@endif

@stop