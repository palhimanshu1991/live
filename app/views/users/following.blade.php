@section('meta')
<title>{{$user->usr_fname.' '.$user->usr_lname}} - Berdict</title>
@stop


@section('container')



<div class="container">
    <div class="row-fluid pbot ptop2" >
        <div class="movie-title" >

        </div>
    </div>
    <div class="row-fluid" >
        <div class="col-sm-4 pad0" style="width:240px;">
            <div class="profile-card-top" align="center">
                <div class="profile-card-image">
                    @if($user->usr_image)
                    <img class="img-responsive lazy" style="width:200px;height:200px;" src="{{Config::get('url.web')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                    @else 
                    <img class="img-responsive lazy" style="width:200px;height:200px;" src="{{Config::get('url.web')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}"  />
                    @endif
                </div>  
                <div class="profile-card-name" style="">
                    {{$user->usr_fname.' '.$user->usr_lname}}
                </div>  
                <div class="profile-card-bio" style="">
                    {{$user->usr_bio}}
                </div>  
            </div>
            <div align="center" class="profile-card-bottom" style="">
                <!-- Favourite Button--->
                <div style="padding:5px 0px 0px 0px;font-size: 13px;">
                    <!-- follow button -->
                    @if($follow==3)
                    <a href="{{Config::get('url.home')}}edit" class="ajax_follow">
                        <button class="btn btn-main">Edit Profile</button>
                    </a>	                 
                    @elseif($follow==1)
                    <button style="display: none;"  id="ajax_add_follow" data-id="{{$user->id}}" class="follow btn">Follow</button>
                    <button id="ajax_del_follow" data-id="{{$user->id}}" class="btn following">Following</button>

                    @elseif($follow==0)
                    <button id="ajax_add_follow" data-id="{{$user->id}}" class="follow btn">Follow</button>
                    <button style="display: none;" id="ajax_del_follow" data-id="{{$user->id}}" class="btn following">Following</button>
                    @elseif($follow==2)
                    <a href="{{Config::get('url.home')}}login" class="ajax_follow"> Follow </a>					   
                    @endif
                    <!--- button ends --->	
                </div>  
            </div>

            <div class="profile-side" style="margin-top:20px">
                <ul class="pad0" style="list-style: none;color:#555;">
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}">
                            <div class="row-fluid profile-tabs" style=""> Reviews <span class="right"> ({{$reviewCount}}) </span> </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}/followers">
                            <div class="row-fluid profile-tabs" style=""> Followers <span class="right"> ({{$followerCount}}) </span> </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Config::get('url.home')}}{{$user->username}}/following">
                            <div class="row-fluid profile-tabs-active" style=""> Following <span class="right"> ({{$followingCount}}) </span> </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-md-8" style="padding-left: 20px;width: 75%;padding-right:0px;">

            <div class="row-fluid" style="margin-bottom: 0px;"> 
                <div class="col-md-12 pad0" style="border-bottom: 1px solid #ccc">
                    <div class="form-group" style="font-weight:600;font-size: 15px;margin-bottom: 10px;">
                        FOLLOWING
                    </div>	
                </div>
            </div>

            <div class="row-fluid" style="margin-bottom: 0px;margin-top:20px"> 

                <?php $i = 0; ?>
                @foreach ($following as $user)
                <?php
                $i++;

                switch ($i % 2) {
                    case 1:
                        $class = 'follower-left';
                        break;
                    case 0:
                        $class = 'follower-right';
                        break;
                }
                ?>


                <div class="col-md-6 pad0 {{$class}}" style="margin-bottom:10px;">
                    <div class="col-md-12 pad0" style="margin-right:20px"> 
                        <a rel="nofollow" class="left " href="{{Config::get('url.home')}}{{$user->username}}" style="width:90px;height:90px;">
                            <img class="lazy" src="{{Config::get('url.home')}}public/berdict/img/default.jpg" data-original="{{Config::get('url.web')}}public/user_uploads/1000/{{$user->id}}/{{$user->usr_image}}" alt="" style="display: inline;width:80px;height:80px;">
                        </a>
                        <div class="user-snippet-details">
                            <div class="user-snippet-name" >
                                <a style="font-size:14px;" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach


            </div>


        </div>
    </div>
    <div class="clear"></div>
</div>
</div>
</section>
</div>

</div>

</div>

</div>

@stop


@section('extra')
<script src="{{Config::get('url.home')}}public/bootstrap/js/jquery.jcarousel.min.js"></script>
<script src="{{Config::get('url.home')}}public/bootstrap/js/jcarousel.skeleton.js"></script>
@stop