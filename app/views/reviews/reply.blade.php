<div class="res-review-user col-md-12 pad0" style="padding:10px 0px;border-top:1px solid #eee;">
   <a class="left" href="{{Config::get('url.home')}}{{Auth::user()->username}}">
      <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{Auth::user()->id}}/{{Auth::user()->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
   </a>
   <div class="feed-rate-user-details">
      <a href="{{Config::get('url.home')}}{{Auth::user()->username}}"><span class="" style="color:red;"> {{Auth::user()->usr_fname.' '.Auth::user()->usr_lname}} </span></a> 
      <span style="margin-left: 5px;position: absolute;line-height: 1.33em;">{{$reply->rc_comment}}</span>
   </div>
   <div class="feed-rate-user-details">
      <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> - </span>
   </div>
</div>