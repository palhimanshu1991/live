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

<div class="ptop2" style="background:#f3f3f3;padding-bottom:70px;">
	<div class="container ptop2">
	    <div class="row ptop2 ">
	        <div class="col-md-9">
	            <div class="movie-title" style="border-bottom: 1px solid #dbdbdb" >
	                <div class="row">
	                    <div class="col-md-10">
	                        <h1 style=" margin-top: 0;letter-spacing: -0.03em;"><b>{{$movie->fl_name}}</b></h1>                        
	                    </div>
	                    <div class="col-md-2">
	                        <div style="float: right;">
	                            <div class="rating-main">{{$movieRating}}</div>
	                        </div>                        
	                    </div>
	                </div>                
	                <div style="font-size:12px;padding-bottom:10px;color: rgba(0,0,0,0.6);text-transform:uppercase;">
	                    <span rel="tooltip" data-placement="top" title="" data-original-title="Movie Duration" style="margin-left:0px;cursor:pointer;"> <span class="glyphicon glyphicon-time"></span> {{$movie->fl_duration}}</span>
	                    <span rel="tooltip" data-placement="top" title="" data-original-title="Movie Genre" style="margin-left:30px;cursor:pointer;"> <span class="glyphicon glyphicon-film"></span> {{$movie->fl_genre}}</span>
	                    <span rel="tooltip" data-placement="top" title="" data-original-title="Movie Release Date" style="margin-left:30px;cursor:pointer;"> <span class="glyphicon glyphicon-calendar"></span> {{$movie->fl_releasedate}}</span>
	                </div>                 
	            </div>  
	            <div class="row-fluid pad0" style="min-height:80px;margin-bottom:0px;padding-top:0px;font-size:13px;padding-bottom:10px;">
	                <h4 style="line-height: 1.4;font-weight: 500;color: rgba(0,0,0,0.6);letter-spacing: -0.02em;">
	                    {{$movie->fl_outline}}                    
	                </h4>
	                <h4 style="line-height: 1.4;font-weight: 500;color: rgba(0,0,0,0.6);letter-spacing: -0.02em;">
	                    Directed by <span style="font-weight:600">{{$movie->fl_dir_ar_id}}</span> and 
	                    Written by <span style="font-weight:600">{{$movie->fl_writer}}</span>
	                </h4>
	                <h4 style="line-height: 1.4;font-weight: 500;color: rgba(0,0,0,0.6);letter-spacing: -0.02em;">
	                    Starring  <span style="font-weight:600">{{$movie->fl_stars}}</span> 
	                </h4>
	            </div>

            	<div class="row-fluid" style="margin-bottom: 10px;">
            		@if(Auth::check())
	            	<div class="col-md-12 pad0" style="min-height: 50px;">
	            		<a href="#review-form">
		                	<div class="movie-buttons" review-id="4477" rel="tooltip" data-placement="top" title="" data-original-title="Write A Review For This Movie" style="margin-left: 0;">Write Review</div>
		                </a>
						@if(Auth::check())
				            @if ($fav==3)
				            @elseif ($fav==0)
				            <div class="">
				                <div data-id="{{$movie->fl_id}}" id="ajax_add_fav" rel="tooltip" data-placement="top" title="Add To Favourite" data-original-title="Add To Favourite" style="" class="movie-buttons"> <span class="glyphicon glyphicon-heart"></span> </div>
				                <div data-id="{{$movie->fl_id}}" id="ajax_del_fav" rel="tooltip" data-placement="top" title="Remove From Favourite" data-original-title="Remove From Favourite" style="display: none;" class="movie-buttons-active"> <span class="glyphicon glyphicon-heart"></span> </div>
				            </div>
				            @elseif ($fav==1)
				            <div class="">                            
				                <div data-id="{{$movie->fl_id}}" id="ajax_add_fav" rel="tooltip" data-placement="top" title="Add To Favourite" data-original-title="Add To Favourite" style="display: none;" class="movie-buttons"> <span class="glyphicon glyphicon-heart"></span> </div>
				                <div data-id="{{$movie->fl_id}}" id="ajax_del_fav" rel="tooltip" data-placement="top" title="Remove From Favourite" data-original-title="Remove From Favourite" style="" class="movie-buttons-active"> <span class="glyphicon glyphicon-heart"></span> </div>
				            </div>
				            @endif

				            @if ($watch==3)
				            @elseif ($watch==0)
				            <div class="">
				                <div data-id="{{$movie->fl_id}}" id="ajax_add_watch" rel="tooltip" data-placement="top" title="Add To Your Watchlist" data-original-title="Add To Your Watchlist" style="" class="movie-buttons"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
				                <div data-id="{{$movie->fl_id}}" id="ajax_del_watch" rel="tooltip" data-placement="top" title="Remove From Watchlist" data-original-title="Remove From Watchlist" style="display: none;" class="movie-buttons-active"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
				            </div>
				            @elseif ($watch==1)
				            <div class="">                            
				                <div data-id="{{$movie->fl_id}}" id="ajax_add_watch" rel="tooltip" data-placement="top" title="Add To Your Watchlist" data-original-title="Add To Your Watchlist" style="display: none;" class="movie-buttons"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
				                <div data-id="{{$movie->fl_id}}" id="ajax_del_watch" rel="tooltip" data-placement="top" title="Remove From Watchlist" data-original-title="Remove From Watchlist" style="" class="movie-buttons-active"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
				            </div>
				            @endif

				            @if(Auth::user()->usr_level==2)
				            <div class="" style="margin-top:20px;">
				                <div class=" pad0" style="margin-top:10px">
				                    <a href="{{Config::get('url.home')}}movie/{{ $movie->fl_id}}/edit" class="">
				                        <button class="movie-buttons"> Edit </button>
				                    </a>
				                </div>
				            </div>
							<div class="" >
									<div data-id="{{$movie->fl_id}}" id="suggestionAdd-{{$movie->fl_id}}" rel="tooltip" data-placement="top" title="Add To Suggestions" data-original-title="Add To Suggestions" style="" class="movie-buttons suggestionAdd"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
									<div data-id="{{$movie->fl_id}}" id="suggestionDel-{{$movie->fl_id}}" rel="tooltip" data-placement="top" title="Remove from Suggestions" data-original-title="Remove from Suggestions" style="display: none;"  class="movie-buttons suggestionDel"> <span class="glyphicon glyphicon-plus-sign"></span> </div>
							</div>				
				            @endif                
			            @endif


	                    <div class="movie-buttons movie-rating-bar" data-original-rating="{{$rate}}" film-id="{{$movie->fl_id}}" style="margin-left:;padding: 9px 20px;">
	                        <a class="level-1 level-0 @if(1<=$rate) active @endif" data-rating="1" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-2 level-0 @if(2<=$rate) active @endif" data-rating="2" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-3 level-0 @if(3<=$rate) active @endif" data-rating="3" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-4 level-0 @if(4<=$rate) active @endif" data-rating="4" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-5 level-0 @if(5<=$rate) active @endif" data-rating="5" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-6 level-0 @if(6<=$rate) active @endif" data-rating="6" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-7 level-0 @if(7<=$rate) active @endif" data-rating="7" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-8 level-0 @if(8<=$rate) active @endif" data-rating="8" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-9 level-0 @if(9<=$rate) active @endif" data-rating="9" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-10 level-0 @if(10<=$rate) active @endif" data-rating="10" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                    
							<div class="your-review-container"><span class="your-review-rating">@if($rate){{$rate}}@else-@endif</span>/10</div>
	                    </div>
	            		
	            	</div>
	            	@endif
	            </div>

            @if(Auth::check())
            @if($commonFav)        
            <div class="col-md-12 pad0">
                <div class="hidden">	
                    <div class="pad0">
                        <strong style="font-size:16px;">{{count($commonFav)}}</strong> 
                        <span style="font-size:13px">@if(count($commonFav)==1) friend @else friends @endif like this movie</span>
                    </div>
                </div>
                <div class="">	
                    <div class=" pad0">
                        <ul class="pad0" style="list-style: none;margin-top:15px;">
                            <li>
                                @foreach($commonFav as $use)
                                <a href="{{Config::get('url.home')}}{{$use->username}}">
                                    <img rel="tooltip" data-placement="top" title="{{$use->usr_fname.' '.$use->usr_lname}}" data-original-title="{{$use->usr_fname.' '.$use->usr_lname}}" style="height:45px;width:45px;margin-right: 10px;border-radius:50%;  border: 1px solid #ddd;" class="lazy" src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$use->id}}/{{$use->usr_image}}" alt="user photo" title="{{$use->usr_fname.' '.$use->usr_lname}}">	
                                </a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @endif    
	        </div>
	        <div class="col-md-3">
	            <div class="image">           
	                <img class="lazy img-responsive" style="  border: 1px solid rgb(204, 204, 204);max-height: 345px;min-height: 300px;" src="{{ Config::get('url.web')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}"  />
	            </div>            
	        </div>
	        
	    </div>
	</div>
</div>


<div>
	<div class="container ptop2">
		<div class="row">
			<div class="col-md-12">
				<div class="blockDivider"><a class="blockDivider-name">Movies You Might Like</a></div>     				
			</div>
	    	@foreach ($sugg as $film) 
			<a href="{{Config::get('url.home')}}movie/{{$film->fl_id}}/{{Common::cleanUrl($film->fl_name)}}">
		    	<div class="col-md-2 col-xs-6" style="margin-bottom:20px;">
		    		<div class="suggestion-cover ">
		    			<img width="100%" style="border:1px solid #ddd;" class="lazy img-responsive" src="{{Config::get('url.web')}}public/berdict/img/default_poster.jpg"  data-original="{{Config::get('url.web')}}public/uploads/movie/{{$film->fl_year}}/{{$film->fl_image}}">
		    		</div>
		    		<h5><b>{{$film->fl_name}}</b></h5>
		    	</div>
	    	</a>
	    	@endforeach	
		</div>
	</div>
</div>


<div class="container ptop2">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        
					<div class="form-group">	                    
	                    <div class="movie-buttons movie-rating-bar col-xs-12" data-original-rating="{{$rate}}" film-id="{{$movie->fl_id}}" style="margin-left:0px;padding: 15px 20px;border: 1px solid #ddd;border-bottom: none;">
	                        <a class="level-1 level-0 @if(1<=$rate) active @endif" data-rating="1" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-2 level-0 @if(2<=$rate) active @endif" data-rating="2" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-3 level-0 @if(3<=$rate) active @endif" data-rating="3" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-4 level-0 @if(4<=$rate) active @endif" data-rating="4" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-5 level-0 @if(5<=$rate) active @endif" data-rating="5" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-6 level-0 @if(6<=$rate) active @endif" data-rating="6" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-7 level-0 @if(7<=$rate) active @endif" data-rating="7" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-8 level-0 @if(8<=$rate) active @endif" data-rating="8" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-9 level-0 @if(9<=$rate) active @endif" data-rating="9" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                        <a class="level-10 level-0 @if(10<=$rate) active @endif" data-rating="10" film-id="{{$movie->fl_id}}" data-hover-rating="1.0" data-original-title="1.0">&nbsp;</a>                        
	                    
							<div class="your-review-container"><span class="your-review-rating">@if($rate){{$rate}}@else-@endif</span>/10</div>
	                    </div>

	                </div>

                        <div class="form-group" style="margin-bottom:0px">
                            <textarea placeholder="Have you seen this movie? Tell us how was it" name="update" id="update" onkeyup="limiter()" maxlength="400" class="form-control movie-review-textarea" style="min-width:100%;max-width:100%;max-height:120px;border-bottom: none;"></textarea>
                        </div>

						<div class="row" style="margin: 0px 0px;padding: 20px 0px 0px 0px;border-top: none;   border-bottom: 1px solid #ddd;   border-right: 1px solid #ddd;   border-left: 1px solid #ddd;"> 
                            <div class="col-md-6 " style="">
                                <script type="text/javascript">
                                    document.write("<input type=button class=char_count name=limit size=4 readonly value=" + count + " style='cursor:text;'>characters left");
                                </script>
                                <input type="button" class="char_count" name="limit" size="4" readonly="" value="400" style=""> characters left 
                            </div>  
                            <div class="col-md-6 " style="">
                                @if(Auth::user()->fb_access_token)
                                <section class="left" style="margin-left: 20px;margin-top: 8px;"><span class="left"><input checked="checked" id="fbshare" name="fbshare" type="checkbox" value="value" /></span><span rel="tooltip" data-placement="top" title="" data-original-title="Share With Facebook Friends" style="font-size:13px;margin-left:5px;cursor:pointer;">Facebook</span></section>
                                @endif								
                                <div class="form-group" style="float: right;">
                                    <input id="review_submit" type="submit" value="Post Review" class="btn btn-main" style="padding:10px 14px;">
                                </div>                  
                            </div>      
                        </div>                        
                    </form>
                </div>
            </div> 
            @endif          
            @endif            
        </div>
    </div>
</div>




<div class="container ptop2">
    <div class="row">
        <div class="col-md-9 pad0" id="content">
	        
	        <div class="col-md-12" id="noreview">
            	<div class="blockDivider "><a class="blockDivider-name">Latest Reviews</a></div> 
	                @if($reviews==null  && $frreviews==null && $myReview==null)
	                <div id="noreview" class="row-fluid" style="">
	                    <div class="col-md-12 pad0">
	                        <div class="col-md-12 pad0" style="line-height:22px;text-align:center;">
	                            <h3><m>Sorry! No Reviews For This Movie Yet!</m></h3>
	                            <span style="font-size:14px;">Nobody has written a review for <m>{{$movie->fl_name}}</m></span> <br/>
	                            <span style="font-size:14px;">Be the first one to write and <m>get a potato</m> from the team berdict. </span> <br/>
	                        </div>
	                    </div>
	                </div>
	                @endif
	        </div>

	        @if(!$myReview==null)
            <?php $film       =  DB::table('film')->where('fl_id', $myReview->fr_fl_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $myReview->fr_usr_id)->first(); ?>	        
            <?php $like       =  DB::table('review_likes')->where('review_id', $myReview->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            <?php $likeCount  =  DB::table('review_likes')->where('review_id', $myReview->fr_id)->count(); ?>
            <?php                DB::table('film_review')->where('fr_id',$myReview->fr_id)->increment('fr_views'); ?>
            <?php $replies    =  DB::table('review_comments')->where('rc_review_id', $myReview->fr_id)->join('users','users.id','=','review_comments.rc_user_id')->get(); ?>                                   
            <?php $replyCount =  DB::table('review_comments')->where('rc_review_id', $myReview->fr_id)->count(); ?>                                   
            <div class="row-fluid col-md-12" style="margin-bottom:30px;" id="data-review-4477">
               <div class="row" style="margin:0px;">
	               <div class="res-review-user col-md-9 col-xs-9 pad0" style="height: 50px;">
	                  <a class="left" href="{{Config::get('url.home')}}{{$myReview->username}}">
	                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$myReview->id}}/{{$myReview->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
	                  </a>
	                  <div class="feed-rate-user-details">
	                     <a href="{{Config::get('url.home')}}{{$myReview->username}}"><span class="helper">{{$myReview->usr_fname.' '.$myReview->usr_lname}} </span></a> 
	                  </div>
	                  <div class="feed-rate-user-details">
	                     <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;">Wrote a review - </span><span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> </span>
	                  </div>
	               </div>
	               <div class="res-review-rating col-md-3 col-xs-3 pad0" style="">
                   	<img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:36px;display: inline;float:right;">
                    <span style="background:#dbdbdb;;width:36px;height:36px;display: inline;float:right;font-size:20px;font-weight:600;padding:4px 0px;color:#333;text-align:center;">
	                 {{$film->fr_vote}}                                      
	                 </span>
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
               @if(Auth::check())	
               <div class="res-review-actions review-comment-container" review-id="{{$film->fr_id}}" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                  <div class="form-group">
                     <input type="text" class="form-control review-comment" value="" id="" comment-review-id="{{$film->fr_id}}" placeholder="Write a comment">
                  </div>
               </div>
               @endif
            </div>
        @endif



        	@foreach($reviews as $review)
            <?php $film       =  DB::table('film')->where('fl_id', $review->fr_fl_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $review->fr_usr_id)->first(); ?>
            @if(Auth::check())
            <?php $like       =  DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            @endif
            <?php $likeCount  =  DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>
            <?php                DB::table('film_review')->where('fr_id',$film->fr_id)->increment('fr_views'); ?>
            <?php $replies    =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->join('users','users.id','=','review_comments.rc_user_id')->get(); ?>                                   
            <?php $replyCount =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->count(); ?>                                   
            <div class="row-fluid col-md-12" style="margin-bottom:30px;" id="data-review-4477">
               <div class="row" style="margin:0px;">
	               <div class="res-review-user col-md-9 col-xs-9 pad0" style="height: 50px;">
	                  <a class="left" href="{{Config::get('url.home')}}{{$review->username}}">
	                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$review->id}}/{{$review->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
	                  </a>
	                  <div class="feed-rate-user-details">
	                     <a href="{{Config::get('url.home')}}{{$review->username}}"><span class="helper">{{$review->usr_fname.' '.$review->usr_lname}} </span></a> 
	                  </div>
	                  <div class="feed-rate-user-details">
	                     <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;">Wrote a review - </span><span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> </span>
	                  </div>
	               </div>
                  	<div class="res-review-rating col-md-3 col-xs-3 pad0" style="">
                    	<img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:36px;display: inline;float:right;">
                    	<span style="background:#dbdbdb;;width:36px;height:36px;display: inline;float:right;font-size:20px;font-weight:600;padding:4px 0px;color:#333;text-align:center;">
                    	{{$film->fr_vote}}                                      
                    	</span>
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
               @if(Auth::check())
               <div class="res-review-actions review-comment-container" review-id="{{$film->fr_id}}" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                  <div class="form-group">
                     <input type="text" class="form-control review-comment" value="" id="" comment-review-id="{{$film->fr_id}}" placeholder="Write a comment">
                  </div>
               </div>
               @endif
            </div>
        @endforeach


        	@foreach($frreviews as $review)
            <?php $film       =  DB::table('film')->where('fl_id', $review->fr_fl_id)->join('film_review', 'film_review.fr_fl_id', '=', 'film.fl_id')->where('film_review.fr_usr_id', $review->fr_usr_id)->first(); ?>
            <?php $like       =  DB::table('review_likes')->where('review_id', $film->fr_id)->where('user_id', Auth::user()->id)->first(); ?>
            <?php $likeCount  =  DB::table('review_likes')->where('review_id', $film->fr_id)->count(); ?>
            <?php                DB::table('film_review')->where('fr_id',$film->fr_id)->increment('fr_views'); ?>
            <?php $replies    =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->join('users','users.id','=','review_comments.rc_user_id')->get(); ?>                                   
            <?php $replyCount =  DB::table('review_comments')->where('rc_review_id', $film->fr_id)->count(); ?>                                   
            <div class="row-fluid col-md-12" style="margin-bottom:30px;" id="data-review-4477">
               <div class="row" style="margin:0px;">
	               <div class="res-review-user col-md-9 pad0" style="height: 50px;">
	                  <a class="left" href="{{Config::get('url.home')}}{{$review->username}}">
	                    <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$review->id}}/{{$review->usr_image}}" alt="" style="height:36px;width: 36px; display: inline;border-radius:50px;">
	                  </a>
	                  <div class="feed-rate-user-details">
	                     <a href="{{Config::get('url.home')}}{{$review->username}}"><span class="helper">{{$review->usr_fname.' '.$review->usr_lname}} </span></a> 
	                  </div>
	                  <div class="feed-rate-user-details">
	                     <span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;">Wrote a review - </span><span style="color: rgba(0,0,0,0.3);font-size: 13px;line-height: 1.5;"> </span>
	                  </div>
	               </div>
                  	<div class="res-review-rating col-md-3 col-xs-3 pad0" style="">
                     	<img class="img-responsive" src="{{Config::get('url.home')}}public/rate_{{$film->fr_vote}}.jpg" alt="" style="width:36px;display: inline;float:right;">
                     	<span style="background:#dbdbdb;;width:36px;height:36px;display: inline;float:right;font-size:20px;font-weight:600;padding:4px 0px;color:#333;text-align:center;">
                     	{{$film->fr_vote}}                                      
                     	</span>
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
               @if(Auth::check())
               <div class="res-review-actions review-comment-container" review-id="{{$film->fr_id}}" style="font-size: 13px;margin: 20px 0px 15px;letter-spacing: -0.02em;   font-weight: 400;   font-style: normal;color: rgba(0,0,0,0.45);white-space: nowrap;   text-overflow: ellipsis;">
                  <div class="form-group">
                     <input type="text" class="form-control review-comment" value="" id="" comment-review-id="{{$film->fr_id}}" placeholder="Write a comment">
                  </div>
               </div>
               @endif
            </div>
        @endforeach



        </div>
    </div>
</div>



@stop

@section('extra')
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