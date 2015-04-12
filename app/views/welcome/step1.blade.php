@section('meta')
<title>Welcome - Berdict</title>
<style type="text/css">
header.navbar.navbar-inverse.navbar-fixed-top.bs-docs-nav {
  opacity: 0.2;
} 
footer.bs-footer {
  opacity: 0.2;
}   
</style>
@stop

@section('container')
<style type="text/css">
    .genre-container {
      margin: 0px 0px;
      border: 0px solid #ddd;
    }    
label.btn.btn-primary.btn-lg.btn-block {
  font-weight: 800;
  font-size: 13px;
  color: rgba(0,0,0,0.7) !important;
  background: #fff !important;
  border-radius: 2px;
  border: 1px solid #f0f0f0;
  padding: 3px 10px;
  margin-right: 8px;
  margin-bottom: 8px;
  line-height: 22px;
  display: inline-block;
}
label.btn.btn-primary.btn-lg.btn-block.active {
  background: #ddd !important;
}    
span.badge {
  min-width: 13px !important;
  padding: 6px;
  border-radius: 30px;
  font-size: 15px;
  background: #666;
  opacity: 0.8;
  position: absolute !important;
  right: 7px;
  top: 7px !important;
}
.active .badge {
  background: #2ecc71;
  opacity: 1;
}
button.btn.btn-lg.btn-primary.disabled {
  border-radius: 30px;
  padding: 15px 30px;
  opacity: 0.4;
}
button.btn.btn-lg.btn-primary {
  border-radius: 30px;
  padding: 15px 30px;
  opacity: 1;
}
span.badge-rating {
  background: rgb(255, 255, 255);
  color: rgb(51, 51, 51);
  text-align: center;
  padding: 7px;
  min-width: 40px;
  position: absolute;
  top: 1px;
  left: 16px;
  font-size: 20px;
  font-weight: 700;
  letter-spacing: 0.02em;
}
label.btn.btn-primary.poster-checkbox.btn-lg.btn-block {
  background: none !important;
  padding: 0px;
  margin: 0;
  border: none;
  text-shadow: none;
  box-shadow: none;
  border-bottom: none !important;  
}
</style>
<div class="container">
    <div class="row">
        <div class="genre-step">
            <div class="col-md-12 ptop2 pbot2" style="text-align:center;">
                <h1><b>What kind of movies do you like? </b></h1>
                <h3><b>Choose 3</b> of your favourite genres </h3>
                <h5>This will help us in suggesting you right movies <br/></h5>
                <button type="button" class="btn btn-lg btn-primary continue-button disabled">Continue</button>
            </div>
            <div class="genre-card-container">
                @foreach($genre as $genre)              
                <div class="col-md-2 col-sm-1 col-xs-1 genre-container" data-toggle="buttons">
                  <label genre-id="{{$genre->fc_id}}" genre-name="{{$genre->fc_name}}" class="btn btn-primary genre-block btn-lg btn-block">
                    <input type="checkbox" autocomplete="off"> {{$genre->fc_name}} 
                  </label>
                </div>              
                @endforeach          
            </div>              
        </div>     
        <!---- 
        <div class="col-md-12">

            <div class="col-md-3 genre-container" style="border:1px solid #ccc;">{{$genre->fc_name}}</div>                      

        </div>---->
    </div>
</div>

<div>
<div class="">
    <div class="container wrapper pbot2 mbot2">
        <div class="row">
            @foreach($movies as $movie)
            <div class="col-md-2 pbot2" data-toggle="buttons">
                <label genre-id="1" genre-name="Action" class="btn btn-primary poster-checkbox btn-lg btn-block">
                 <img style="height:215px;border:1px solid #ddd;" class="img-responsive lazy" rel="popover" data-original-title="{{$movie->fl_name}} ({{$movie->fl_year}})" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="{{$movie->fl_outline}}" src="{{ Config::get('url.web')}}public/uploads/movie/{{$movie->fl_year}}/{{$movie->fl_image}}">
                    <span class="badge-rating hidden">{{$movie->fl_rating}}</span>
                    <input type="checkbox" autocomplete="off">  
                    <span class="badge"><i class="glyphicon glyphicon-ok"></i></span>
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>



@stop

@section('extra')

<script type="text/javascript">

    $( ".genre-container" ).click(function() {
        
        setTimeout(function(){
            var count   =   $('.active').length;
            
            if(count>2) {
                $('.continue-button').removeClass('disabled');
            } else {
                $('.continue-button').addClass('disabled');
            }        
            
            $('.genre-block.active').each( function(i) {
                console.log($(this).attr('genre-name'));
            });


        },100);
    });
        

    $( ".continue-button" ).click(function() {
        $('.genre-step').fadeOut('500');
    });        



</script>

@stop