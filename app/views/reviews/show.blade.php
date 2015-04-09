@section('meta')
<title>Review of {{$film->fl_name}} by {{$user->usr_fname.' '.$user->usr_lname}} - Berdict</title>
<meta property="og:url" content="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}" />
<link rel='image_src' href="{{Config::get('url.home')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}">
<meta property='og:image' content="{{Config::get('url.home')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" />
<meta property='og:type' content="video.movie" />
<meta property='fb:app_id' content='437161969726572' />
<meta property='og:title' content="Review of {{$film->fl_name}} by {{$user->usr_fname.' '.$user->usr_lname}}" />
<meta property='og:site_name' content='Berdict' />
<meta name="title" content="{Review of {{$film->fl_name}} by {{$user->usr_fname.' '.$user->usr_lname}} - Berdict" />
<meta name="description" content="{{$film->fl_name}} ({{$film->fl_year}}) Directed by {{$film->fl_dir_ar_id}}.  Starring {{$film->fl_stars}}. {{$film->fl_outline}}." />
<meta property="og:description" content="{{$film->fl_name}} ({{$film->fl_year}}) Directed by {{$film->fl_dir_ar_id}}.  Starring {{$film->fl_stars}}. {{$film->fl_outline}}." />
<meta name="keywords" content="{{$film->fl_name}} M.o.v.i.e R.e.v.i.e.w, {{$film->fl_name}} {{$film->fl_year}} M.o.v.i.e R.e.v.i.e.w, {{$film->fl_name}} M.o.v.i.e R.e.v.i.e.w.s, R.e.v.i.e.w of {{$film->fl_name}} ,   ,News Item - New York, NY, USA " />

@stop


@section('container')
@if(Auth::check())
<?php $like = DB::table('review_likes')->where('review_id', $review->fr_id)->where('user_id', Auth::user()->id)->first(); ?>

@endif
<?php $likeCount = DB::table('review_likes')->where('review_id', $review->fr_id)->count(); ?>
<?php
$base = new BaseController();
$time = $base->getTime($review->fr_date);
?>

@if(!Auth::check())
<div class="container" id="mainframe">
    <section class="res-main  pbot" style="text-align: center;padding:15px 0px 15px 10px;	">
        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/berdict_prom.jpg" alt="" style="width:650px;max-height:150px;;display: inline;">
    </section>
</div>  
@endif


<div class="container" id="mainframe">
    <div class="row-fluid" style="min-height: 50px; "> 
        <h2 style="font-weight:700;text-transform: uppercase;margin:">                    
            Short Review of 
            <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">"{{$film->fl_name}}"</a>                    
        </h2>
    </div>

    <div class="row-fluid" style="">     
        <div class="col-md-3 pad0"> 
            <div class="zban">
                <div class="sug_box " style="margin-top:0px;">
                    @if ($film->fl_image)
                    <img class="lazy img-responsive" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}"  height="360" width="240px" title="" alt="" itemprop="image"  />
                    @else
                    <img class="lazy img-responsive" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg"  height="317" width="220px" title="" alt="" itemprop="image"  />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9 pad0" style="padding-left: 20px;">
            <div class="res-reviews-container">
                <div id="content">
                    <div class="row-fluid res-review" style="padding-top: 0px;">
                        <div class="res-review-header col-md-12 pad0" style="">
                            <div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
                                <div class="res-review-user col-md-6 pad0">
                                    <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                                        <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->username}}/{{$user->usr_image}}" alt="" style="width: 48px; display: inline;">
                                    </a>
                                    <div class="res-review-user-details" style="text-transform: uppercase; ">
                                        <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a> 
                                    </div>
                                </div>
                                <div class="res-review-rating col-md-6 pad0">
                                    <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$review->fr_vote}}.jpg" alt="" style="width:48px;display: inline;float:right;">
                                    <span style="background:#dbdbdb;;width:36px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
                                        {{$review->fr_vote}}                                       
                                    </span>
                                </div>
                            </div>
                            <div data-review-id="31" class="res-review-body" style="font-size:16px;line-height: 24px;">
                                <div>
                                    <img style="margin-top:-5px;" src="{{Config::get('url.home')}}public/berdict/img/quote_b.png">  {{$review->fr_review}}     
                                </div>                                    
                            </div>
                            <div class="res-review-actions res-review-header  col-md-12 pad0" style="font-size:11px;margin-top:0px;font-weight:600;padding-top: 0px;">
                                <a href="{{Config::get('url.home')}}reviews/{{$review->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>

                                @if(Auth::check())
                                @if ($like)
                                <span class="review-like" id="review-like-{{$review->fr_id}}" data-id="{{$review->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                                <span class="review-unlike" id="review-unlike-{{$review->fr_id}}" data-id="{{$review->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span>
                                @else

                                <span class="review-like" id="review-like-{{$review->fr_id}}" data-id="{{$review->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                                <span class="review-unlike" id="review-unlike-{{$review->fr_id}}" data-id="{{$review->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span></a>
                                @endif
                                @endif

                                @if(Auth::check())
                                @if($review->fr_usr_id==Auth::user()->id)
                                <a href="{{Config::get('url.home')}}reviews/{{$review->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
                                <!--<span rel="tooltip" data-placement="top" data-toggle="modal" data-target="#myModal" title="" data-original-title="Delete Review" style="margin-left:15px"> <span class="glyphicon glyphicon-trash"></span> DELETE</span>-->
                                @endif @endif

                                @if($likeCount>0)
                                <span href="{{Config::get('url.home')}}reviews/{{$review->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who agree"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-thumbs-up"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                                @endif

                                @if($likeCount>2)
                                <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:10px;">
                    <a class="cun" href="https://twitter.com/intent/tweet?text=Short review of {{$film->fl_name}} by {{$user->usr_fname.' '.$user->usr_lname}} {{Config::get('url.home')}}{{$review->fr_id}} via @berdict">
                    <img style="width:25px" src="http://www.berdict.com/public/berdict/img/flat_twitter_small.png">
                    </a>
                    <a style="margin-left:5px;" href="https://www.facebook.com/sharer/sharer.php?u={{Config::get('url.home')}}reviews/{{$review->fr_id}}">
                    <img style="width:25px" src="http://www.berdict.com/public/berdict/img/flat_fb_small.png">
                    </a>           
                </div>
                </div>
            </div>

        
        </div>
    </div>


</div>



@stop


@section('extra')
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=437161969726572";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css" media="screen">
    .custom-tweet-button {
        padding: 0px 0px 0px 20px;
        background: url('http://w.sharethis.com/images/twitter_16.png') 1px center no-repeat;
    }
</style>
<script>!function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, "script", "twitter-wjs");</script>
@stop