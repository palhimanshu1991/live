<?php
$base = new BaseController();
$time = $base->getTime($latest->fr_date);
?>

<div class="row-fluid col-md-12" style="margin-bottom:30px;" id="data-review-{{$latest->fr_id}}">
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
         <div data-review-id="{{$latest->fr_id}}" class="res-review-body review-profile feed-review-body" style="font-weight: 800;font-size: 22px;margin-bottom:0;">
            <a class="review-headline" href=""> {{$latest->fr_review}} </a>
         </div>
         <div class="hidden" style="">

         </div>
      </div>
      <div class="res-review-rating col-md-3 col-xs-3 pad0 hidden" style="width:80px:">
         <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$latest->fr_vote}}.jpg" alt="" style="width:42px;display: inline;float:right;">
         <span style="background:#dbdbdb;;width:42px;height:42px;display: inline;float:right;font-size:24px;font-weight:600;padding:5px 0px;color:#666;text-align:center;">
         {{$latest->fr_vote}}                                      
         </span>
      </div>
   </div>
   <div class="res-review-header col-md-12 pad0" style="">
      <div class="res-review-user col-md-12 pad0" style="">
         <div data-review-id="4477" class="res-review-body review-profile feed-review-body">
            {{$latest->fr_review}}                                    
         </div>
      </div>
   </div>
   <div class="res-review-actions" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
      
      <span class="review-like" id="review-like-{{$latest->fr_id}}" data-id="{{$latest->fr_id}}" style="display: none;margin-left:;" title=""> Like</span>
      <span class="review-unlike" id="review-unlike-{{$latest->fr_id}}" data-id="{{$latest->fr_id}}"  title="" style="margin-left:;"> Liked</span>

      <span class="comment-open" review-id="{{$latest->fr_id}}" rel="tooltip" data-placement="top" title="" data-original-title="See Comments On This Review"  style="margin-left:15px"> Comments</span>
      
      <a href="{{Config::get('url.home')}}reviews/{{$latest->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> EDIT</span></a>
      <span class="delete" review-id="{{$latest->fr_id}}" rel="tooltip" data-placement="top" id="delete" title="" data-original-title="Delete Review" style="margin-left:15px">  DELETE</span>
      
      
      <span rel="tooltip" data-placement="left" title="" data-original-title="People who Like"  style="margin-left:15px;float: right;color:#666;font-size: 1.6em;line-height: 0.6;"> {{$latest->fr_views}}  <font style="font-size: 13px;font-weight: 400;"> Views </font></span>
   </div>
   <div review-container="{{$latest->fr_id}}" class="comment-container-{{$latest->fr_id}} hidden comment-wrapper">

   </div>
   <div class="res-review-actions review-comment-container" review-id="{{$latest->fr_id}}" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
      <div class="form-group">
         <input type="text" class="form-control review-comment" value="" id="" comment-review-id="{{$latest->fr_id}}" placeholder="Write a comment">
      </div>
      <!---<button type="submit" class="btn btn-default right review-comment-submit hidden">Post Comment</button>---->              
   </div>
</div>


<div class="row-fluid review-container-subhead hidden"  style="">
    My Review  as<b class="caret caret-subhead"></b>
</div>
<div class="row-fluid hidden res-review" id="data-review-{{$latest->fr_id}}">
    <div class="res-review-header col-md-12 pad0" style="">
        <div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
            <div class="res-review-user col-md-6 pad0">
                <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                    @if($user->usr_image)
					<img class="lazy img-responsive " src="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  alt="" style="width: 48px; display: inline;">
					@else
					<img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png"  alt="" style="width: 48px; display: inline;">
					@endif
				</a>
                <div class="res-review-user-details">
                    <a href="{{Config::get('url.home')}}{{$user->username}}"> {{$user->usr_fname.' '.$user->usr_lname}} </a> 
                </div>
            </div>
            <div class="res-review-rating col-md-6 pad0">
                <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$latest->fr_vote}}.jpg" alt="" style="width:48px;display: inline;float:right;">
                <span style="background:#dbdbdb;;width:45px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px;color:#666;text-align:center;">
                    {{$latest->fr_vote}}
				</span>
            </div>
        </div>

        <div data-review-id="{{$latest->fr_id}}" class="res-review-body" style="">
            <div>
               {{$latest->fr_review}}
            </div>                                    
        </div>
        <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
            <a href="{{Config::get('url.home')}}reviews/{{$latest->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>

            <span class="review-like" id="review-like-{{$latest->fr_id}}" data-id="{{$latest->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
            <span class="review-unlike" id="review-unlike-{{$latest->fr_id}}" data-id="{{$latest->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span>

            <a href="{{Config::get('url.home')}}reviews/{{$latest->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review" style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
			<span class="delete" review-id="{{$latest->fr_id}}" rel="tooltip" data-placement="top" id="delete" title="" data-original-title="Delete Review" style="margin-left:15px"> <span class="glyphicon glyphicon-trash"></span> DELETE</span>
        </div>
    </div>
</div>