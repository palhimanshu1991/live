@section('meta')
<title>Genre </title>


<style>



</style>

@stop

@section('container')

<div class="res-imagery-default imagery item-to-hide-parent">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding:0px 0px 20px 20px;	">
        <h2 style="font-weight:500;">Search results </h2>
        Displaying movies in the "{{$genre}}" category 
    </section>
</div>


<div class="container" id="mainframe">
    <div class="grid_left column search-start" style="">
        <div class="search_results mbot mtop0">
            <section id="search-results-container">
                <ul>



                    <?php $i = 0; ?>
                    @foreach ($movies as $movie)
                    <?php $i++; ?>
                    <li class="resZS search-result bb  status1" data-res_id="" style="display: list-item;margin: 15px 0px;">
                        <article class="">
                            <div class="grid_8 pos-relative column " style="width: 150px;margin: 0 10px 0px 0px;">
                                <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.home')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}" width="145px" height="215px">
                            </div>
                            <div class="grid_8 pos-relative column alpha" style="width:435px;">
                                <div class="search-name">
                                    <h3 class="top-res-box-name ln24 left">
                                        <a href="{{Config::get('url.home')}}movie/{{$movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}" title="{{$movie->fl_name}}">
                                            {{$movie->fl_name}}
                                        </a>
                                    </h3>
                                    <div class="clear"></div>
                                    <div class="ln24" style="line-height: 20px; margin-top:10px;">
                                        {{$movie->fl_outline}}
                                    </div>
                                    <div class="ln24" style="line-height: 20px; margin-top:10px;">
                                        <b>Director: </b> {{$movie->fl_dir_ar_id}}															</div>
                                    <div class="ln24" style="line-height: 20px; margin-top:0px;">
                                        <b>Stars: </b> {{$movie->fl_stars}}															</div>
                                    <div class="ln24" style="line-height: 20px; margin-top:0px;">
                                        <b>Genre: </b>  {{$movie->fl_genre}}														</div>
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
                            <div class="clear ieclear"></div>
                        </article>
                    </li>
                    <div class="border" style="border-bottom: 2px solid #fff;border-top: 1px solid #efefef;"> </div>			   
                    @endforeach


                </ul>
                <div class="search-pagination-top bb" style="margin-top:10px;">
                    <?php echo $movies->links(); ?>
                </div>

            </section>
            <div class="clear ieclear"></div>

        </div>
    </div>


</div>
@stop
