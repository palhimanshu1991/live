@section('meta')
<title>Berdict</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />

@if(Config::get('url.home')=='http://localhost/live/')

@else
<!-- Facebook Conversion Code for SignupWithFacebook -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6028314635731', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6028314635731&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
@endif

@stop


@section('container')


<div class="" style="background:#efefef;">
    <div class="container pbot2" style="">
        <div class="row-fluid ptop2" style="">
            <div class="col-md-11 pad0" style="width:908px;"> 
                <div class="jcarousel-wrapper">
                    <div class="jcarousel" data-jcarousel="true">
                        <ul style="left: 0px; top: 0px;">
                            @foreach ($other as $movie)
                            <li>
                                <div class="feed-gallery left" rel="popover" data-original-title="{{$movie->fl_name}}" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="{{$movie->fl_outline}}" style="">									
                                    <a href="{{ Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}">
                                        <img class="lazy img-responsive" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
                                    </a>
                                </div>	               
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-1 pad0" style="padding-left: 0px;width: 50px;">
                <div class="" align="center" style="padding-top:30px;width:52px;height:90px;text-align: center;background:#dbdbdb;">
                    <a href="#" rel="tooltip" data-placement="right" title="" data-original-title="Go Right" class="jcarousel-control-next" data-jcarouselcontrol="true">
                        <span class="glyphicon glyphicon-arrow-right"></span>
                    </a>    
                </div>
                <div class="" align="center" style="padding-top:30px;width:52px;height:90px;text-align: center;background:#dbdbdb;">                   
                    <a href="#" rel="tooltip" data-placement="right" title="" data-original-title="Go Left" class="jcarousel-control-prev inactive" data-jcarouselcontrol="true">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                    </a>  
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container ptop1" ="mainframe">
    <div class="col-md-12 pad0 grid_left column" style="margin-bottom: 20px;margin-right: 20px;">

        <!--- Recent Reviews---->
<div class="blockDivider "><a class="blockDivider-name">Latest Reviews</a></div>        

        <ul id="myTab" class="nav nav-tabs hidden" style="font-size:13px;">
            <li class="active"><a style="padding: 3px 15px;border-top-color: transparent;border-bottom: 1px solid #dddddd;border-left: 1px solid #ddd;text-transform: uppercase;" href="#home" data-toggle="tab">Friends Feed</a></li>
            <li class=""><a style="padding: 3px 15px;border-top-color: transparent;border-bottom: 1px solid #dddddd;border-right: 1px solid #ddd;text-transform: uppercase;" href="#latest" id="myLatest" data-fetch="no" data-toggle="tab">Latest Reviews</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="home">

                @if($friend== null || $friend=="")

                <div style="margin-top:15px;padding: 15px 15px;background: #efefef;" id="noreview" name="noreview"> 
                    <b>Welcome to Berdict</b><br>
                    Follow some critics or friends to show some activity here.<br>
                </div>
                @endif



                @foreach ($friend as $action)
                <?php
                $base = new BaseController();
                $time = $base->getTime($action->action_date);
                ?>

                @if ($action->type_id=="10")
                <?php $film = DB::table('film')->where('fl_id', $action->object_id)->join('rating', 'rating.rt_fl_id', '=', 'film.fl_id')->where('rt_usr_id', $action->id)->first(); ?>
                <div class="row-fluid res-review " style="">
                    <div class="res-review-user col-md-12 pad0">
                        <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                            <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$action->id}}/{{$action->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;">
                        </a>
                        <div class="feed-rate-user-details">
                            <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper">rated</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
                        </div>
                    </div>
                    <div class="res-review-header feed-action col-md-12 pad0" style="">
                        <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                            <div class="res-review-user col-md-10 pad0">
                                <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                                </a>
                                <div class="res-review-user-details">
                                <!--    <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper">rated</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> ---->
                                </div>
                            </div>
                            <div class="res-review-rating col-md-2 pad0">
                                <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->rt_vote}}.jpg" alt="" style="width:48px;display: inline;float:right;">
                                <span style="background:#dbdbdb;;width:42px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px;color:#666;text-align:center;">
                                    {{$film->rt_vote}}
                                </span>
                            </div>
                        </div>
                        <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                            <span><span class="glyphicon glyphicon-time"></span> {{$time}} </span>
                        </div>
                    </div>
                </div>



                @elseif ($action->type_id=="2")
            <?php $film       =  DB::table('film')->where('fl_id', $action->object_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $action->id)->first(); ?>
            <?php $like       =  DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            <?php $likeCount  =  DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>
            <?php                DB::table('film_review')->where('fr_id',$film->fr_id)->increment('fr_views',Rand(2,7)); ?>
            <?php $replies    =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->join('users','users.id','=','review_comments.rc_user_id')->get(); ?>                                   
            <?php $replyCount =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->count(); ?>                                   
            <div class="row-fluid col-md-9 pad0" style="margin-bottom:30px;" id="data-review-4477">
               <div class="res-review-user col-md-12 pad0" style="height: 50px;">
                  <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                  <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$action->id}}/{{$action->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
                  </a>
                  <div class="feed-rate-user-details">
                     <a href="{{Config::get('url.home')}}{{$action->username}}"><span class="helper">{{$action->usr_fname.' '.$action->usr_lname}} </span></a> 
                  </div>
                  <div class="feed-rate-user-details">
                     <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;">Wrote a review - </span><span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> {{$time}}</span>
                  </div>
               </div>
               <div class="res-review-header col-md-12 pad0" style="height:30px;">
                  <div class="res-review-user col-md-12 col-xs-9 pad0" style="">
                     <div data-review-id="4477" class="res-review-body review-profile feed-review-body" style="font-weight: 800;font-size: 22px;margin-bottom:0;">
                        <a class="review-headline" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}"> {{$film->fr_review}} </a>
                     </div>
                     <div class="hidden" style="">
                        <span>{{$film->fl_year}}</span> 
                     </div>
                  </div>
                  <div class="res-review-rating col-md-3 col-xs-3 pad0 hidden" style="width:80px:">
                     <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:42px;display: inline;float:right;">
                     <span style="background:#dbdbdb;;width:42px;height:42px;display: inline;float:right;font-size:24px;font-weight:600;padding:5px 0px;color:#666;text-align:center;">
                     {{$film->fr_vote}}                                      
                     </span>
                  </div>
               </div>
               <div class="res-review-header col-md-12 pad0" style="">
                  <div class="res-review-user col-md-12 pad0" style="">
                     <div data-review-id="4477" class="res-review-body review-profile feed-review-body">
                        {{$film->fr_review}}                                    
                     </div>
                  </div>
               </div>
               <div class="res-review-actions" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                  @if(Auth::check())
                  @if ($like)
                  <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" style="display: none;margin-left:;" title=""> Like</span>
                  <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}"  title="" style="margin-left:;"> Liked</span>
                  @else
                  <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="margin-left:;"> Like</span>
                  <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="display: none;margin-left:;"> Liked</span></a>
                  @endif
                  @endif
                  <span class="comment-open" review-id="{{$film->fr_id}}" rel="tooltip" data-placement="top" title="" data-original-title="See Comments On This Review"  style="margin-left:15px"> {{$replyCount}} Comments</span>
                  @if(Auth::check()) @if($film->fr_usr_id==Auth::user()->id)
                  <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> EDIT</span></a>
                  <span class="delete" review-id="{{$film->fr_id}}" rel="tooltip" data-placement="top" id="delete" title="" data-original-title="Delete Review" style="margin-left:15px">  DELETE</span>
                  @endif @endif
                  @if($likeCount>0)               
                  <span href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who Like"  style="margin-left:15px;float: right;color:#666;font-size: 1.6em;line-height: 0.6;"> {{$likeCount}} <font style="font-size: 13px;font-weight: 400;"> @if($likeCount<2) Like  @else Likes  @endif </font></span>
                  @endif
                  @if($likeCount>2)
                  <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                  @endif
                  <span rel="tooltip" data-placement="left" title="" data-original-title="People who Like"  style="margin-left:15px;float: right;color:#666;font-size: 1.6em;line-height: 0.6;"> {{$film->fr_views}}  <font style="font-size: 13px;font-weight: 400;"> Views </font></span>
               </div>
               <div review-container="{{$film->fr_id}}" class="comment-container-{{$film->fr_id}} hidden comment-wrapper">
                  @foreach($replies as $reply)               
                  <div class="res-review-user col-md-12 pad0" style="padding:10px 0px;border-top:1px solid #eee;">
                     <a class="left" href="{{Config::get('url.home')}}{{$reply->username}}">
                        <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$reply->id}}/{{$reply->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
                     </a>
                     <div class="feed-rate-user-details">
                        <a href="{{Config::get('url.home')}}{{$reply->username}}"><span class="" style="color:red;"> {{$reply->usr_fname.' '.$reply->usr_lname}} </span></a> 
                        <span style="margin-left: 5px;position: absolute;line-height: 1.33em;">{{$reply->rc_comment}}</span>
                     </div>
                     <div class="feed-rate-user-details">
                        <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> - </span>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="res-review-actions review-comment-container" review-id="{{$film->fr_id}}" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                  <div class="form-group">
                     <input type="text" class="form-control review-comment" value="" id="" comment-review-id="{{$film->fr_id}}" placeholder="Write a comment">
                  </div>
                  <!---<button type="submit" class="btn btn-default right review-comment-submit hidden">Post Comment</button>---->              
               </div>
            </div>
            <div  class="col-md-3 visible-md-9 hidden-sm hidden-xs" style="margin-bottom:40px;">
               <img rel="popover" data-original-title="{{$movie->fl_name}}" data-container="body" data-toggle="popover" data-placement="left" data-trigger="click" data-content="{{$movie->fl_outline}}" class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="display: inline;margin-left: 20px;border:1px solid #ccc;max-height: 320px;min-height: 300px;max-width: 210px;width: 205px;">             
            </div>
            <!--- Old review -->
            <div class="row-fluid res-review" style="display:none;" id="data-review-{{$film->fr_id}}">
               <div class="res-review-user col-md-12 pad0">
                  <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                  <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$action->id}}/{{$action->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;">
                  </a>
                  <div class="feed-rate-user-details">
                     <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper"> wrote a berdict for </span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
                  </div>
               </div>
               <div class="res-review-header feed-action col-md-12 pad0" style="display: block">
                  <div class="res-review-header col-md-12 pad0" style="min-height:90px;">
                     <div class="res-review-user col-md-1 pad0" style="min-height:90px;width:70px;">
                        <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                        <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                        </a>
                     </div>
                     <div class="res-review-user col-md-8 pad0" style="min-height:90px;width:500px">
                        <div data-review-id="{{$film->fr_id}}" class="res-review-body review-profile feed-review-body">
                           <img width="16px" style="margin-top:-5px;" src="{{Config::get('url.home')}}public/berdict/img/quote_b.png">
                           {{$film->fr_review}}
                        </div>
                     </div>
                     <div class="res-review-rating col-md-2 pad0" style="width:80px">
                        <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:42px;display: inline;float:right;">
                        <span style="background:#dbdbdb;;width:30px;height:42px;display: inline;float:right;font-size:16px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
                        {{$film->fr_vote}}                                      
                        </span>
                     </div>
                  </div>
               </div>
               <div class="res-review-actions res-review-header feed-action col-md-12 pad0" style="font-size:11px;margin-top:0px;font-weight:600;padding-top: 10px;">
                  <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>
                  @if(Auth::check())
                  @if ($like)
                  <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-thumbs-up"></span> Like</span>
                  <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Liked</span>
                  @else
                  <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Like</span>
                  <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Liked</span></a>
                  @endif
                  @endif
                  @if(Auth::check()) @if($film->fr_usr_id==Auth::user()->id)
                  <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
                  <span class="delete" review-id="{{$film->fr_id}}" rel="tooltip" data-placement="top" id="delete" title="" data-original-title="Delete Review" style="margin-left:15px"> <span class="glyphicon glyphicon-trash"></span> DELETE</span>
                  @endif @endif
                  @if($likeCount>0)
                  <span href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who Like"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-thumbs-up"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                  @endif
                  @if($likeCount>2)
                  <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                  @endif
               </div>
            </div>

                @elseif ($action->type_id=="30") 
                <?php $film = DB::table('film')->where('fl_id', $action->object_id)->first(); ?>
                <div class="row-fluid res-review" style="">
                    <div class="res-review-user col-md-12 pad0">
                        <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                            <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$action->id}}/{{$action->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;">
                        </a>
                        <div class="feed-rate-user-details">
                            <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper"> added </span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> <span class="helper"> to watchlist </span>
                        </div>
                    </div>
                    <div class="res-review-header feed-action col-md-12 pad0" style="">
                        <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                            <div class="res-review-user col-md-10 pad0">
                                <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                                </a>
                                <div class="res-review-user-details">
                                </div>
                            </div>
                            <div class="res-review-rating col-md-2 pad0">
                            </div>
                        </div>
                        <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                            <span><span class="glyphicon glyphicon-time"></span> {{$time}} </span>
                        </div>
                    </div>
                </div>

                @elseif ($action->type_id=="50") 
                <?php $film = DB::table('film')->where('fl_id', $action->object_id)->first(); ?>
                <div class="row-fluid res-review" style="">
                    <div class="res-review-user col-md-12 pad0">
                        <a class="left" href="{{Config::get('url.home')}}{{$action->username}}">
                            <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$action->id}}/{{$action->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;">
                        </a>
                        <div class="feed-rate-user-details">
                            <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper">favourited</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
                        </div>
                    </div>
                    <div class="res-review-header feed-action col-md-12 pad0" style="">
                        <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                            <div class="res-review-user col-md-10 pad0">
                                <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                                </a> 
                                <div class="res-review-user-details">
                                </div>
                            </div>
                            <div class="res-review-rating col-md-2 pad0">

                            </div>
                        </div>
                        <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                            <span><span class="glyphicon glyphicon-time"></span> {{$time}} </span>
                        </div>
                    </div>
                </div>                      
                @endif
                @endforeach
            </div>
            <div class="tab-pane fade" id="latest">
                <div id="myLatestLoading" style="display: none;padding:20px;text-align: center;"><img src="{{Config::get('url.home')}}public/berdict/img/progress.gif"/>Loading.....</div>
            </div>
        </div>
    </div>
</div>

@stop

@section('extra')
<script src="{{Config::get('url.home')}}public/bootstrap/js/jquery.jcarousel.min.js"></script>
<script src="{{Config::get('url.home')}}public/bootstrap/js/jcarousel.skeleton.js"></script>

<script type="text/javascript">
    mixpanel.track("feed-page");  
</script>
<style type="text/css">
.res-review-body.review-profile.feed-review-body {
  font-size: 17px;
  font-weight: 300;
  color: #000;
  line-height: 1.45em;
  letter-spacing: .005em;
}
.feed-rate-user-details {
  line-height: 18px;
}

a {
  color: #333;
  text-decoration: none;
}  
</style>

@stop

