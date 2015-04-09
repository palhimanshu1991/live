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
   </head>

    <body class="bs-docs-home">



		<div align="center" class="col-md-12">
		  <a href=//www.berdict.com/><img style="width:180px;" src="http://www.berdict.com/public/berdict/img/p_berdict_s.png"/></a></br></br>
		  <p><b>404 Error</b></p>
		  <p>The requested URL was not found.</p> 
		</div>

    </body>
</html>
