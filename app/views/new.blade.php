@extends('master')

@section('meta')
<title>Berdict - short movie reviews from your friends and critics.</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />
@stop


@section('container')

<style>
    .bs-docs-nav {
        text-shadow: none;
        background-color: #FFF;
        border-color: #DDD;
        box-shadow: none;
    }
    .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {
        color: #fff;
        background-color: transparent;
    }
    bs-docs-nav .navbar-nav > li > a:hover {
        color: #333;
        background-color: #efefef;
    }
    .bs-docs-nav .navbar-nav > li > a:hover {
        color: #333;
        background-color: #efefef;
    }
	.bs-footer {
		margin-top: 0px;
	}
    .form-control {
        display: block;
        width: 100%;
        height: 46px;
        padding: 6px 12px;
        font-size: 14px;
        font-family: 'Open Sans';
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 0px;
    }
	.dark-img{
		-webkit-transition: all 0.2s linear;
		-moz-transition: all 0.2s linear;
		-ms-transition: all 0.2s linear;
		-o-transition: all 0.2s linear;
		transition: all 0.2s linear;
		opacity: 0.4;	
	}
	.dark-img:hover {
		opacity: 1;	
	}	
</style>



<?php $random = DB::table('film')->take('24')->orderBy('fl_release_date', 'desc')->get(); ?>
<div style="background:#ddd;height:332px;width:100%;">
	<div class="col-md-12 pad0" style="font-weight: 600;font-size: 30px;padding-top: 0px;width:99.9%;">
	
	<?php $i = 0; ?>
	@foreach($random as $random)
	<?php $i++; ?>
	<?php if($i<13) {$placement ='bottom';} elseif($i>12) {$placement ='top';} ?>
	<a href="{{Config::get('url.home')}}movie/{{$random->fl_id}}/{{Common::cleanUrl($random->fl_name)}}">
		<div style="background:#000;" class="col-md-1 pad0" rel="popover" data-original-title="{{$random->fl_name}} ({{$random->fl_year}})" data-container="body" data-toggle="popover" data-placement="{{$placement}}" data-trigger="hover" data-content="{{$random->fl_outline}}" title="">
			<img class="lazy img-responsive dark-img" src="{{Config::get('url.home')}}public/berdict/img/default_poster.jpg" data-original="{{Config::get('url.web')}}public/uploads/movie/{{$random->fl_year}}/{{$random->fl_image}}" alt="" style="display: inline;height:166px;width:112px;">
		</div>
	</a>
	@endforeach

	</div>
</div>

<div  style="background:#fff;height:300px;">
	<div class="container"   style="text-align:center;">
		<div class="col-md-8 col-md-offset-2" style="font-weight: 600;font-size: 26px;padding-top: 20px;margin-bottom:30px;">
			Berdict is the easiest way to read movie reviews from your friends and critics +.
		</div>
		<div class="col-md-12 pad0" style="font-weight: 600;font-size: 24px;padding-top: 20px;">
		<div class="col-md-4 pad0" style="background:#e74c3c;height:150px;color:#fff;padding-top:10px;">
		<div>FAST</div>
		<div style="font-size:16px;padding:10px 10px;">Short movie reviews of 400 characters, which helps you to read more opinions in less time</div>
		</div>
		<div class="col-md-4 pad0" style="background:#e67e22;height:150px;color:#fff;padding-top:10px;">
		<div>SOCIAL</div>
		<div style="font-size:16px;padding:10px 10px;">Read the opinion of your friends, see their favourite movies, their ratings and much more</div>		
		</div>
		<div class="col-md-4 pad0" style="background:#f39c12;height:150px;color:#fff;padding-top:10px;">
		<div>FUN</div>
		<div style="font-size:16px;padding:10px 10px;">Expressive ratings, showcase your favourites, discover new movies and much more </div>		
		</div>	
		</div>		
	</div>
</div>



<div class="container"  style="">
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-md-9">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
                    <form action="{{Config::get('url.home')}}login" method="POST" class="ajax">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                {{ Form::text('username', '', array('class' => 'form-control' , 'id' => 'username', 'placeholder' => 'username or email')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                {{ Form::password('password', array('class' => 'form-control' , 'id' => 'password', 'placeholder' => 'password')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" style="font-size:13px;">
                                <input type="checkbox" id="remember" value="remember" name="remember" checked="checked"></input>
                                Keep me logged in
                            </div>
                        </div>

                        {{ Form::submit('Login', array('class' => 'btn btn-primary btn-lg btn-block', 'id' => 'review_submit')) }}

                        {{ Form::close() }} 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>






@stop

@section('extra')


@stop
