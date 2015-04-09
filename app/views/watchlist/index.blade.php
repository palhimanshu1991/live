@section('meta')
<title>Watchlist </title>
@stop


@section('container')

<div class="" style="background:rgb(234,234,234);margin: 0px 0px 15px 0px">
    <div class="container">
        <div class="row-fluid" style="padding:0px 0px 20px 0px;">
            <h2 class="">Your Watchlist </h2>
            Here you can see the movies that you have added in your Watchlist. 
        </div>       
    </div>
</div>





<div class="container" id="mainframe" style="min-height:400px;">
    <div class="col-md-9 pad0">
        <ul style="list-style: none;padding-left: 15px;padding-right: 15px;">
            <?php $i = 0; ?>
            @foreach ($watch as $movie)
            <?php $i++; ?>
            <li>
                <div class="row pad0" style="border-bottom: 1px solid #dbdbdb;margin-bottom:10px;padding-bottom:10px">
                    <div class="col-sm-2 left pad0" style="margin-right:15px">
                        <a href="{{Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}" title="{{$movie->fl_name}}">
                            <img class="lazy img-responsive" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
                        </a>
                    </div>
                    <div class="col-md-9 pad0" style="">
                        <div class="row-fluid">
                            <div class="col-md-12 pad0">                                
                                <h2 class="watch-title">
                                    <a href="{{Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}" title="{{$movie->fl_name}}">
                                        {{$movie->fl_name}}
                                </h2>
                                </a>                                
                            </div>                         
                            <div class="col-md-12 pad0 watch-details" style="line-height: 20px; margin-top:10px;">
                                {{$movie->fl_outline}}
                            </div>
                            <div class="col-md-12 pad0 watch-details" style="line-height: 20px; margin-top:10px;">
                                <m>Director: </m> {{$movie->fl_dir_ar_id}}															</div>
                            <div class="col-md-12 pad0 watch-details" style="line-height: 20px; margin-top:0px;">
                                <m>Stars: </m> {{$movie->fl_stars}}															</div>
                            <div class="col-md-12 pad0 watch-details" style="line-height: 20px; margin-top:0px;">
                                <m>Genre: </m>  {{$movie->fl_genre}}														</div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="grid_4 column omega ta-right" style="width:50px">
                        <div class="search-result-stars ln24 clearfix">
                            <div class="right">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="clear"></div>
                    </div>
                </div>
            </li>
            @endforeach


        </ul>
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $watch->links(); ?>
        </div>

    </div>
</div>



@stop