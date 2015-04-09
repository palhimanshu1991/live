
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

        <div class="row-fluid res-review" style="">
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
                <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span>
                @else

                <span class="review-like" id="review-like-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agree</span>
                <span class="review-unlike" id="review-unlike-{{$film->fr_id}}" data-id="{{$film->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-thumbs-up"></span> Agreed</span></a>
                @endif
                @endif

                @if(Auth::check()) @if($film->fr_usr_id==Auth::user()->id)
                <a href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
                <!--<span rel="tooltip" data-placement="top" data-toggle="modal" data-target="#myModal" title="" data-original-title="Delete Review" style="margin-left:15px"> <span class="glyphicon glyphicon-trash"></span> DELETE</span>-->
                @endif @endif

                @if($likeCount>0)
                <span href="{{Config::get('url.home')}}reviews/{{$film->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="People who agree"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-thumbs-up"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
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
 