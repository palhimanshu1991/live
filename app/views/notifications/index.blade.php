@section('container')



<div class="res-imagery-default imagery item-to-hide-parent">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding:0px 0px 20px 20px;	">
        <h2 style="font-weight:500;">Your Notifications </h2>
        Here you can see all your recent notifications. 
    </section>
</div>


<div class="container" id="mainframe">
    <div class="grid_left column search-start" style="">
        <div class="search_results mbot mtop0">
            <section id="search-results-container">
                <ul>
                    @foreach ($noti as $noti)

                    <li style="padding: 10px 0px;border-bottom: 1px solid #efefef;">

                        @if($noti->read=="0")

                        @if($noti->type=="follow")
                        <?php $user = DB::table('users')->where('id', $noti->subject_id)->first(); ?>
                        <div class="res-review-header clearfix">
                            <div class="grid_5 column alpha" style="width:600px;">
                                <div class="user-snippet">
                                    <a class="left user-snippet-image" href="{{Config::get('url.home')}}{{$user->username}}">
                                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" width="" height="" style="display: inline;">
                                    </a>
                                    <div class="user-snippet-details">
                                        <div><a class="semi-bold" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a> started following you                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <?php $user = DB::table('users')->where('id', $noti->subject_id)->first(); ?>
                        <div class="res-review-header clearfix">
                            <div class="grid_5 column alpha" style="width:600px;">
                                <div class="user-snippet">
                                    <a class="left user-snippet-image" href="{{Config::get('url.home')}}{{$user->username}}">
                                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" width="" height="" style="display: inline;">
                                    </a>
                                    <div class="user-snippet-details">
                                        <div><a class="semi-bold" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a> liked your                                               
                                            <b><a class="semi-bold" href="{{Config::get('url.home')}}reviews/{{$noti->object_id}}"> review </a></b> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @else

                        @if($noti->type=="follow")
                        <?php $user = DB::table('users')->where('id', $noti->subject_id)->first(); ?>
                        <div class="res-review-header clearfix">
                            <div class="grid_5 column alpha" style="width:600px;">
                                <div class="user-snippet">
                                    <a class="left user-snippet-image" href="{{Config::get('url.home')}}{{$user->username}}">
                                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" width="" height="" style="display: inline;">
                                    </a>
                                    <div class="user-snippet-details">
                                        <div><a class="semi-bold" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a> started following you                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                        <?php $user = DB::table('users')->where('id', $noti->subject_id)->first(); ?>

                        <div class="res-review-header clearfix">
                            <div class="grid_5 column alpha" style="width:600px;">
                                <div class="user-snippet">
                                    <a class="left user-snippet-image" href="{{Config::get('url.home')}}{{$user->username}}">
                                        <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" width="" height="" style="display: inline;">
                                    </a>
                                    <div class="user-snippet-details">
                                        <div><a class="semi-bold" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a> liked your                                               
                                            <b><a class="semi-bold" href="{{Config::get('url.home')}}reviews/{{$noti->object_id}}"> review </a></b> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif

                        @endif



                    </li>


                    @endforeach
                </ul>
            </section>
        </div>
    </div>
</div>










@stop