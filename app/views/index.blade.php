@extends('master_blank')

@section('meta')
<title>Berdict - short movie reviews from your friends and critics.</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />





@stop


@section('container')

<style>
    body {
        background: url(http://www.berdict.com/public/kungfupanda.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .bs-docs-nav {
        text-shadow: none;
        background-color: #FE2020;
        border-color: #FE2020;
        box-shadow: none;
    }
    .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {
        color: #fff;
        background-color: transparent;
    }
    bs-docs-nav .navbar-nav > li > a:hover {
        color: #ffffff;
        background-color: #f00000;
    }
    .bs-docs-nav .navbar-nav > li > a:hover {
        color: #ffffff;
        background-color: #f00000;
    }
    .bs-docs-nav .navbar-nav > li > a {
        text-transform: uppercase;
        font-family: 'Open Sans';
        font-size: 13px;
        border-right: 0px solid #efefef;
        color:#fff;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 46px;
        padding: 6px 12px;
        font-size: 14px;
        font-family: 'Open Sans';
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 0px;
    }
</style>

<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{Config::get('url.home')}}" class="navbar-brand"><img width="100" src="{{Config::get('url.home')}}public/berdict/img/w_berdict_s.png"></a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a style="font-weight:600;" href="" data-toggle="modal"  data-target="#myModal">Login</a>
                </li>
            </ul>
        </nav>
    </div>
</header>



<div class="container"  style="margin-bottom:100px;margin-top:50px">

    <div class="row">
        <div class="col-md-8" style="margin-top: 16px;
             color: #fff;
             min-height: 442px;
             text-shadow: 0px 1px 5px #111;
             /* Fallback for web browsers that don't support RGBa */
             background-color: rgb(0, 0, 0);
             /* RGBa with 0.6 opacity */
             background-color: rgba(0, 0, 0, 0.6);
             /* For IE 5.5 - 7*/
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
             /* For IE 8*/
             -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";

             ">
             <div class="row"style="margin: 15px 0px 20px 0px">
                <div class="col-md-12 offset6"  style="">
                    <h1 style="font-weight:700;font-size: 3em;margin:0px;text-transform: uppercase;"> short movie reviews</h1> 
                    <h2 style="font-weight:700;margin:0px;font-size: 1.6em;text-transform: uppercase;"> to save your time </h2>
                </div>
            </div>
            <div class="row"  style="margin: 20px 0px 0px 0px">
                <div class="col-md-12"  style="margin: 0px 0px 20px 0px">
                    <h2 style="font-weight:700;">FAST</h2>
                    <P>Micro Reviews of 400 characters. Short, Crisp and Fun</P>
                </div>       
            </div>
            <div class="row"  style="margin: 0px 0px 0px 0px">
                <div class="col-md-12"  style="margin: 0px 0px 20px 0px">
                    <h2 style="font-weight:700;">SOCIAL</h2>
                    <P>Opinion of your friends, their reviews and ratings and much more</P>
                </div>       
            </div>
            <div class="row"  style="margin: 0px 0px 20px 0px">
                <div class="col-md-12"  style="margin: 0px 0px 20px 0px">
                    <h2 style="font-weight:700;">FUN</h2>
                    <P>Manage your Watchlist, Add your Favourites </P>
                </div>       
            </div>
        </div>

        <div class="col-md-4">
            <div id="btn_signup" class="" align="" style="">
                <button id="facebook_signup" onclick="Login()" type="button" class="btn btn-primary btn-lg btn-facebook btn-block">Signup With Facebook</button>
            </div>

            <!---- Email Form --->
            <div id="email_form" class="" align="" style="">
                <div id="" class="" align="center" style="margin-bottom: 10px">
                    or sign up below
                </div>
                <form action="{{Config::get('url.home')}}signup" method="POST" name="signup_form"  id="signup_form" class="ajax">
                    <div class="form-group">

                        {{ Form::text('name', '', array('class' => 'form-control' , 'id' => 'name', 'placeholder' => 'Your full name')) }}
                    </div>

                    <div class="form-group">

                        {{ Form::email('email', '', array('class' => 'form-control' , 'id' => 'email', 'placeholder' => 'Your email')) }}
                    </div>

                    <div class="form-group">

                        {{ Form::text('username', '', array('class' => 'form-control' , 'id' => 'username', 'placeholder' => 'Your username')) }}
                    </div>

                    <div class="form-group">

                        {{ Form::password('password',  array('class' => 'form-control' , 'id' => 'password', 'placeholder' => 'Your password')) }}
                    </div>        

                    <div class="form-group">

                        {{ Form::password('re_password',  array('class' => 'form-control' , 'id' => 're_password', 'placeholder' => 'Confirm password')) }}
                    </div>

                    {{ Form::submit('Create Account', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => '')) }}

                    {{ Form::close() }} 

            </div>

            <!---- Facebook Form --->
            <div id="facebook_form" class="g" align="" style="display: none;">

                <form action="{{Config::get('url.home')}}signup" method="POST" name="fb_form" id="fb_form" class="ajax">

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

            <div class="" style="color:#ccc;font-size:13px;margin-top:10px">
                By clicking Create Account, you agree to our Terms and also that your have read our Privacy Policy.
            </div>

            <div id="signup_loading" class="col-lg-12" align="" style="display:none;margin-top:12%">
                <div class="" align="center">
                    <img class="" src="{{Config::get('url.home')}}public/berdict/img/progress.gif">
                </div> 
                <div class="" style="font-size:13px;margin-top:10px">
                    Hang on... it'll take only a few seconds to set up
                </div>
            </div>  
        </div>
    </div>
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
<footer class="bs-footer" role="contentinfo">
    <div class="container">
        <div class="bs-social">
            <ul class="bs-social-buttons">

            </ul>
        </div>


        <ul class="footer-links">
            <li><a href="{{Config::get('url.home')}}">Home</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}privacy">Privacy</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}terms">Terms</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}about">About</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}contact">Contact</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}jobs">Jobs</a></li>
            <li class="muted">·</li>
            <li><a href="{{Config::get('url.home')}}contact">Feedback</a></li>
        </ul>
    </div>
</footer>
@stop
