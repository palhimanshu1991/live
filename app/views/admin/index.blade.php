@section('meta')
<title>About Berdict</title>
@stop

@section('container')

<div class="container wrapper">    
<h1>Users: <b>{{$userCount}}</b></h1>
<h1>Reviews: <b>{{$reviewCount}}</b></h1>

<div class="bs-example" data-example-id="striped-table">
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $users->links(); ?>
        </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>FB</th>
          <th>Reviews</th>
          <th>Watched</th>
          <th>Watchlist</th>
          <th>Favourite</th>          
        </tr>
      </thead>
      <tbody>

        @foreach($users as $user)
        <?php 
            $reviews    =  DB::table('film_review')->where('fr_usr_id',$user->id)->count();
            $watched    =  DB::table('user_watched')->where('watched_usr_id',$user->id)->count();
            $watchlist  =  DB::table('user_watchlist')->where('uw_usr_id',$user->id)->count();
            $Favourite   =  DB::table('user_fav')->where('fav_usr_id',$user->id)->count();

        ?>
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td><a target="_blank" href="http://www.berdict.com/{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a></td>
          <td><a href="mailTo:{{$user->usr_email}}">{{$user->usr_email}}</a></td>
          <td>@if($user->usr_fb_link)<a target="_blank"  href="{{$user->usr_fb_link}}"><i class="glyphicon glyphicon-send"></i></a>@endif</td>
          <td>{{$reviews}}</td>
          <td>{{$watched}}</td>
          <td>{{$watchlist}}</td>
          <td>{{$Favourite}}</td>          
        </tr>
        @endforeach

      </tbody>
    </table>
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $users->links(); ?>
        </div>    
  </div>

</div>



@stop