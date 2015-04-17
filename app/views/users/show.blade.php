    @section('meta')
<title>{{$user->usr_fname.' '.$user->usr_lname}} - Berdict</title>
@stop


@section('container')


<div class="container">
    <div class="row-fluid pbot ptop2" >
        <div class="col-md-12 pad0" style="text-align:center;margin:0 auto;">
            <div class="profile-card-image">
                @if($user->usr_image)
                <img class="img-responsive lazy" style="display:inline;width:160px;height:160px;border-radius:50%;border: 1px solid #ddd;" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                @else 
                <img class="img-responsive lazy" style="display:inline;width:160px;height:160px;border-radius:50%;border: 1px solid #ddd;" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                @endif
            </div>  
            <h1 style="font-weight:700;">{{$user->usr_fname.' '.$user->usr_lname}}</h1>

      <div class="col-md-8 col-md-offset-2">
                    <h4 style="
          color: rgba(0,0,0,0.6);   font-size: 18px;   outline: 0;   word-break: break-word;   word-wrap: break-word;   
          line-height: 1.45em;
          letter-spacing: -0.02em;
          margin-bottom: 30px;
      ">
      {{$user->usr_bio}}
      </h4>            
            </div>            

            <div class="col-md-6 col-md-offset-3" style="margin-bottom:20px;">
              <div class="row">
              <div class="col-xs-4">
                <h2 style="margin: 5px 0px;font-weight:700;">{{$reviewCount}}</h2>
                <h3 style="font-size: 15px;text-transform: uppercase;margin: 0;font-weight:600;">Reviews</h3>              
              </div>
              <div class="col-xs-4">
                <h2 style="margin: 5px 0px;font-weight:700;">{{$viewCount}}</h2>
                <h3 style="font-size: 15px;text-transform: uppercase;margin: 0;font-weight:600;">Views</h3>              
              </div>   
              <div class="col-xs-4">
                <h2 style="margin: 5px 0px;font-weight:700;">{{$movieCount}}</h2>
                <h3 style="font-size: 15px;text-transform: uppercase;margin: 0;font-weight:600;">Movies</h3>              
              </div>                                                             
              </div>
            </div>
            <div align="" class="col-md-6 col-md-offset-3" style="float:left;">
                <!-- Favourite Button--->
                <div style="padding:5px 0px 0px 0px;font-size: 13px;">
                    <!-- follow button -->
                    @if($follow==3)
                    <a href="{{Config::get('url.home')}}edit" class="ajax_follow">
                        <button class="btn btn-main">Edit Profile</button>
                    </a>                     
                    @elseif($follow==1)
                    <button style="display: none;"  id="ajax_add_follow" data-id="{{$user->id}}" class="follow btn">Follow</button>
                    <button id="ajax_del_follow" data-id="{{$user->id}}" class="btn following">Following</button>

                    @elseif($follow==0)
                    <button id="ajax_add_follow" data-id="{{$user->id}}" class="follow btn">Follow</button>
                    <button style="display: none;" id="ajax_del_follow" data-id="{{$user->id}}" class="btn following">Following</button>
                    @elseif($follow==2)
                    <a href="{{Config::get('url.home')}}login" class="ajax_follow"> <button id="" data-id="" class="follow btn">Follow</button> </a>                       
                    @endif
                    <!--- button ends ----> 
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


                @foreach ($action as $action)
                <?php
                $base = new BaseController();
                $time = $base->getTime($action->action_date);
                ?>





                @if ($action->type_id=="2")
            <?php $film       =  DB::table('film')->where('fl_id', $action->object_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $user->id)->first(); ?>
            <?php $like       =  DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            <?php $likeCount  =  DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>
            <?php                DB::table('film_review')->where('fr_id',$film->fr_id)->increment('fr_views',Rand(2,5)); ?>
            <?php $replies    =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->join('users','users.id','=','review_comments.rc_user_id')->get(); ?>                                   
            <?php $replyCount =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->count(); ?>                                   
            <div class="row-fluid col-md-9 pad0" style="margin-bottom:30px;" id="data-review-4477">
               <div class="res-review-user col-md-12 pad0" style="height: 50px;">
                  <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
                  </a>
                  <div class="feed-rate-user-details">
                     <a href="{{Config::get('url.home')}}{{$user->username}}"><span class="helper">{{$user->usr_fname.' '.$user->usr_lname}} </span></a> 
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
                <a class="" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}"> 
                  <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="display: inline;margin-left: 20px;border:1px solid #ccc;max-height: 320px;min-height: 300px;max-width: 210px;width: 205px;">             
                </a>
            </div>
            <!--- Old review -->
            <div class="row-fluid res-review" style="display:none;" id="data-review-{{$film->fr_id}}">
               <div class="res-review-user col-md-12 pad0">
                  <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                  <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;">
                  </a>
                  <div class="feed-rate-user-details">
                     <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper"> wrote a berdict for </span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
                  </div>
               </div>
               <div class="res-review-header feed-action col-md-12 pad0" style="display: block">
                  <div class="res-review-header col-md-12 pad0" style="min-height:90px;">
                     <div class="res-review-user col-md-1 pad0" style="min-height:90px;width:70px;">
                        <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
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