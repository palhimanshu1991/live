<?php
$base = new BaseController();
$time = $base->getTime($latest->fr_date);
?>

<div class="row-fluid review-container-subhead"  style="">
    My Review  as<b class="caret caret-subhead"></b>
</div>
<div class="row-fluid res-review" id="data-review-{{$latest->fr_id}}">
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