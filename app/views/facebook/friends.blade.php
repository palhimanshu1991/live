@section('meta')
<title>Facebook friends on Berdict</title>
@stop


@section('container')



<div class="res-imagery-default imagery item-to-hide-parent">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding:0px 0px 20px 20px;	">
        <h2 style="font-weight:500;">We found some of your friends who are already on Berdict.</h2>
        Follow your friends and see their movie reviews.
    </section>
</div>





<div class="container" id="mainframe">
    <div class="grid_left column search-start" style="min-height: 600px;">
        <div class="search_results mbot mtop0">
            <section id="search-results-container">
                <div class="">
                    <div class="right" style=" width: 100px;margin-right:0px;">
                        <a id="follow_all" class="ajax_following" style="padding: 5px 0px;width: 100px;">Follow all</a>
                    </div> 
                    <div style="" class="bold_dark mtop2 legt"> <span color="red">{{$friendCount}}</span> friends on Berdict </div>

                    <div class="clear"></div>
                </div>	



                <ul>

                    @foreach ($user as $user)
                    <?php
                    $check = DB::table('user_friends')
                            ->where('friend_user_id', $user->id)
                            ->where('follower_user_id', Auth::user()->id)
                            ->first();
                    ?>

                    <li class="" data-res_id="" style="display: list-item;">
                        <div class="res-reviews-container" style="width:690px;">
                            <div class="zs-following-list">
                                <div class="clearfix mtop0   item-to-hide-parent">
                                    <div class="res-review-header clearfix">
                                        <div class="grid_5 column alpha" style="width:500px;">
                                            <div class="user-snippet">
                                                <a class="left user-snippet-image" href="user.php?u=5">
                                                    <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.home')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" width="50" height="50">
                                                </a>
                                                <div class="user-snippet-details">
                                                    <div>
                                                        <a class="semi-bold" href="{{Config::get('url.home')}}{{$user->username}}">
                                                            {{$user->usr_fname.' '.$user->usr_lname}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="res-review-top-right">
                                            <div class="res-review-top-right-rating">
                                                @if($check) 

                                                <div id="follow{{$user->id}}" style="display:none">
                                                    <a href="" class="ajax_follow_s common-fb" data-id="{{$user->id}}">
                                                        <span class="" style="width:70px;"> Follow </span>
                                                    </a>
                                                </div>

                                                <div id="remove{{$user->id}}">
                                                    <a href="" class="ajax_following_s common-fb" data-id="{{$user->id}}">
                                                        <span class="" style="width:70px;"> UnFollow </span>
                                                    </a>
                                                </div>   

                                                @else 

                                                <div id="follow{{$user->id}}">
                                                    <a href="" class="ajax_follow_s common-fb" data-id="{{$user->id}}">
                                                        <span class="" style="width:70px;"> Follow </span>
                                                    </a>
                                                </div>

                                                <div id="remove{{$user->id}}" style="display:none">
                                                    <a href="" class="ajax_following_s common-fb" data-id="{{$user->id}}">
                                                        <span class="" style="width:70px;"> UnFollow </span>
                                                    </a>
                                                </div>

                                                @endif
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="res-review-top-right-text">
                                                <a href="" class="res-review-date"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border" style="border-top: 1px solid #efefef;"> </div>
                            </div>
                        </div>			


                    </li>

                    @endforeach
                </ul>
            </section></div>
        <div class="clear">&nbsp;</div>
    </div>
    <!--- Right box---->
   

<div class="grid_5 column omega" style="width: 264px;">

    <div class="bold_dark mtop2 legt" style="margin-top:20px;">
       Invite Your Friends <font style="font-size:12px;margin-top:5px;" class="right"></font> 
    </div>



    <div class="zs-load-more-container">
        <div class="notifications-content activity-feed ">
            <ul class="zs-following-list n-content">
                <li>
                    <div class="notification-pics clearfix">

                        <a href='#' style="width:264px" class="btn-big-main" onclick="FacebookInviteFriends();"> Invite Facebook Friends</a>

                        <div class="clear"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

   
    <!-- Right box ends --->

</div>

@stop



@section('extra')
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js">
</script>
<script>
    FB.init({
        appId: FB_APP_ID,
        cookie: true,
        status: true,
        xfbml: true
    });

    function FacebookInviteFriends()
    {
        FB.ui({method: 'apprequests',
            message: 'Short movie reviews from your friends and critics.'});
    }
</script>    
@stop