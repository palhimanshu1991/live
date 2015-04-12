@extends('master_blank')

@section('meta')
<title>Berdict - short movie reviews from your friends and critics.</title>
<meta name="title" content="Berdict - Short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies, films, film reviews, critic reviews, movie reviews, berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />
@stop


@section('container')
<div class="" style="">
    <div class="container wrapper" style="min-height: 650px;">
        <div class="col-md-12 pbot ">   
            <div class="col-md-12 mtop2 mbot2" style="padding: 0px;text-align: center;">
                <h1><b>SignUp To Review Movies</b></h1>
                <div class="mtop mbot" style="font-weight: 500;font-size: 18px;color: rgba(0,0,0,0.7);">
                    Berdict is the best place for movie lovers <br>
                    Share your opinion on movies in 400 characters and <br>save the world from bad movies one at a time.
                </div>  
                <div id="buttons-container" class="col-l-16 ta-center mtop mbot2" style="
    margin-top: 40px;
">
                   <a class="btn btn-big  facebook" onclick="SignUp()" href="#" style="margin-right: 2%;background: #3b5998 !important;color: #fff !important;border: 1px solid #3b5998;   font-weight: 300;      padding: 18px 40px;   border-radius: 50px;min-width: 240px;   font-family: &quot;Oxygen&quot;,&quot;Helvetica Neue&quot;,Helvetica,Calibri,sans-serif;   text-transform: uppercase;   font-size: 15px;letter-spacing: 0.06em;">SignUp With Facebook</a>
    
<a class="btn btn-big login" data-toggle="modal" data-target="#myModal" href="" style="
    margin-right: 1%;   
    background: #fff !important;   
    color: #777 !important;   
    border: 1px solid #ccc;   
    font-weight: 400;   padding: 18px 40px;   border-radius: 50px; font-family: &quot;Oxygen&quot;,&quot;Helvetica Neue&quot;,Helvetica,Calibri,sans-serif;   text-transform: uppercase;   
    font-size: 15px;   
    letter-spacing: 0.06em;
    border-bottom: 1px solid #ccc !important;
">Login</a>    


                </div>          
            </div>  
            <div class="col-md-12" style="text-align: center;padding-top:40px;color:#888;">
                <a class="email-signup" style="color:#000;" href="{{Config::get('url.home')}}signup">Sign Up With Email.</a> By signing up you indicate <br/>that you have read and agree to the Terms of Service.
            </div>
            <div class="col-md-12 ptop0 mbot2" style="text-align: center;padding-top:30px;">
                <img class="mark" width="116" src="public/berdict/img/landing.png" style="width: 409px;text-align: center;">
            </div>          
        </div>
    </div>
</div>


<div class="container"  style="">
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-md-9">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
                    <form action="{{Config::get('url.home')}}login" method="POST" class="ajax">
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
                        <div class="form-group">
                            <div class="input-group" style="font-size:13px;">
                                <input type="checkbox" id="remember" value="remember" name="remember" checked="checked"></input>
                                Keep me logged in
                            </div>
                        </div>

                        {{ Form::submit('Login', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => 'review_submit')) }}

                        {{ Form::close() }} 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




@stop

@section('extra')
<script type="text/javascript">
    mixpanel.track("landing-page");
    $(".facebook").click(function() {
        mixpanel.track("btn-facebook-signup");
    });
    $(".login").click(function() {
        mixpanel.track("btn-login");
    });
    $(".email-signup").click(function() {
        mixpanel.track("btn-email-signup");
    });        
</script>

@stop
