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
      margin: 15px 0px;
      border: 0px solid #ddd;
    }    
label.btn.btn-primary.btn-lg.btn-block {
  background: #bbb !important;
  padding: 40px 40px;
  color: #000 !important;
  font-weight: 800;
  font-size: 18px;
}
label.btn.btn-primary.btn-lg.btn-block.active {
  background: #999 !important;
}    
span.badge {
  min-width: 24px !important;
  padding: 7px;
  border-radius: 30px;
  font-size: 15px;
  background: #666;
  opacity: 0.1;
  position: absolute !important;
  right: 10px;
  top: 10px !important;
}
.active .badge {
  background: #2ecc71;
  border: 1px solid #27ae60 !important;
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
                <div class="col-md-3 col-sm-6 col-xs-6 genre-container" data-toggle="buttons">
                  <label genre-id="{{$genre->fc_id}}" genre-name="{{$genre->fc_name}}" class="btn btn-primary genre-block btn-lg btn-block">
                    <input type="checkbox" autocomplete="off"> {{$genre->fc_name}} 
                     <span class="badge"><i class="glyphicon glyphicon-ok"></i></span>
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