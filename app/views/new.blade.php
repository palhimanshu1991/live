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
        <div class="col-l-16 pbot ptop2">   
            <div class="col-l-16 mtop2 mbot2" style="padding: 0px;text-align: center;">
                <h1>Become A Movie Critic</h1>
                <div class="mtop mbot" style="font-weight: 500;font-size: 18px;color: rgba(0,0,0,0.7);">
                    Berdict is the best new place for movie lovers <!--<span class="heart"></span>-->. <br>
                    Share your opinion on movies in 400 characters and <br>save the world from bad movies one at a time.
                </div>  
                <div id="buttons-container" class="col-l-16 ta-center mtop mbot2" style="
    margin-top: 40px;
">
                   <a class="btn btn-big " onclick="SignUp()" href="#" style="margin-right: 2%;background: #3b5998 !important;color: #fff !important;border: 1px solid #3b5998;   font-weight: 300;      padding: 18px 40px;   border-radius: 50px;min-width: 240px;   font-family: &quot;Oxygen&quot;,&quot;Helvetica Neue&quot;,Helvetica,Calibri,sans-serif;   text-transform: uppercase;   font-size: 15px;letter-spacing: 0.06em;">SignUp With Facebook</a>
    
<a class="btn btn-big " data-toggle="modal" data-target="#signupModal" href="" style="
    margin-right: 1%;   
    background: transparent !important;   
    color: #777 !important;   
    border: 1px solid #ccc;   
    font-weight: 400;   padding: 18px 40px;   border-radius: 2px;   min-width: 240px;   font-family: &quot;Oxygen&quot;,&quot;Helvetica Neue&quot;,Helvetica,Calibri,sans-serif;   text-transform: uppercase;   
    font-size: 15px;   
    letter-spacing: 0.06em;
    border-bottom: 1px solid #ccc !important;display:none;
">SignUp With Email</a>            
                </div>          
            </div>  
            <div class="col-l-16 ptop0 mbot2" style="text-align: center;padding-top:60px;">
                <img class="mark" width="116" src="public/berdict/img/landing.png" style="width: 409px;text-align: center;">
            </div>          
        </div>
    </div>
</div>




@stop

@section('extra')


@stop
