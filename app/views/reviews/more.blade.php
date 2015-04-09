@foreach($review as $review)
@if(Auth::check())
<?php $like = DB::table('review_likes')->where('review_id', $review->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
@endif
<?php $likeCount = DB::table('review_likes')->where('review_id', $review->fr_id)->count(); ?>
<?php
$base = new BaseController();
$time = $base->getTime($review->fr_date);
?>
<div class="row-fluid res-review" style="">
	<div class="res-review-header col-md-12 pad0" style="">
		<div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
			<div class="res-review-user col-md-9 pad0">
				<a class="left" href="{{Config::get('url.home')}}{{$review->username}}">
					<img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$review->id}}/{{$review->usr_image}}" alt="" style="width:48px;height:48px;display: inline;">
				</a>
				<div class="res-review-user-details">
					<a href="{{Config::get('url.home')}}{{$review->username}}">{{$review->usr_fname.' '.$review->usr_lname}}</a> 
				</div>
			</div>
			<div class="res-review-rating col-md-3 pad0">
				<img class="img-responsive" src="{{Config::get('url.web')}}public/rate_{{$review->fr_vote}}.jpg"  alt="" style="width:48px;display: inline;float:right;"></span>
				<span  style="background:#dbdbdb;;width:36px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
					{{$review->fr_vote}}
				</span>
			</div>
		</div>

		<div data-review-id="{{$review->fr_id}}" class="res-review-body" style="">
			<div>
				{{$review->fr_review}}    
			</div>                                    
		</div>
		<div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
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

			@if($likeCount>0)
			<span href="{{Config::get('url.home')}}reviews/{{$review->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who agree with this"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-thumbs-up"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
			@endif

			@if($likeCount>2)
			<span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
			@endif

		</div>

	</div>
</div>
@endforeach