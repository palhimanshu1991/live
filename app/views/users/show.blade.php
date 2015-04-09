@section('meta')
<title>{{$user->usr_fname.' '.$user->usr_lname}} - Berdict</title>
@stop


@section('container')

<div class="container">
    <div class="row-fluid pbot ptop2" >
        <div class="movie-title" >

        </div>
    </div>
    <div class="row-fluid" >
        <div class="col-sm-4 pad0" style="max-width:240px;">
            <div class="profile-card-top" align="center">
                <div class="profile-card-image">
                    @if($user->usr_image)
                    <img class="img-responsive lazy" style="width:200px;height:200px;" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                    @else 
                    <img class="img-responsive lazy" style="width:200px;height:200px;" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                    @endif
                </div>  
                <div class="profile-card-name" style="">
                    {{$user->usr_fname.' '.$user->usr_lname}}<br/>
					<font style="font-size:15px;">{{$user->ul_name}}</font>
				</div>  
				
                <div class="profile-card-bio" style="">
                    {{$user->usr_bio}}
                </div>  
            </div>
            <div align="center" class="profile-card-bottom" style="">
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
                    <!--- button ends --->	
                </div>  
            </div>

            <div class="profile-side" style="margin-top:20px">
                <ul class="pad0" style="list-style: none;color:#555;">
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}">
                            <div class="row-fluid profile-tabs-active" style=""> Reviews <span class="right"> ({{$reviewCount}}) </span> </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}/followers">
                            <div class="row-fluid profile-tabs" style=""> Followers <span class="right"> ({{$followerCount}}) </span> </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}/following">
                            <div class="row-fluid profile-tabs" style=""> Following <span class="right"> ({{$followingCount}}) </span> </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-md-9" style="padding-left: 20px;padding-right:0px;">
            <div  style="height:150px; margin-bottom:20px;font-size:13px;color:#999;">
                <div class="col-md-11 pad0" style="width:92.64%;;">
                    <div class="jcarousel-wrapper">
                        <!-- Carousel -->
                        <div class="jcarousel" data-jcarousel="true">
                            <ul style="left: 0px; top: 0px;">
                                @if(!$fav)
                                <div class=" no-fav-parent ">
                                    <span style="">No Favouties added yet!</span>
                                </div>
                                @endif
                                @foreach($fav as $fasv)
                                <li>
                                    <a href="{{Config::get('url.home')}}movie/{{$fasv->fl_id}}/{{Common::cleanUrl($fasv->fl_name)}}">
                                        <div class="form-group" style="float:left;margin-right:5px">
                                            @if($fasv->fl_image)
                                            <img rel="popover" data-original-title="{{$fasv->fl_name}} ({{$fasv->fl_year}})" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="" title="" class="lazy" width="104px" height="150px" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$fasv->fl_year}}/{{$fasv->fl_image}}">
                                            @else
                                            <img class="lazy" width="104px" height="150px" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg">
                                            @endif
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Prev/next controls 
                        <a href="#" class="jcarousel-control-prev inactive" data-jcarouselcontrol="true">‹ Prev</a>
                        <a href="#" class="jcarousel-control-next inactive" data-jcarouselcontrol="true">Next ›</a>
                        -->
                        <!-- Pagination -->
                        <!---<p class="jcarousel-pagination" data-jcarouselpagination="true"><a href="#1" class="active">1</a></p>
                        -->
                    </div>
                </div>
                <div class="col-md-1 pad0" style="padding-left: 5px;width: 50px;">
                    <div class="" align="center" style="padding-top:30px;width:44px;height:75px;text-align: center;background:#dbdbdb;">
                        <a href="#" class="jcarousel-control-next inactive" data-jcarouselcontrol="true">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </a>    
                    </div>
                    <div class="" align="center" style="padding-top:30px;width:44px;height:75px;text-align: center;background:#dbdbdb;">                   
                        <a href="#" class="jcarousel-control-prev inactive" data-jcarouselcontrol="true">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>  
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="margin-bottom: 0px;"> 
                <div class="col-md-12 pad0" style="border-bottom: 1px solid #ccc">
                    <div class="form-group" style="font-weight:600;font-size: 15px;margin-bottom: 10px;">
                        RECENT ACTIVITY 
                    </div>	
                </div>
            </div>

            @if(!$action)
            <div class="" style="padding-top: 15px;">
                <div class="" style="">
                    No Recent Avitity
                </div>
            </div>
            @endif

            @foreach ($action as $action)
            <?php
            $base = new BaseController();
            $time = $base->getTime($action->action_date);
            ?>


            @if ($action->type_id=="1")
            <?php $film = DB::table('film')->where('fl_id', $action->object_id)->join('rating', 'rating.rt_fl_id', '=', 'film.fl_id')->where('rt_usr_id', $user->id)->first(); ?>

            <div class="row-fluid res-review" style="">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                        <div class="res-review-user col-md-10 pad0">
                            <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                            </a>
                            <div class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper">rated</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
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
            <?php $film = DB::table('film')->where('fl_id', $action->object_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $user->id)->first(); ?>
            @if(Auth::check())
			<?php $like = DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            <?php $likeCount = DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>
			@endif
            <div class="row-fluid res-review" style="">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                        <div class="res-review-user col-md-10 pad0">
                            <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                            </a>
                            <div class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper">reviewed</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a>
                            </div>
                        </div>
                        <div class="res-review-rating col-md-2 pad0">
                            <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:48px;display: inline;float:right;">
                            <span style="background:#dbdbdb;;width:43px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px;color:#666;text-align:center;">
                                {{$film->fr_vote}}                                      
                            </span>
                        </div>
                    </div>
                    <div data-review-id="{{$film->fr_id}}" class="res-review-body review-profile" style="">
                        {{$film->fr_review}}
                    </div>
                    <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                        <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>
                        @if(Auth::check())
                        @if ($like)
                        <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                        <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span>
                        @else

                        <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                        <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span></a>
                        @endif
                        
						@if($user->id==Auth::user()->id)
                        <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
                        @endif 
						

                        @if($likeCount>0)
                        <span href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who agree with this"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-thumbs-up"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                        @endif

                        @if($likeCount>2)
                        <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                        @endif
						
						@endif

                    </div>
                </div>
            </div>


            @elseif ($action->type_id=="3") 
            <?php $film = DB::table('film')->where('fl_id', $action->object_id)->first(); ?>
            <div class="row-fluid res-review" style="">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                        <div class="res-review-user col-md-10 pad0">
                            <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                            </a>
                            <div class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper"> added </span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> <span class="helper"> to watchlist </span>
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


            @elseif ($action->type_id=="4") 
            <?php $object = DB::table('users')->where('id', $action->object_id)->first(); ?>
            <div class="row-fluid res-review" style="">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
                        <div class="res-review-user col-md-9 pad0">
                            <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" style="width: 48px; display: inline;">
                            </a> 
                            <a class="left" style="margin-left: 10px" href="{{Config::get('url.home')}}{{$object->username}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$object->id}}/{{$object->usr_image}}" alt="" style="width: 48px; display: inline;"
                            </a>
                            <div class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper">followed</span> <a href="{{Config::get('url.home')}}{{$object->username}}">{{$object->usr_fname.' '.$object->usr_lname}} </a>
                            </div>
                        </div>
                        <!--<div class="res-review-rating col-md-3 pad0">
                            <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_.jpg" alt="" style="width:48px;display: inline;float:right;">
                            <span style="background:#dbdbdb;;width:40px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px;color:#666;text-align:center;">
                            </span>
                        </div>--->
                    </div>
                    <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                        <span><span class="glyphicon glyphicon-time"></span> {{$time}} </span>
                    </div>
                </div>
            </div>


            @elseif ($action->type_id=="5") 
            <?php $film = DB::table('film')->where('fl_id', $action->object_id)->first(); ?>
            <div class="row-fluid res-review" style="">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:90px;">
                        <div class="res-review-user col-md-10 pad0">
                            <a class="left" href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}" alt="" style="height:90px;width: 60px; display: inline;">
                            </a> 
                            <div class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a> <span class="helper">favourited</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> 
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

    </div>

</div>

@stop


@section('extra')
<script src="{{Config::get('url.home')}}public/bootstrap/js/jquery.jcarousel.min.js"></script>
<script src="{{Config::get('url.home')}}public/bootstrap/js/jcarousel.skeleton.js"></script>
@stop