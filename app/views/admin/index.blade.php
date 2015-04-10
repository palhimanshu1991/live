@section('meta')
<title>About Berdict</title>
@stop

@section('container')

<div class="container wrapper">    
<h1>Users: {{$userCount}}</h1>

<div class="bs-example" data-example-id="striped-table">
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $users->links(); ?>
        </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>UserName</th>
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
          <td>{{$user->usr_fname.' '.$user->usr_lname}}</td>
          <td><a href="http://www.berdict.com/{{$user->username}}">{{$user->username}}</a></td>
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