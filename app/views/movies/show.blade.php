@section('meta')
<title>{{$movie->fl_name}} ({{$movie->fl_year}}) - Berdict</title>
<meta property="og:url" content="{{Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}" />
<link rel='image_src' href="{{Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
<meta property='og:image' content="{{Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}" />
<meta property='og:type' content="video.movie" />
<meta property='fb:app_id' content='{{Config::get('url.fb_id')}}' />
<meta property='og:title' content="{{$movie->fl_name}}" />
<meta property='og:site_name' content='Berdict' />
<meta name="title" content="{{$movie->fl_name}} ({{$movie->fl_year}}) - Berdict" />
<meta name="description" content="Directed by {{$movie->fl_dir_ar_id}}.  Starring {{$movie->fl_stars}}. {{$movie->fl_outline}}." />
<meta property="og:description" content="Directed by {{$movie->fl_dir_ar_id}}.  Starring {{$movie->fl_stars}}. {{$movie->fl_outline}}." />
<meta name="keywords" content="{{$movie->fl_name}} Reviews,{{$movie->fl_name}} Showtimes,{{$movie->fl_name}} User Ratings,{{$movie->fl_name}} Synopsis,{{$movie->fl_name}} Trailers,{{$movie->fl_name}} critic reviews" />
@stop

@section('container')
<div class="container">
    <div class="row-fluid ptop2" >
        <div class="col-sm-4 pad0" style="width:240px;">
            <div class="image">           
                <img class="lazy img-responsive" style="width:239px;height:354px" src="{{ Config::get('url.web')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}"  />
            </div>
			@if(Auth::check())
            <div class="row-fluid" style="margin-top:20px;height:50px">
                <!-- Favourite Button---->
                @if ($fav==3)

                @elseif ($fav==0)
                <div class="">
                    <button data-id="{{$movie->fl_id}}" id="ajax_add_fav" rel="tooltip" data-placement="top" title="Add To Favourite" data-original-title="Add To Favourite" style="" class="col-sm-6 btn fav-add"> <span class="glyphicon glyphicon-heart"></span> </button>
                    <button data-id="{{$movie->fl_id}}" id="ajax_del_fav" rel="tooltip" data-placement="top" title="Remove From Favourite" data-original-title="Remove From Favourite" style="display: none;" class="col-sm-6 btn fav-added"> <span class="glyphicon glyphicon-heart"></span> </button>
                </div>
                @elseif ($fav==1)
                <div class="">                            
                    <button data-id="{{$movie->fl_id}}" id="ajax_add_fav" rel="tooltip" data-placement="top" title="Add To Favourite" data-original-title="Add To Favourite" style="display: none;" class="col-sm-6 btn fav-add"> <span class="glyphicon glyphicon-heart"></span> </button>
                    <button data-id="{{$movie->fl_id}}" id="ajax_del_fav" rel="tooltip" data-placement="top" title="Remove From Favourite" data-original-title="Remove From Favourite" style="" class="col-sm-6 btn fav-added"> <span class="glyphicon glyphicon-heart"></span> </button>
                </div>
                @endif

                <!-- Watchlist Button---->
                @if ($watch==3)

                @elseif ($watch==0)
                <div class="">
                    <button data-id="{{$movie->fl_id}}" id="ajax_add_watch" rel="tooltip" data-placement="top" title="Add To Your Watchlist" data-original-title="Add To Your Watchlist" style="" class="col-sm-6 btn watch-add"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
                    <button data-id="{{$movie->fl_id}}" id="ajax_del_watch" rel="tooltip" data-placement="top" title="Remove From Watchlist" data-original-title="Remove From Watchlist" style="display: none;" class="col-sm-6 btn watch-added"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
                </div>
                @elseif ($watch==1)
                <div class="">                            
                    <button data-id="{{$movie->fl_id}}" id="ajax_add_watch" rel="tooltip" data-placement="top" title="Add To Your Watchlist" data-original-title="Add To Your Watchlist" style="display: none;" class="col-sm-6 btn watch-add"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
                    <button data-id="{{$movie->fl_id}}" id="ajax_del_watch" rel="tooltip" data-placement="top" title="Remove From Watchlist" data-original-title="Remove From Watchlist" style="" class="col-sm-6 btn watch-added"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
                </div>
                @endif
            </div>
			
            @if(Auth::user()->usr_level==2)
            <div class="row-fluid" style="margin-top:20px;">
                <div class="col-sm-12 pad0" style="margin-top:10px">
                    <a href="{{Config::get('url.home')}}movie/{{ $movie->fl_id}}/edit" class="">
                        <button style="background: #2980b9 !important;" class="col-sm-12 btn "> Edit Movie </button>
                    </a>
                </div>
            </div>
			<div class="row-fluid" style="margin-top:0px;">
				<div class="col-sm-12 pad0" style="margin-top:10px">
					<button data-id="{{$movie->fl_id}}" id="suggestionAdd-{{$movie->fl_id}}" rel="tooltip" data-placement="top" title="Add To Suggestions" data-original-title="Add To Suggestions" style="" class="col-sm-12 btn watch-add suggestionAdd"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
					<button data-id="{{$movie->fl_id}}" id="suggestionDel-{{$movie->fl_id}}" rel="tooltip" data-placement="top" title="Remove from Suggestions" data-original-title="Remove from Suggestions" style="display: none;" class="col-sm-12 btn watch-added suggestionDel"> <span class="glyphicon glyphicon-plus-sign"></span> </button>
				</div>
			</div>				
            @endif
            @endif

            <div class="row-fluid suggestion-container" style="">
                <ul class="pad0" style="list-style: none;">
                    <li>
                        <div class="row-fluid review-container-head" style="padding:10px;margin-bottom:-10px"> MOVIE SUGGESTIONS </div>
                    </li>

                    <?php $i = 0; ?>
                    @foreach ($sugg as $film) 
                    <?php $i++; ?>
                    <?php
                    if ($i % 2 != 0) {
                        $class = 'col-md-6 pad0 suggestion-content-left';
                    } else {
                        $class = 'col-md-6 pad0 suggestion-content-right';
                    }
                    ?>
                    <li class="{{$class}}" style="">
                        <a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
                            <div rel="popover" data-original-title="{{$film->fl_name}} ({{$film->fl_year}})" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="" title="">
                                @if($film->fl_image)
                                <img class="lazy img-responsive" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg"  data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}">
                                @else 
                                <img class="lazy img-responsive" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg"  data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}">
                                @endif
                            </div>                        
                        </a>
                    </li>     
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-9 pad0" style="padding-left: 20px;padding-right:0px;">
            <div class="row-fluid movie-details-card"> 
                <div class="movie-title" style="border-bottom: 1px solid #dbdbdb" >
                    <a title="" alt="" name="">
                        <span itemprop="name" style="font-size: 100%">{{$movie->fl_name}} </span> <font style="font-size:13px">({{$movie->fl_year}})</font>
                    </a>
                </div>	
                <div class="col-md-12 pad0" style="min-height:80px;margin-bottom:0px;padding-top:0px;font-size:13px;padding-bottom:10px;">
                    <div style="padding-top:5px;">
                        {{$movie->fl_outline}}
                    </div>
                    <div style="padding-top:5px;">
                        Directed by <span style="font-weight:600">{{$movie->fl_dir_ar_id}}</span> and 
                        Written by <span style="font-weight:600">{{$movie->fl_writer}}</span>
                    </div>
                    <div style="padding-top:5px;">
                        Starring  <span style="font-weight:600">{{$movie->fl_stars}}</span> 
                    </div>
                </div>
                <div style="min-height:67px;margin-bottom:20px;padding-top:5px;font-size:12px;padding-bottom:12px;">
                    <div style="float: left;margin-right: 10px">
                        <div class="rating-main">{{$movieRating}}</div>
                    </div>
                    @if (Auth::check())
                    <div>
                        <span><m>YOUR RATING</m></span><BR/>
                        <div id="movie-rating">
                            <div class="rateit" data-rateit-step="1" data-film="{{$movie->fl_id}}" data-rateit-value="{{$rate}}" data-rateit-min="0" data-rateit-max="10" data-rateit-ispreset="true" ></div>
                        </div>                        
                    </div>
                    @endif
                </div>

                <!--<div style="font-size:13px;">
					<span rel="tooltip" data-placement="top" title="" data-original-title="Movie Duration" style="margin-left:0px;cursor:pointer;"> <span class="glyphicon glyphicon-time"></span> {{$movie->fl_duration}}</span>
					<span rel="tooltip" data-placement="top" title="" data-original-title="Movie Genre" style="margin-left:30px;cursor:pointer;"> <span class="glyphicon glyphicon-film"></span> {{$movie->fl_genre}}</span>
					<span rel="tooltip" data-placement="top" title="" data-original-title="Movie Release Date" style="margin-left:30px;cursor:pointer;"> <span class="glyphicon glyphicon-calendar"></span> {{$movie->fl_releasedate}}</span>
				</div>--->

            </div>

            @if(Auth::check())
            @if($commonFav)
            <div class="row-fluid" style="min-height:85px;background: rgb(230,230,230);padding-left: 15px;padding-right: 15px;padding-top: 8px;margin-bottom:20px"> 
                <div class="row-fluid">	
                    <div class="col-md-12 pad0">
                        <strong style="font-size:16px;">{{count($commonFav)}}</strong> 
                        <span style="font-size:13px">@if(count($commonFav)==1) friend @else friends @endif like this movie</span>
                    </div>
                </div>
                <div class="row-fluid">	
                    <div class="col-md-12 pad0">
                        <ul class="pad0" style="list-style: none;margin-top:5px;">
                            <li>
                                @foreach($commonFav as $use)
                                <a href="{{Config::get('url.home')}}{{$use->username}}">
                                    <img rel="tooltip" data-placement="top" title="{{$use->usr_fname.' '.$use->usr_lname}}" data-original-title="{{$use->usr_fname.' '.$use->usr_lname}}" style="height:38px;width:38px;margin-right: 2px;" class="lazy" src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$use->id}}/{{$use->usr_image}}" alt="user photo" title="{{$use->usr_fname.' '.$use->usr_lname}}" style="display: block;">	
                                </a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endif

            @if(Auth::check())
            @if(Auth::user()->usr_level==2)

            <?php
            if (Auth::user()->id > 100) {
                $random = DB::table('users')->whereBetween('id', array(101, 140))->orderBy(DB::Raw('rand()'))->first();
                $randomUser = $random->id;
            } else {
                $random = DB::table('users')->whereBetween('id', array(1, 100))->orderBy(DB::Raw('rand()'))->first();
                $randomUser = $random->id;
            }

            echo 'Moderator: Using random id ' . $randomUser;

            $check = DB::table('film_review')
                    ->where('fr_fl_id', $movie->fl_id)
                    ->where('fr_usr_id', $randomUser)
                    ->first();
            ?>
            @if($check)
            <div class="row-fluid" style="color:red;font-size:700;"> 
                A Review already posted from this user
            </div>		   
            @else


            <div class="row-fluid"> 
                <div class="error" id="error"> </div>
                <form method="post" name="myform" action="">
                    <div class="col-md-12 pad0" id="review-form" data-id="{{$movie->fl_id}}" data-res-id="{{$randomUser}}">
                        <div class="form-group" style="margin-bottom:0px">
                            <textarea placeholder="Have you seen this movie? Tell us how was it" name="update" id="update" onkeyup="limiter()" maxlength="400" class="form-control" style="min-width:100%;max-width:100%;max-height:120px"></textarea>
                        </div>
                        <div class="row-fluid" style="height:50px;background: rgb(230,230,230);
                             border-right: 1px solid #dbdbdb;
                             border-left: 1px solid #dbdbdb;
                             border-bottom: 1px solid #ccc;
                             margin-bottom: 20px;
                             "> 
                            <div class="col-md-8 pad0" style="font-size: 13px;float:left;height: 36px;">
                                <script type="text/javascript">
                                    document.write("<input type=button class=char_count name=limit size=4 readonly value=" + count + " style='cursor:text;'>characters left");
                                </script>
                                <input type="button" class="char_count" name="limit" size="4" readonly="" value="400" style="cursor:text;margin-left: 10px;
                                       margin-top: 5px;"> characters left 
                            </div>	
                            <div class="col-md-4 pad0" style="float:right;padding-top: 6px;
                                 padding-right: 10px;">
                                <div class="" style="float: left;margin-top: px; margin-left:px;display:block;">
                                    <select name="gender" id="vote" class="" style="padding:2px 2px;">
                                        <option value="0"> Rating </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>	
                                <div class="form-group" style="float: right;">
                                    <input id="update_button_mod" type="submit" value="submit" class="btn btn-main" style="padding:10px 14px;"/>
                                </div>					
                            </div>	
                            </form>
                        </div>						
                    </div>
            </div>         

            @endif
            @else
            <div class="row-fluid"> 
                <div class="error" id="error"> </div>
                <form method="post" name="myform" action="">
                    <div class="col-md-12 pad0" id="review-form" data-id="{{$movie->fl_id}}" data-res-id="{{$user}}">
                        <div class="form-group" style="margin-bottom:0px">
                            <textarea placeholder="Have you seen this movie? Tell us how was it" name="update" id="update" onkeyup="limiter()" maxlength="400" class="form-control" style="min-width:100%;max-width:100%;max-height:120px"></textarea>
                        </div>
                        <div class="row-fluid" style="height:50px;background: rgb(230,230,230);
                             border-right: 1px solid #dbdbdb;
                             border-left: 1px solid #dbdbdb;
                             border-bottom: 1px solid #ccc;
                             margin-bottom: 20px;
                             "> 
                            <div class="col-md-8 pad0" style="font-size: 13px;float:left;height: 36px;">
                                <script type="text/javascript">
                                    document.write("<input type=button class=char_count name=limit size=4 readonly value=" + count + " style='cursor:text;'>characters left");
                                </script>
                                <input type="button" class="char_count" name="limit" size="4" readonly="" value="400" style="cursor:text;margin-left: 10px;
                                       margin-top: 5px;"> characters left 
                            </div>	
                            <div class="col-md-4 pad0" style="float:right;padding-top: 6px;
                                 padding-right: 10px;">
                                @if(Auth::user()->fb_access_token)
                                <section class="left" style="margin-left: 20px;margin-top: 8px;"><span class="left"><input checked="checked" id="fbshare" name="fbshare" type="checkbox" value="value" /></span><span rel="tooltip" data-placement="top" title="" data-original-title="Share With Facebook Friends" style="font-size:13px;margin-left:5px;cursor:pointer;">Facebook</span></section>
                                @endif
                                <div class="form-group" style="float: right;">
                                    <input id="review_submit" type="submit" value="submit" class="btn btn-main" style="padding:10px 14px;"/>
                                </div>					
                            </div>	
                            </form>
                        </div>						
                    </div>
            </div> 
            @endif			
            @endif





            <!---- User Reviews Container --->
            <div id="reviews-container" class="col-md-12 pad0">
                <div class="row-fluid" style=""> 
                    <div class="col-md-12 pad0" style="">
                        <div class="form-group " style="">
                            <h2 class="review-container-head">User Reviews For {{$movie->fl_name}}</h2>   
                        </div>	
                    </div>
                </div>

                @if($reviews==null  && $frreviews==null && $myReview==null)
                <div id="noreview" class="row-fluid" style="border-top:1px solid #dbdbdb;height:103px;padding-top: 10px;border-bottom:1px solid #dbdbdb;">
                    <div class="col-md-12 pad0">
                        <div class="col-md-2 pad0" style="width:90px">
                            <img width="80px" src="{{Config::get('url.web')}}public/sad.jpg">
                        </div>
                        <div class="col-md-10 pad0" style="line-height:22px">
                            <span style="font-size:16px;"><m>uh oh! this is sad!</m></span> <br/>
                            <span style="font-size:14px;">Nobody has written a review for <m>{{$movie->fl_name}}</m></span> <br/>
                            <span style="font-size:14px;">Be the first one to write and <m>get a potato</m> and <m>a tight hug</m> from the team berdict. </span> <br/>
                        </div>
                    </div>
                </div>
                @endif


                @if(!$myReview)
                <div class="res-reviews-container">
                    <div id="content">

                    </div>
                </div>
                @endif
                @if(!$myReview==null)
                <?php $like = DB::table('review_likes')->where('review_id', $myReview->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
                <?php $likeCount = DB::table('review_likes')->where('review_id', $myReview->fr_id)->count(); ?>
                <?php
                $base = new BaseController();
                $time = $base->getTime($myReview->fr_date);
                ?>
                <div class="row-fluid review-container-subhead"  style="">
                    My Review <b class="caret caret-subhead"></b>
                </div>
                <div class="row-fluid res-review" id="data-review-{{$myReview->fr_id}}" style="">
                    <div class="res-review-header col-md-12 pad0" style="">
                        <div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
                            <div class="res-review-user col-md-9 pad0">
                                <a class="left" href="{{Config::get('url.web')}}{{$myReview->username}}">
                                    <img class="lazy img-responsive " src="{{Config::get('url.web')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$myReview->id}}/{{$myReview->usr_image}}" alt="" style="width: 48px; height:48px; display: inline;">
                                </a>
                                <div class="res-review-user-details">
                                    <a href="{{Config::get('url.home')}}{{$myReview->username}}"> {{$myReview->usr_fname.' '.$myReview->usr_lname}} </a> 
                                </div>
                            </div>
                            <div class="res-review-rating col-md-3 pad0">
                                <img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$myReview->fr_vote}}.jpg" alt="" style="width:48px;display: inline;float:right;">
                                <span style="background:#dbdbdb;;width:36px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
                                    {{$myReview->fr_vote}}
                                </span>
								<!--<img class="img-responsive" src="{{Config::get('url.home')}}public/berdict/img/first_review.png" alt="" style="height:36px;display: inline;float:right;padding-right:10px;">-->                           
							</div>
                        </div>

                        <div data-review-id="{{$myReview->fr_id}}" class="res-review-body" style="">
                            <div>
                                {{$myReview->fr_review}} 
                            </div>                                    
                        </div>
                        <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                            <a href="{{Config::get('url.home')}}reviews/{{$myReview->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>
							<span class="review-like" style="margin-left:15px" title=""> <span class="glyphicon glyphicon-eye-open"></span> {{$myReview->fr_views}} </span>
                                    
                            @if(Auth::check())
                            @if ($like)


                            <span class="review-like" id="review-like-{{$myReview->fr_id}}" data-id="{{$myReview->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-heart"></span> Like</span>
                            <span class="review-unlike" id="review-unlike-{{$myReview->fr_id}}" data-id="{{$myReview->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span>
                            @else

                            <span class="review-like" id="review-like-{{$myReview->fr_id}}" data-id="{{$myReview->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Like</span>
                            <span class="review-unlike" id="review-unlike-{{$myReview->fr_id}}" data-id="{{$myReview->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span></a>
                            @endif
                            @endif

                            @if(Auth::check()) @if($myReview->id==Auth::user()->id)
                            <a href="{{Config::get('url.home')}}reviews/{{$myReview->fr_id}}/edit"><span rel="tooltip" data-placement="top" title="" data-original-title="Edit Review"  style="margin-left:15px"> <span class="glyphicon glyphicon-pencil"></span> EDIT</span></a>
                            <span class="delete" review-id="{{$myReview->fr_id}}" rel="tooltip" data-placement="top" id="delete" title="" data-original-title="Delete Review" style="margin-left:15px"> <span class="glyphicon glyphicon-trash"></span> DELETE</span>
                            @endif @endif

                            @if($likeCount>0)
                            <span href="{{Config::get('url.home')}}reviews/{{$myReview->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="{{$likeCount}} like this review"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-heart"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                            @endif

                            @if($likeCount>2)
                            <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                            @endif

                        </div>

                    </div>
                </div>
                @endif





                @if(!$frreviews==null || !$frreviews=="")
                <div class="row-fluid review-container-subhead" style="margin-top:-1px">
                    Reviews and Rating of Friends <b class="caret caret-subhead"></b>
                </div>
                <div class="res-reviews-container">
                    <div id="content">
                        @foreach($frreviews as $frreview)
                        @if(Auth::check())
                        <?php $like = DB::table('review_likes')->where('review_id', $frreview->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
                        @endif
                        <?php $likeCount = DB::table('review_likes')->where('review_id', $frreview->fr_id)->count(); ?>
                        <?php
                        $base = new BaseController();
                        $time = $base->getTime($frreview->fr_date);
                        ?>
                        <div class="row-fluid res-review" style="">
                            <div class="res-review-header col-md-12 pad0" style="">
                                <div class="res-review-header col-md-12 pad0" style="width:100%;height:48px;">
                                    <div class="res-review-user col-md-9 pad0">
                                        <a class="left" href="{{Config::get('url.home')}}{{$frreview->username}}">
                                            <img class="lazy img-responsive " src="{{Config::get('url.web')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$frreview->id}}/{{$frreview->usr_image}}" alt="" style="width:48px;height:48px;display: inline;">
                                        </a>
                                        <div class="res-review-user-details">
                                            <a href="{{Config::get('url.home')}}{{$frreview->username}}">{{$frreview->usr_fname.' '.$frreview->usr_lname}}</a> 
                                        </div>
                                    </div>
                                    <div class="res-review-rating col-md-3 pad0">
                                        <img class="img-responsive" src="{{Config::get('url.web')}}public/rate_{{$frreview->fr_vote}}.jpg"  alt="" style="width:48px;display: inline;float:right;"></span>
                                        <span  style="background:#dbdbdb;;width:36px;height:48px;display: inline;float:right;font-size:20px;font-weight:600;padding:10px 0px;color:#666;text-align:center;">
                                            {{$frreview->fr_vote}}</span>
                                    </div>
                                </div>

                                <div data-review-id="{{$frreview->fr_id}}" class="res-review-body" style="">
                                    <div>
                                        {{$frreview->fr_review}}    
                                    </div>                                    
                                </div>
                                <div class="res-review-actions" style="font-size:11px;margin-top:8px;font-weight:600;">
                                    <a href="{{Config::get('url.home')}}reviews/{{$frreview->fr_id}}"><span><span class="glyphicon glyphicon-time"></span> {{$time}} </span></a>
									<span class="review-like" style="margin-left:15px" title=""> <span class="glyphicon glyphicon-eye-open"></span> {{$frreview->fr_views}} </span>
                                    
                                    @if(Auth::check())
                                    @if ($like)


                                    <span class="review-like" id="review-like-{{$frreview->fr_id}}" data-id="{{$frreview->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-heart"></span> Like</span>
                                    <span class="review-unlike" id="review-unlike-{{$frreview->fr_id}}" data-id="{{$frreview->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span>
                                    @else

                                    <span class="review-like" id="review-like-{{$frreview->fr_id}}" data-id="{{$frreview->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Like</span>
                                    <span class="review-unlike" id="review-unlike-{{$frreview->fr_id}}" data-id="{{$frreview->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span></a>
                                    @endif
                                    @endif

                                    @if($likeCount>0)
                                    <span href="{{Config::get('url.home')}}reviews/{{$frreview->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="{{$likeCount}} like this review"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-heart"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                                    @endif

                                    @if($likeCount>2)
                                    <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                                    @endif

                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @endif

                @if(!$reviews==null ||  $reviews=="")
                <div class="row-fluid review-container-subhead"  style="margin-top:-1px">
                    Other Reviews <b class="caret caret-subhead"></b>
                </div>
                @endif
                <div class="res-reviews-container">
                    <div id="others-content">
                        @foreach($reviews as $review)
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
									<span class="review-like" style="margin-left:15px" title=""> <span class="glyphicon glyphicon-eye-open"></span> {{$review->fr_views}} </span>
                                    @if(Auth::check())
                                    @if ($like)
                                    <span class="review-like" id="review-like-{{$review->fr_id}}" data-id="{{$review->fr_id}}" style="display: none;margin-left:15px" title=""> <span class="glyphicon glyphicon-heart"></span> Like</span>
                                    <span class="review-unlike" id="review-unlike-{{$review->fr_id}}" data-id="{{$review->fr_id}}"  title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span>
                                    @else

                                    <span class="review-like" id="review-like-{{$review->fr_id}}" data-id="{{$review->fr_id}}" title="" style="margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Like</span>
                                    <span class="review-unlike" id="review-unlike-{{$review->fr_id}}" data-id="{{$review->fr_id}}" title="" style="display: none;margin-left:15px"> <span class="glyphicon glyphicon-heart"></span> Liked</span></a>
                                    @endif
                                    @endif
									
                                    
                                    @if($likeCount>0)
                                    <span href="{{Config::get('url.home')}}reviews/{{$review->fr_id}}/people" data-toggle="modal" data-target="#people" class="" rel="tooltip" data-placement="left" title="" data-original-title="{{$likeCount}} like this review"  style="margin-left:15px;float: right;color:#666;"> <span style="" class="glyphicon glyphicon-heart"></span> {{$likeCount}} @if($likeCount<2)  @else  @endif</span>
                                    @endif

                                    @if($likeCount>2)
                                    <span class="right" rel="tooltip" data-placement="top" title="" data-original-title="Top Review"  style="margin-left:15px;color:#fe2020;"> <span style="" class="glyphicon glyphicon-star"></span></span> 
                                    @endif

                                </div>

                            </div>




							
							
					
							
							
							
							
							
							
							

							</div>
                        @endforeach
                    </div>
					@if($reviewCount>5)
					<div id="load-more" data-count="{{Count($reviews)}}" data-total="{{$reviewCount}}" data-id="{{$movie->fl_id}}"  align="center" style="cursor:pointer;font-size:14px;height:40px;background:#dbdbdb;margin-top:10px;padding-top:10px;font-weight:600;text-transform:uppercase;"> 
						load more
					</div>
					@endif
                </div>


            </div>








        </div>

    </div>

</div>
<!---
<div class="res-imagery-default imagery item-to-hide-parent" style="">  
    <section class="res-main res-imagery-tshadow container clearfix" style="padding:15px 0px;min-height: 700px">


<!---
<div class="col-lg-6 pad0" style="min-height: 267px;padding: 0px 20px 0px 0px;">
    <div class="" style="min-height:267px;">
        <div class="movie-mid-data" style="">
            <div class="">
                {{$movie->fl_outline}}                        
            </div>
        </div>
        <br/>
        <div class="movie-mid-data" itemprop="director" itemscope itemtype="http://schema.org/Person">
            <div class="">
                <span style="margin-right: 10px;"><b>Directer: </b></span> 
                <span class="itemprop" itemprop="name">{{$movie->fl_dir_ar_id}}</span>                      
            </div>
        </div>
        <div class="movie-mid-data" itemprop="creator" itemscope itemtype="http://schema.org/Person">
            <div class="">
                <span style="margin-right: 22px;"><b>Writer: </b></span> 
                <span class="itemprop" itemprop="name">{{$movie->fl_writer}}</span>                     
            </div>
        </div>
        <div class="movie-mid-data" itemprop="actors" itemscope itemtype="http://schema.org/Person">			  
            <div class="">
                <span style="margin-right: 32px;"><b>Stars: </b></span> 
                {{$movie->fl_stars}}
            </div>
        </div>
    </div>
</div>
--->
<!--
<div class="col-lg-3" style="">
    <div class="grid_3">
        <div class="movie_details" style="">
            <div style="font-size:13px;margin-bottom:5px;cursor:pointer;" rel="tooltip" title="Movie Category">
                <span style="color:#27ae60;" class="glyphicon glyphicon-tags"> </span>
                <span style="margin-left: 10px"> {{$movie->fl_genre}} </span> 
            </div>
            <div style="font-size:13px;margin-bottom:5px;cursor:pointer;" rel="tooltip" title="Movie Duration">
                <span style="color:#8e44ad;" class="glyphicon glyphicon-time"> </span>
                <span style="margin-left: 10px"> {{$movie->fl_duration}} duration  </span> 
            </div>
            <div style="font-size:13px;margin-bottom:20px;cursor:pointer;" rel="tooltip" title="Movie Release Date">
                <span style="color:#2980b9;" class="glyphicon glyphicon-calendar"> </span>
                <span style="margin-left: 10px"> {{$movie->fl_releasedate}} </span> 
            </div>
            <div style="font-size:13px;margin-bottom:5px;cursor:pointer;" rel="tooltip" title="476 people added this movie to their watchlist">
                <span style="color:#16a085;" class="glyphicon glyphicon-plus"> </span>
                <span style="margin-left: 10px">476 want to watch this</span> 
            </div>
            <div style="font-size:13px;margin-bottom:5px;cursor:pointer;" rel="tooltip" title="234 people added this movie to their favourites">
                <span style="color:#c0392b;" class="glyphicon glyphicon-heart"> </span>
                <span style="margin-left: 10px">234 added to favorites</span> 
            </div>
            <div style="font-size:13px;margin-bottom:5px;cursor:pointer;" rel="tooltip" title="blh  ablh">
                <span style="color:#3498db;" class="glyphicon glyphicon-comment"> </span>
                <span style="margin-left: 10px">95 reviews by user </span> 
            </div>
        </div>
    </div>
</div>
</section>
</div>-->













@stop