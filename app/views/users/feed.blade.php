@section('meta')
<title>Berdict</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />
@stop


@section('container')


<div class="" style="background:rgb(234,234,234);">
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
    <div class="col-md-9 pad0 grid_left column" style="margin-bottom: 20px;margin-right: 20px;width:700px;   ">
        <div class="review-container-head" style="border-bottom: 1px solid #dbdbdb;padding-bottom:10px;margin-bottom:0px"> Recent Activity </div>

        <!--- Recent Reviews--->

        <ul id="myTab" class="nav nav-tabs" style="font-size:13px;">
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

                @if ($action->type_id=="1")
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
                                <!--    <a href="{{Config::get('url.home')}}{{$action->username}}">{{$action->usr_fname}}</a> <span class="helper">rated</span> <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">{{$film->fl_name}}</a> --->
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
                <?php $film = DB::table('film')->where('fl_id', $action->object_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $action->id)->first(); ?>
                <?php $like = DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
                <?php $likeCount = DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>

                <div class="row-fluid res-review" style="" id="data-review-{{$film->fr_id}}">
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

                @elseif ($action->type_id=="3") 
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

                @elseif ($action->type_id=="5") 
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
    <!--- Right box starts---->
    <div class="col-md-3 pad0" style="">
        <div class="row-fluid">

            <div style="border-bottom: 1px solid #dbdbdb;padding-bottom:10px;margin-bottom:0px" class="review-container-head">  <span class="ion-arrow-graph-up-right"></span> Trending Critics </div>

            @if(Auth::check())

            @foreach ($critics as $user)
            <?php
            $check = DB::table('user_friends')
                    ->where('friend_user_id', $user->id)
                    ->where('follower_user_id', Auth::user()->id)
                    ->first();
            ?>
            <div class="row-fluid res-review" style="padding-top:10px">
                <div class="res-review-header col-md-12 pad0" style="">
                    <div class="res-review-header col-md-12 pad0" style="width:100%;height:45px;">
                        <div class="res-review-user col-md-10 pad0">
                            <a class="left" href="{{Config::get('url.home')}}{{$user->username}}">
                                <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" style="height: 45px; width: 45px; display: inline;">
                            </a>
                            <div style="font-size: 13px;" class="res-review-user-details">
                                <a href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a>  
                            </div>
                        </div>
                        <div class="res-review-rating col-md-2 pad0">
                        </div>
                    </div>
                </div>
            </div>           
            @endforeach

            @endif

            <div class="row-fluid feed-suggestion-container" style="min-height:960px;display: block;margin-bottom:20px;">
                <div class="review-container-head" style="border-bottom: 1px solid #dbdbdb;padding-bottom:10px;margin-bottom:0px"> Recent Movies </div>

                <ul class="pad0" style="list-style: none;display: block">

                    <?php $i = 0; ?>
                    @foreach ($recent as $recent) 
                    <?php $i++; ?>
                    <?php
                    if ($i % 2 != 0) {
                        $class = 'col-md-6 pad0 feed-content-left';
                    } else {
                        $class = 'col-md-6 pad0 feed-content-right';
                    }
                    ?>
                    <li class="{{$class}}" style="">
                        <a href="{{Config::get('url.home')}}movie/{{$recent->fl_id}}/{{Common::cleanUrl($recent->fl_name)}}">
                            <div rel="popover" data-original-title="{{$recent->fl_name}} ({{$recent->fl_year}})" data-container="body" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="{{$recent->fl_outline}}" title="">
                                @if($recent->fl_image)
                                <img class="lazy img-responsive" src="{{Config::get('url.web')}}public/uploads/movie/{{$recent->fl_year}}/{{$recent->fl_image}}">
                                @else 
                                <img class="lazy img-responsive" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg"  data-original="{{Config::get('url.web')}}public/uploads/movie/{{$recent->fl_year}}/{{$recent->fl_image}}">
                                @endif
                            </div>                        
                        </a>
                    </li>     
                    @endforeach
                </ul>
            </div>




        </div>
    </div>
    <!-- Right box ends ---->
</div>

@stop

@section('extra')
<script src="{{Config::get('url.home')}}public/bootstrap/js/jquery.jcarousel.min.js"></script>
<script src="{{Config::get('url.home')}}public/bootstrap/js/jcarousel.skeleton.js"></script>

<script type="text/javascript">
    mixpanel.track("feed-page");  
</script>

@stop

