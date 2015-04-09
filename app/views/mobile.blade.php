<!DOCTYPE HTML>
<html>
<head>
<title>Berdict - Micro movie reviews of 400 characters. </title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,700italic,800italic,400,800,700,600,300' rel='stylesheet' type='text/css'>

<link href="{{Config::get('url.home')}}public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{Config::get('url.home')}}public/mobile/new/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{Config::get('url.home')}}public/mobile/new/css/animate.css" rel="stylesheet" type="text/css" media="all" />


<script src="{{Config::get('url.home')}}public/mobile/js/jquery-1.8.0.min.js" type="text/javascript"></script>

<script type="text/javascript" src="{{Config::get('url.home')}}public/mobile/js/move-top.js"></script>

<script type="text/javascript" src="{{Config::get('url.home')}}public/mobile/js/easing.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},800);
			});
		});
	</script>
	<link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/mobile/css/slick.css" />
    <script type="text/javascript" src="{{Config::get('url.home')}}public/mobile/js/slick.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
		    $('.single-item').slick({
		        dots: true,
		        infinite: true,
		        speed: 300,
		        autoplay:true,
		        arrows:false,
		        slidesToShow: 1,
		        slidesToScroll: 1
		     });
       });
	$(document).ready(function() {
			mixpanel.track_links("#download-button", "Download Button");
	});	   
    </script>
</head>

<body>
	<!--- header ---->
	<div id="to-top" class="header-bg">
		<div id="home" class="header">
			<!--- container ---->

			<!--- container --->
			<!----- banner ----->
			<div class="banner">
				<!--- container --->
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="mobile-divise">
								<img src="{{Config::get('url.home')}}public/mobile/new/images/iphone.png">
							</div>
						</div>
						<div class="col-md-6">
							<div class="divise-info">
								<h1>Short movie reviews of <span>400 characters</span></h1>
								<p> Berdict is a beautiful, fast and fun new way to <span>share your opinion on movies with friends and people that matter. </span></p><br/>
								<div class="">
									<a id="download-button" target="_blank" href="https://itunes.apple.com/app/berdict/id911244049?mt=8"><img style="border-radius:4px;" width="170px" src="http://www.berdict.com/public/mobile/images/app_store.png"/></a>
								</div>
								<p>Coming soon on Android </p>
								
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>	
				<!--- container --->
			</div>
			<!----- banner ----->	
		</div>
	</div>
<!--- header ---->
<div class="clearfix"> </div>
	<!--- content --->

	</div>
	<!--- our-team --->

	<!--- our-team --->
	<!--- latest-posts --->

	<!--- latest-posts --->
	<!--- footer ---->
	<div class="footer">
		<!--- container --->
		<div class="container">
				<div class="footer-left">
					<h2><a href="#"></a></h2>
				</div>
				<div class="footer-right">
					<ul>
						<li><a href="http://www.berdict.com/login">Login</a></li>
						<li><a href=""></a></li>
						<li><a href="http://www.berdict.com/contact">Contact</a></li>
						<li><a href=""></a></li>
						<li><a href="http://www.twitter.com/berdict">Twitter</a></li>
						<li><a href=""></a></li>
						<li><a href="http://www.facebook.com/berdict">Facebook</a></li>						
					</ul>				
				</div>
				
				<div class="clearfix"> </div>
		</div>
		<!--- container --->
	</div>
	<!--- footer ---->
	
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
		
	<!-- start Mixpanel --><script type="text/javascript">(function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
	for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;a.src="//cdn.mxpnl.com/libs/mixpanel-2.2.min.js";e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
	mixpanel.init("6f5eadc19459cac7ecab004685a927e3");	
	mixpanel.track("Homepage");
	</script><!-- end Mixpanel -->		
  </body>
</html>

    	
    	
            