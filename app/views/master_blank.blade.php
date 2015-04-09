<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        @yield('meta')
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/bootstrap/css/bootstrap.min2.css">
        <link rel="stylesheet" type="text/css" href="{{Config::get('url.home')}}public/bootstrap/css/docs.css">
        <link rel="icon" href="{{ Config::get('url.home')}}public/favicon.png" sizes="32x32">

        <style>
            @import url(//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700);

            body {
                font-family:'Open Sans', sans-serif;
                text-shadow: none;
            }


            label.form_error{
                color: #fe2020;
                width: 100%;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                background: pink;
                padding: 3px 5px;
            }
        </style>

        @if(Config::get('url.home')=='http://localhost/lara1.1/')
        <script type="text/javascript">
            FB_APP_ID = "292311107459306";
            HOST = "http://localhost/lara1.1/";
        </script>
        @else 
        <script type="text/javascript">
            FB_APP_ID = "437161969726572";
            HOST = "http://www.berdict.com/";
        </script>
        @endif
    </head>

    <body class="bs-docs-home">


        <!-- Docs master nav -->






        @yield('container')












        <!-- JS and analytics only. -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="{{Config::get('url.home')}}public/bootstrap/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="{{ Config::get('url.home')}}public/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="{{ Config::get('url.home')}}public/berdict/js/wall.js"></script>
        <script type="text/javascript" src="{{ Config::get('url.home')}}public/berdict/js/aamainuwenceur236rn239r.js"></script>

        <script type="text/javascript" src="{{ Config::get('url.home')}}public/berdict/js/aawifuwenceur236rn239r.js"></script>
        <script type="text/javascript" src="{{Config::get('url.home')}}public/berdict/js/jquery.validate.js"></script>

        <script>		
		$('#invite-submit').on('click', function(e){
			$(this).html('Submitting...');
			var email = $('#invite-email').val();
			
			var check = validateEmail(email);
			
			if(check){
				
				$.ajax({
					type: "GET",
					url: HOST + "invite/add",
					data: {email: email},
					success: function(html)
					{
						$('#invite-submit').html('Submitted');
					},
					error: function(html)
					{
						$('#invite-submit').html('Submitted');
					}			
				});		
			
			} else {

				alert('Please enter a correct email');	
				$('#invite-submit').html('Request Invite');
			}
			
		});		
		
		function validateEmail(email) { 
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		} 		
       </script>		

        <!-- Analytics -------->
        @if(Config::get('url.home')=='http://localhost/lara1.1/')

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
        @endif
        <!================================================== -->

    </body>
</html>
