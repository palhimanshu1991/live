@section('meta')
<title>{{$movie->fl_name}} ({{$movie->fl_year}}) Reviews - User Reviews , Critic Reviews -  Berdict</title>
<meta property="og:url" content="" />
<link rel='image_src' href="{{Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
<meta property='og:image' content="{{Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}" />
<meta property='og:type' content="video.movie" />
<meta property='fb:app_id' content='437161969726572' />
<meta property='og:title' content="{{$movie->fl_name}} ({{$movie->fl_year}})" />
<meta property='og:site_name' content='Berdict' />
<meta name="title" content="{{$movie->fl_name}} ({{$movie->fl_year}}) Reviews - Berdict" />
<meta name="description" content="{{$movie->fl_name}} ({{$movie->fl_year}}) is Directed by {{$movie->fl_dir_ar_id}}.  Starring {{$movie->fl_stars}}. {{$movie->fl_outline}}." />
<meta property="og:description" content="{{$movie->fl_name}} ({{$movie->fl_year}}) Directed by {{$movie->fl_dir_ar_id}}.  Starring {{$movie->fl_stars}}. {{$movie->fl_outline}}." />
<meta name="keywords" content="{{$movie->fl_name}} ({{$movie->fl_year}}),{{$movie->fl_name}} ({{$movie->fl_year}}) reviews,{{$movie->fl_name}} Reviews,{{$movie->fl_name}} Showtimes,{{$movie->fl_name}} User Ratings,{{$movie->fl_name}} Synopsis,{{$movie->fl_name}} Trailers,{{$movie->fl_name}} critic reviews" />
@stop


@section('container')
<div class="res-imagery-default imagery item-to-hide-parent">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding:0px 0px 20px 20px;	">
        <h2 style="font-weight:500;"></h2>
    </section>
</div>


<div class="container" id="mainframe">
    <div class="grid_left column search-start" style="min-height:600px">
        <div class="search_results mbot mtop0">
            <section id="search-results-container">



                <div style="" class="bold_dark">{{$movie->fl_name}} User Reviews ({{$reviewCount}}) </div>




                @foreach($reviews as $rev)
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
                                                <div class="small-rating level-6"><b>{{$rev->rt_vote}}</b></div>
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



            </section>
        </div>
    </div>

    <div class="grid_4 column zbans omega mtop right" style="width:262px;">             
        <div class="zban">
            <div class="sug_box right" style="margin-top:10px;">
                @if ($movie->fl_image)
                <img class="lazy" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}"  height="360" width="240px" title="" alt="" itemprop="image"  />
                @else
                <img class="lazy" src="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{ Config::get('url.home')}}public/berdict/img/default_poster.jpg"  height="317" width="220px" title="" alt="" itemprop="image"  />
                @endif
            </div>
        </div>
    </div>

</div>



@stop
