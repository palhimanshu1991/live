
<!doctype html>
<html lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>

        <meta charset="UTF-8">
        @yield('meta')
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="google-site-verification" content="393mobZWpfV89bICt1ZAa8wYXUQP-cblddvXnJyIQh8" />
        <link rel="icon" href="{{ Config::get('url.home')}}public/favicon.png" sizes="32x32">
        <link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/bootstrap/css/docs.css">
        <link rel="stylesheet" type="text/css" href="{{ Config::get('url.home')}}public/rate/rateit.css">
		<link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/bootstrap/css/ionicons.css">
        <link href='http://fonts.googleapis.com/css?family=Oxygen:700,400,300' rel='stylesheet' type='text/css'>

        <style>

            body {
                font-family:'Oxygen', sans-serif;
                text-shadow: none;
            }
            .pagination {
                list-style: none;
                margin: 0px 0;
            }
            .pagination ul{
                padding:0px;
            }
            .pagination li >a {
            }				
            .pagination li {
                list-style: none;
                float:left;
                background:#fff;
                padding: 10px 13px;
                border-right:1px solid #efefef;
                border-bottom:1px solid #efefef;
                border-top:1px solid #efefef;			
            }			

        </style>

        @if(Config::get('url.home')=='http://localhost/live/')
        <script type="text/javascript">
            FB_APP_ID = "292311107459306";
            HOST = "http://localhost/live/";
        </script>
        @else 
        <script type="text/javascript">
            FB_APP_ID = "437161969726572";
            HOST = "http://www.berdict.com/";
        </script>
        @endif


        @if(Auth::check())
        <script type="text/javascript">
            USER = "{{Auth::user()->id}}";
        </script>        
        @endif

    </head>


    <body class="bs-docs-home">


        <!-- Header -->
        <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{Config::get('url.home')}}" class="navbar-brand"><img width="100" src="{{Config::get('url.home')}}public/berdict/img/p_berdict_s.png"/></a>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav form-group example example-countries" style="margin-left: 45px;">
                        <div class="col-md-12" style="">
                            <form id="navbar-form" method="POST" action="{{Config::get('url.home')}}search">
                                <span id="loading-indicator" class="col-md-1" style="color: #999;
                                      padding-top: 11px;
                                      background: #efefef;
                                      margin-top: 5px;
                                      height: 40px;width:30px;"><span class="glyphicon glyphicon-search"></span></span>

                                <input id="typehead-search" value="" class="typeahead tt-query col-md-11" type="text" placeholder="search movies" autocomplete="off" spellcheck="false" dir="auto" style="width:430px;height:40px;margin-top:5px">
                            </form>
                        </div>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                        <?php $base = new BaseController; ?>
                        <li class="dropdown">
                            <a style="border-left:1px solid #efefef;" id="drop4" role="button" data-toggle="dropdown" href="#">
                                <span style="" class=""><div class="" id="noti-count"><span class="glyphicon glyphicon-bullhorn"></span> @if($base->notCount()>0) <span class=" noti-bubble  ">{{ $base->notCount()}}</span>@endif</div> </span>
                            </a>

                            <ul style="font-size:13px;min-width: 350px" id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                <li role="presentation" style="border-bottom:1px solid #e5e5e5;">
                                    <div class="" style="">
                                        <div style="text-align:right;padding: 5px 10px;">
                                            <a id="noti-read-all" href="#">Clear All</a>
                                        </div>
                                    </div>
                                </li>

                                @if($base->noti()==null)
                                <li data-id="126"  role="presentation">
                                    <div class="noti-parent" style="">
                                        <a role="menuitem" tabindex="-1" >
                                            <div class="noti-div">
                                                No New Notification
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @endif

                                @foreach ($base->noti() as $noti)
                                <?php $user = DB::table('users')->where('id', $noti->subject_id)->first(); ?>
                                @if($noti->type=="follow")
                                <li data-id="{{$noti->notification_id}}" id="noti_read" class="noti_read" data-url="{{Config::get('url.home')}}{{$user->username}}" role="presentation">
                                    <div class="noti-parent" style="">
                                        <a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}{{$user->username}}">
                                            <div class="noti-div">
                                                <span style="color:#fe2020;font-size: 14px;margin-right:5px" class="glyphicon glyphicon-plus-sign"></span>
                                                <medium>{{$user->usr_fname.' '.$user->usr_lname}}</medium> started following you
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @elseif($noti->type=="liked")
                                <?php $film = DB::table('film_review')->where('fr_id', $noti->object_id)->join('film', 'film.fl_id', '=', 'film_review.fr_fl_id')->first(); ?>
                                <li data-id="{{$noti->notification_id}}" id="noti_read" class="noti_read" data-url="{{Config::get('url.home')}}reviews/{{$noti->object_id}}" role="presentation">
                                    <div class="noti-parent" style="">
                                        <a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}reviews/{{$noti->object_id}}">
                                            <div class="noti-div">
                                                <span style="color:#27ae60;font-size: 14px;margin-right:8px;float:left;min-height: 20px;" class="glyphicon glyphicon-thumbs-up"></span>
                                                <m>{{$user->usr_fname.' '.$user->usr_lname}}</m> agreed with your review for <m>"{{$film->fl_name}}"</m>
                                            </div>
                                        </a>
                                    </div>
                                </li>                 
                                @elseif($noti->type=="reply")
                                <?php $film = DB::table('film_review')->where('fr_id', $noti->object_id)->join('film', 'film.fl_id', '=', 'film_review.fr_fl_id')->first(); ?>
                                <li data-id="{{$noti->notification_id}}" id="noti_read" class="noti_read" data-url="{{Config::get('url.home')}}reviews/{{$noti->object_id}}" role="presentation">
                                    <div class="noti-parent" style="">
                                        <a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}reviews/{{$noti->object_id}}">
                                            <div class="noti-div">
                                                <span style="color:#27ae60;font-size: 14px;margin-right:8px;float:left;min-height: 20px;" class="glyphicon glyphicon-thumbs-up"></span>
                                                <m>{{$user->usr_fname.' '.$user->usr_lname}}</m> replied to your review for <m>"{{$film->fl_name}}"</m>
                                            </div>
                                        </a>
                                    </div>
                                </li>                 
                                @endif


                                @endforeach

                                <!--<li role="presentation" style="text-align:center;border-top:1px solid #e5e5e5;">
                                    <div class="noti-parent" style="">
                                        <a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}notifications">
                                            <div class="noti-div">
                                                See All Notifications
                                            </div>
                                        </a>
                                    </div>
                                </li>--->
                            </ul>
                        </li>


                        <li class="dropdown" >

                            <a id="drop4"  role="button"  href="{{Config::get('url.home')}}{{Auth::user()->username}}"> {{Auth::user()->username}} <b style="border-top-color: #999;border-bottom-color: #999;" class="caret"></b></a>
                            <ul style="min-width: 200px;" id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}edit"> Edit Profile </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}watchlist"> My Watchlist </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}favourites"> My Favourites</a></li>
                                <li role="presentation" style="margin: 0px;" class="divider"></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}invite"> Invite Codes </a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}contact"> Feedback  </a></li>
                                <li role="presentation" style="margin: 0px;" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{Config::get('url.home')}}logout"> Logout </a></li>
                            </ul>
                        </li>

                        <li rel="tooltip" data-placement="bottom" title="" data-original-title="Go to profile" class="dropdown" >
                            <a id="drop4" style="padding:0px;"  role="button"  href="{{Config::get('url.home')}}{{Auth::user()->username}}"> 
                                @if(Auth::user()->usr_image)
                                <img style="width:50px;height:50px" src="{{Config::get('url.web')}}public/user_uploads/1000/{{Auth::user()->id}}/{{Auth::user()->usr_image}}"> 
                                @else 
                                <img style="width:50px;height:50px" src="{{Config::get('url.home')}}public/berdict/img/default.jpg"> 
                                @endif
                            </a>
                        </li>
                        @endif
						
						@if(!Auth::check())
						<li>
							<a style="font-weight:600;border-left:1px solid #efefef;" href="" data-toggle="modal"  data-target="#inviteModal">Request Invite</a>
						</li>						
						<li>
							<a style="font-weight:600;border-left:1px solid #efefef;" href="" data-toggle="modal"  data-target="#myModal">Login</a>
						</li>
						@endif

                    </ul>
                </nav>
            </div>
        </header>




        @yield('container')


        <footer class="bs-footer" role="contentinfo">
            <div class="container">
                <div class="bs-social">
                    <ul class="bs-social-buttons">

                    </ul>
                </div>


                <ul class="footer-links">
                    <li><a href="http://www.berdict.com/">Home</a></li>
                    <li class="muted">·</li>
                    <li><a href="http://www.berdict.com/privacy">Privacy</a></li>
                    <li class="muted">·</li>
                    <li><a href="http://www.berdict.com/terms">Terms</a></li>
                    <li class="muted">·</li>
                    <li><a href="http://www.berdict.com/contact">Contact</a></li>
                    <li class="muted">·</li>
                    <li><a href="http://www.berdict.com/jobs">Jobs</a></li>
                    <li class="muted">·</li>
                    <li><a href="http://www.berdict.com/contact">Feedback</a></li>
                </ul>
            </div>
        </footer>

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
                    <form action="http://www.berdict.com/login" method="POST" class="ajax">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input class="form-control" id="username" placeholder="username or email" name="username" type="text" value="">                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control" id="password" placeholder="password" name="password" type="password" value="">                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group" style="font-size:13px;">
                                <input type="checkbox" id="remember" value="remember" name="remember" checked="checked"></input>
                                Keep me logged in
                            </div>
                        </div>

                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
                        </form> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	

	

</div>

		
		
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal" id="people" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content col-md-offset-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content col-md-9 col-md-offset-1">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Request Invite</h4>
					</div>
                    <div class="modal-body">
							<div class="form-group">
								<div class="input-group" id="invite-message">
									Enter your email to request an invitation.
								</div>
							</div>					
							<div class="form-group invite-body">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input class="form-control" id="invite-email" placeholder="Your email" name="email" type="email" value=""> 
								</div>
							</div>
							<a href="#" class="btn btn-primary btn-lg btn-block" id="invite-submit" >Request Invite</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->		
		

        <!-- JS and analytics only. -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script type="text/javascript" src="{{Config::get('url.home')}}public/bootstrap/js/jquery-1.10.2.min.js"></script>





        <script type="text/javascript" src="{{Config::get('url.home')}}public/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="{{Config::get('url.home')}}public/bootstrap/js/main.js"></script>
        <script type="text/javascript" src="{{Config::get('url.home')}}public/berdict/js/jquery.lazyload.js"></script>

        <script src="{{Config::get('url.home')}}public/rate/jquery.rateit.js"></script>
        <script src="{{Config::get('url.home')}}public/bootstrap/js/bootstrap-dialog.min.js"></script>


        <script src="{{ Config::get('url.home')}}public/bootstrap/js/elastic.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            //jQuery.noConflict();
            jQuery(document).ready(function() {
                jQuery('textarea').elastic();
                jQuery('textarea').trigger('update');
            });
            // ]]>
            var fetch = $("#myLatest").attr("data-fetch");

            $("#myLatest").one("click", function() {
                $('#myLatestLoading').show();
                $('#myLatest').attr('data-fetch', 'yes');
                $('#myLatest').removeAttr('id');
                $.ajax({
                    type: "GET",
                    url: HOST + "feed/global",
                    //cache: false,
                    success: function(data)
                    {
                        $('#latest').append(data);
                        $('#myLatestLoading').hide();
                        $("#latest img.lazy").lazyload({
                            effect: "fadeIn"
                        }).removeClass("lazy");
                        $(function() {
                            $("[rel='tooltip']").tooltip();
                        });
                        $(function() {
                            $("[rel='popover']").popover();
                        });
                    }
                });
            });

            $(document).ready(function() {
                $('#navbar-form').on('submit', function(e) {
                    e.preventDefault();
                    var term = $('#typehead-search').val();
                    window.location.href = HOST + 'search/' + term;
                });
            });

            if (fetch == 'yes') {
                $('#myLatest').click(function(e) {
                    e.preventDefault();
                    //$(this).tab('show');			  
                    if (fetch == 'no') {

                        $('#myLatest').attr('data-fetch', 'yes');
                        $('#myLatest').removeAttr('id');


                        $.ajax({
                            type: "GET",
                            url: HOST + "latest/feed",
                            //cache: false,
                            success: function(data)
                            {
                                $('#latest').prepend(data);
                            }
                        });
                    }
                });
            }




            /**
             * Alert window
             * 
             * @param {type} message
             * @param {type} callback
             * @returns {undefined}
             */
            BootstrapDialog.alert = function(message, callback) {
                new BootstrapDialog({
                    message: message,
                    data: {
                        'callback': callback
                    },
                    closable: true,
                    buttons: [{
                            label: 'OK',
                            action: function(dialog) {
                                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                                dialog.close();
                            }
                        }]
                }).open();
            };

            /**
             * Confirm window
             * 
             * @param {type} message
             * @param {type} callback
             * @returns {undefined}
             */
            BootstrapDialog.confirm = function(message, callback) {
                new BootstrapDialog({
                    title: 'Confirmation',
                    message: message,
                    closable: true,
                    data: {
                        'callback': callback
                    },
                    buttons: [{
                            label: 'Cancel',
                            action: function(dialog) {
                                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                                dialog.close();
                            }
                        }, {
                            label: 'OK',
                            cssClass: 'btn-primary',
                            action: function(dialog) {
                                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                                dialog.close();
                            }
                        }]
                }).open();
            };




            $('.delete').click(function() {
                var review = $(this).attr("review-id");
                BootstrapDialog.confirm('Are you sure you want to delete this review?', function(result) {
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: HOST + "review/delete",
                            data: {review: review},
                            dataType: 'text',
                            success: function(data)
                            {
                                $("#data-review-" + review).fadeOut('800');
                            }
                        });
                        return false;
                    } else {
                    }
                });
            });

        </script>


        <script type="text/javascript">
		
            $(document).ready(function() {
                $('#navbar-form').on('submit', function(e) {
                    e.preventDefault();
                    var term = $('#typehead-search').val();
                    window.location.href = HOST + 'search/' + term;
                });
            });
		
            $(document).ready(function() {
                $(function() {
                    $("[rel='tooltip']").tooltip();
                });
                $(function() {
                    $("[rel='popover']").popover();
                });
            });
            $('#people').on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
            });

            $(function() {
                $("img.lazy").lazyload({
                    effect: "fadeIn",
                    threshold: 200
                });
            });

            //Edit the counter/limiter value as your wish
            var count = "400";
            function limiter() {
                var tex = document.myform.update.value;
                var len = tex.length;
                if (len > count) {
                    tex = tex.substring(0, count);
                    document.myform.update.value = tex;
                    return false;
                }
                document.myform.limit.value = count - len;
            }


        </script>

        <!-- Analytics -------->
        @if(Config::get('url.home')=='http://localhost/live/')

        @else

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-41275245-1', 'berdict.com');
            ga('send', 'pageview');
        </script>

        <!-- start Mixpanel --><script type="text/javascript">(function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
        for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
        mixpanel.init("9d2906c336e45968ae929473f9065809");</script><!-- end Mixpanel -->

        @if(Auth::check())
        <script type="text/javascript">
            mixpanel.identify({{Auth::user()->id}});
            mixpanel.people.set({
                "$name": "{{Auth::user()->usr_fname}}",                    // feel free to define your own properties                
                "$email": "{{Auth::user()->usr_email}}",    // only special properties need the $
                "$last_seen": new Date()         // properties can be dates...
            });
        </script>
        @endif
        @endif

        

        @yield('extra')


    </body>
</html>
