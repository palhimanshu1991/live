@extends('master_blank')

@section('meta')
<title>Login - Berdict</title>
@stop


@section('container')

<!-- check for login error flash var -->


<div class="container"  style="margin-top:5%;">
    <div class="col-md-4 col-md-offset-4 m-t-lg" align="" style="">

        <div class="row-md-4 col-md-offset-2" align="center" style="margin: 0px 0px 20px 0px">
            <a href="./"><img src="{{Config::get('url.home')}}public/berdict/img/p_berdict_s.png " width="180px">  </a>              
        </div>

        @if (Session::has('flash_error'))        
        <div class="row-sm-4 col-sm-offset-2" align="center" style="margin: 0px 0px 20px 0px">
            <div id="flash_error">{{ Session::get('flash_error') }}</div>          
        </div>        
        @endif


        {{ Form::open() }}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                {{ Form::text('username', '', array('class' => 'form-control' , 'id' => 'username', 'placeholder' => 'username or email')) }}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                {{ Form::password('password', array('class' => 'form-control' , 'id' => 'password', 'placeholder' => 'password')) }}
            </div>
        </div>

        {{ Form::submit('Login', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => 'review_submit')) }}

        {{ Form::close() }} 
    </div>


</div>



@stop