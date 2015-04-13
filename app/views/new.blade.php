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
    <div class="container wrapper" style="">
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
              <p style="text-align: center;padding:20px 0px;color:#666;">Don't worry, we won't spam your Facebook Timeline ever. Promise. :)</p>

                </div>          
            </div>  
            <div class="col-md-12" style="text-align: center;padding:0px 0px 40px;color:#999;">
                <a class="email-signup" style="color:#000;" href="{{Config::get('url.home')}}signup">Sign Up With Email.</a> By signing up you indicate <br/>that you have read and agree to the Terms of Service.
            </div>
            <div class="col-md-12 ptop0 mbot2 hidden" style="text-align: center;padding-top:30px;">
                <img class="mark" width="116" src="public/berdict/img/landing.png" style="width: 409px;text-align: center;">
            </div>          
        </div>
    </div>
</div>


<div class="hidden">
    <div class="container wrapper pbot2 mbot2">
        <div class="row">
            @foreach($recent as $movie)
            <div class="col-md-2">
                <img class="img-responsive" style="height:215px;"  src="{{ Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="" style="background:#fff;">
    <div class="container wrapper pbot2 mbot2" style="padding-top:40px;">

<div style="text-align:center;margin-top: 10px;margin-bottom: 40px;">
                <p style="
    border: 1px solid #aaa;
    margin: 0 auto;
    display: inline;
    padding: 5px 22px;
    text-transform: uppercase;
    letter-spacing: 1px;
">Latest Movie Reviews</p>            
        </div>

        <div class="row">
        @foreach($reviews as $review)
        <?php 
        $random = rand(5,20);
        DB::table('film_review')->where('fr_id',$review->fr_id)->increment('fr_views',$random); ?>    
            <div class="col-md-12">
                <div class="col-md-9 row-fluid pad0" style="" id="data-review-{{$review->fr_id}}">
                    <div class="res-review-header col-md-12 pad0" style="height: 60px;">            
                       <div class="res-review-user col-md-9 col-xs-9 pad0" style="">
                          <div data-review-id="{{$review->fr_id}}" class="res-review-body review-profile feed-review-body" style="font-weight: 800;font-size: 22px;margin-bottom:0;">
                             <a style="color:#333;" class="" href="{{Config::get('url.home')}}movie/{{$review->fl_id}}/{{Common::cleanUrl($review->fl_name)}}">{{$review->fl_name}}</a>
                          </div>
                          <div class="" style="">
                             <span>{{$review->fl_year}}</span> 
                          </div>
                       </div>              
                       <div class="res-review-rating col-md-3 col-xs-3 pad0" style="width:80px:">
                          <img class=" img-responsive" src="http://localhost/lara3/public/rate_{{$review->fr_vote}}.jpg" alt="" style="width:42px;display: inline;float:right;">
                          <span style="background:#dbdbdb;;width:30px;height:42px;display: inline;float:right;font-size:16px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
                          {{$review->fr_vote}}                                     
                          </span>
                       </div>                
                    </div>
                    <div class="res-review-header col-md-12 pad0" style="">
                       <div class="res-review-user col-md-12 pad0" style="">
                          <div data-review-id="4477" class="res-review-body review-profile feed-review-body">
                            {{$review->fr_review}}
                          </div>
                       </div>
                    </div>
                    <div class="res-review-actions" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                       <span data-toggle="modal" data-target="#myModal" class="review-like" id="review-unlike-4418" data-id="4418" title="" style="  border: 1px solid #ddd;padding: 6px 30px;border-radius: 3px;font-size: 14px;font-weight: 600;"> Like</span>                        
                       <span href="" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who Like" style="margin-left:15px;float: right;color:#666;font-size: 1.6em;line-height: 0.6;"> {{$review->fr_views}}  <font style="font-size: 13px;font-weight: 400;"> Views </font></span>
                    </div>
                    <div class="res-review-user col-md-12 pad0" style="height: 50px;margin-top:25px;">
                       <a class="left" href="{{Config::get('url.home')}}{{$review->username}}">
                        @if($review->usr_image)
                          <img class="lazy img-responsive " src="{{Config::get('url.web')}}public/user_uploads/1000/{{$review->id}}/{{$review->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;border:1px solid #ddd;">
                        @else
                          <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$review->id}}/{{$review->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;border:1px solid #ddd;">                        
                        @endif                       
                       </a>
                       <div class="feed-rate-user-details">
                          <a href="{{Config::get('url.home')}}{{$review->username}}"><span class="helper"> {{$review->usr_fname.' '.$review->usr_lname}} </span></a> 
                       </div>
                       <div class="feed-rate-user-details">
                           <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> Movie Lover </span><span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"></span>
                       </div>               
                    </div>
                 </div>
                 <div class="col-md-3 visible-md-9 hidden-sm hidden-xs" style="margin-bottom:40px;">
                    <a class="left" href="{{Config::get('url.home')}}movie/{{$review->fl_id}}/{{Common::cleanUrl($review->fl_name)}}">
                        @if($review->fl_image)
                        <img class="lazy" data-original="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" src="{{Config::get('url.web')}}public/uploads/movie/{{$review->fl_year}}/{{$review->fl_image}}" alt="" style="display: inline;margin-left: 20px;border:1px solid #ccc;max-height: 320px;min-height: 300px;max-width: 210px;width: 205px;">             
                        @elseif
                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$review->fl_year}}/{{$review->fl_image}}" alt="" style="display: inline;margin-left: 20px;border:1px solid #ccc;max-height: 320px;min-height: 300px;max-width: 210px;width: 205px;">             
                        @endif
                    </a>
                 </div>         
            </div>
            @endforeach
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

                        <a class="btn btn-big  facebook" onclick="SignUp()" href="#" style="background: #3b5998 !important;color: #fff !important;border: 1px solid #3b5998;   font-weight: 500;  margin-top:10px;     padding: 14px 0px;      width: 100%;font-family: &quot;Oxygen&quot;,&quot;Helvetica Neue&quot;,Helvetica,Calibri,sans-serif;   text-transform: uppercase;   font-size: 15px;letter-spacing: 0.06em;">Login With Facebook</a>

                        {{ Form::close() }} 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


<style type="text/css">
.res-review-body.review-profile.feed-review-body {
  font-size: 18px;
  font-weight: 300;
  color: #333;
  line-height: 1.45em;
}
.feed-rate-user-details {
  padding-left: 50px;
  line-height: 18px;
  color:#333;
}    
</style>

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
