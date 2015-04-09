@section('meta')
<title>Berdict - short movie reviews from your friends and critics.</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />


@stop


@section('container')


@if(Auth::check())
@else
<div class="res-imagery-default imagery item-to-hide-parent" style="min-height:650px;background:#f3f3f3;">
    <div class="container" style="height:100%;">
        <section class="" style="min-height:250px;"> 

            <div class="grid_16 column ptop2" align="center" style="padding-top: 20px;text-shadow: 1px 1px 1px #efefef;">
                <h1 style="font-weight:700;font-size: 4em;margin:0px;text-transform: uppercase;"> short movie reviews</h1>
                <h2 style="font-weight:700;margin:0px;font-size: 1.6em;text-transform: uppercase;"> from your friends and critics </h2>
            </div>
            <div class="grid_16 column" align="center" style="">
                <img class="grid_8" src="{{Config::get('url.home')}}public/berdict/img/home_intro.jpg">
            </div>
            <div class="grid_16 column" align="center" style="">
                <div class="grid_1by3 column" style="margin:0px 10px 0px 0px;">
                    <h2 style="font-weight:700;margin:0px;font-size: 1.6em;text-transform: uppercase;"> Fast </h2>
                    Micro Reviews of 400 characters. Short, Crisp and Fun
                </div>
                <div class="grid_1by3 column" style="margin: 0 10px;">
                    <h2 style="font-weight:700;margin:0px;font-size: 1.6em;text-transform: uppercase;">Social</h2>
                    Opinion of your friends, their reviews and ratings and much more
                </div>
                <div class="grid_1by3 column" style="margin: 0px 0px 0px 10px;">
                    <h2 style="font-weight:700;margin:0px;font-size: 1.6em;text-transform: uppercase;">Easy</h2>
                    Manage your Watchlist, Add your Favourites 
                </div>
            </div>
            <div class="grid_16 column ptop0" align="center" style="">
                <div class="">	
                    <a href="{{ Config::get('url.home')}}signup" style="padding:15px 70px;font-size: 22px;margin:30px 0px 10px 0px;" class="btn-big-main">SIGN UP TODAY </a>
                </div>
                <f style="color:#fe2020;font-weight:700;margin:0px;font-size: 1.1em;text-transform: uppercase;"> Made for movie lovers <img style="margin-top:-5px;height:17px;width: 17px" src="./public/berdict/img/icon_fav.png"> </f>
            </div>
            <!---
            <div class="grid_16 column ptop2" style="height:100%;padding-top: 35px;text-shadow: 1px 1px 1px #efefef;">
                <h1 style="font-weight:600;font-size: 3em;margin:0px;"> Why use Berdict?</h1>
                <h2 style="font-weight:600;margin:0px;font-size: 1.4em;"> 
                    <b>Ain't nobody got time for long reviews.</b> On Berdict, you can write a review of maximum 400 characters. The short reviews are fun and to the point and help readers to get more opinions from different users in less time.
                </h2><br>
                <h2 style="font-weight:600;margin:0px;font-size: 1.4em;"> 
                    <b>It's more Social.</b> That means you can read the opinions of your friends on a movie you recently watched or a movie you want to watch.
                </h2><br>
                <h2 style="font-weight:600;margin:0px;font-size: 1.4em;"> 
                    <b>Organise Better.</b> Make a list of movies you wanted to watch, and easily keep a track of them, add your favourite movies and let everyone know about your taste in movies.  <b> and much more....</b>
                </h2>
                <div style="">
                    <div class="right" style="background:url(http://www.berdict.com/images/home_intro.png); width:135px; height:135px;">					
                    </div>
                    <div class="left">	
                        <a href="{{ Config::get('url.home')}}signup" style="padding:15px 70px;font-size: 22px;margin: 35px 0px;" class="update_button">SIGN UP TODAY </a>
                    </div>	
                </div>	
            </div>
            -->
        </section>
    </div>
</div>
@endif


<div class="res-imagery-default imagery item-to-hide-parent " style="background: rgb(235,235,235);">
    <div class="container" style="height:100%;">
        <section class="" style="min-height:380px;"> 
            <div class="grid_17 column ptop2" style="height:100%;padding-top: 35px;">
                @foreach ($spot as $movie)
                <div class="grid_4 left alpha top-user-rev-a" style="">									
                    <a href="{{ Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}">
                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{ $movie->fl_image}}" width="212" height="312" style="">
                    </a>
                </div>	
                @endforeach
            </div>
        </section>
    </div>
</div>




<div class="res-imagery-default imagery item-to-hide-parent" style="min-height:240px;background: rgb(245,245,245)">
    <div class="container" style="height:100%;">
        <section class="" style="min-height:240px;"> 
            <div class="grid_17 column ptop2" style="height:100%;padding-top: 30px;">

                @foreach ($other as $movie)
                <div class="grid_2 left alpha top-user-rev-a similar_likes" style="width:109px;margin:0;">									
                    <a href="{{ Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}">
                        <img class="lazy" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}" width="120px" height="180px" style="">
                    </a>
                </div>	
                @endforeach

            </div>
        </section>
    </div>
</div>








<div class="container mtop2" id="mainframe">
    <div class="grid_left column" style="margin-bottom: 20px;   ">
        <div style="" class="bold_dark"> Recent Reviews </div>

        <!--- Recent Reviews--->
        @foreach ($review as $rev)
        <div class="res-reviews-container" style="width:690px;">
            <div class="zs-following-list">
                <div class="res-review clearfix mbot2   item-to-hide-parent">
                    <div class="error-message-highlight review-message hidden mbot"></div>
                    <div class="res-review-header clearfix">
                        <div class="grid_5 column alpha" style="width:600px;">
                            <div class="user-snippet">
                                <a class="left user-snippet-image" href="{{ Config::get('url.home')}}{{$rev->username}}">
                                    <img class="lazy" src="{{ Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{ Config::get('url.home')}}public/user_uploads/1000/{{$rev->id}}/{{$rev->usr_image}}" alt="" width="" height="">
                                </a>
                                <div class="user-snippet-details">
                                    <div><a class="semi-bold" href="{{ Config::get('url.home')}}{{$rev->username}}">{{$rev->usr_fname.' '.$rev->usr_lname }}</a> wrote a review for                                                
                                        <b><a class="semi-bold" href="{{ Config::get('url.home')}}movie/{{$rev->fl_id}}/{{Common::cleanUrl($rev->fl_name)}}">{{$rev->fl_name}}</a></b>
                                         </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="res-review-top-right">
                            <div class="res-review-top-right-rating">
                                <div class="left" style="background: none">
                                                   <div class="right">
                                                       <div class="small-rating level-6"><b>{{$rev->fr_vote}}</b></div>
                                                   </div>
                                               </div>
                                               <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                                <div class="res-review-top-right-text">
                                    <a href="" class="res-review-date"></a>
                                </div>
                            </div>
                        </div>
                        <div class="res-review-body clearfix" style="padding:10px 5px 0px 10px;margin: 0px 0px 5px 0px;background: #f3f3f3;">
                            <div>
                                {{$rev->fr_review}}
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="border" style="border-top: 1px solid #efefef;"> </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--- Right box starts---->
        <div class="grid_4 column zbans omega" style="width:262px;">
                <div>

                    <div style="" class="bold_head">Recent Releases</div> 
                    <div class="sug_box" style="margin-top:10px;">	  
                        @foreach ($recent as $movie)
                        <a href="{{Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}" style="text-decoration:none;">
                            <div class="sug_back" style=""> 
                                {{$movie->fl_name}}
                            </div>
                        </a>
                        @endforeach
                    </div>  


                    <div style="margin-top: 20px" class="bold_head">Movie Categories</div> 
                <div class="sug_box" style="margin-top:10px;">	  
                                           @foreach ($categories as $cat)
                                           <a href="{{Config::get('url.home')}}genre/{{$cat->fc_name}}" style="text-decoration:none;">
                                               <div class="sug_back" style=""> 
                                                   {{$cat->fc_name}}
                                               </div>
                                           </a>
                                           @endforeach
                                       </div> 
                                      </div>
                </div>
                <!-- Right box ends --->
            </div>






            @stop

