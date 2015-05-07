@section('meta')
<title>About Berdict</title>
@stop

@section('container')

<div class="container wrapper ptop2">   
<div class="row">
  <div class="col-md-3">
    <h1>Users: <b>{{$userCount}}</b></h1>    
  </div>
  <div class="col-md-3">
    <h1>Reviews: <b>{{$reviewCount}}</b></h1>    
  </div>
  <div class="col-md-3">
  {{ Form::open(array('url' => 'admin/search', 'method' => 'get')) }}
    {{Form::text('query', '', array('class' => 'form-control','placeholder'=>'Search a user'))}}
  {{ Form::close() }}
  </div>
</div> 

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
          <th>Rate</th>
          <th>Revs</th>
          <th>Wathd</th>
          <th>Walist</th>
          <th>Favs</th>  
          <th>FB</th> 
          <th>Fol</th> 
          <th><i class="glyphicon glyphicon-user"></i></th>         
        </tr>
      </thead>
      <tbody>

        @foreach($users as $user)
        <?php
            $ratings    =  DB::table('rating')->where('rt_usr_id',$user->id)->count(); 
            $reviews    =  DB::table('film_review')->where('fr_usr_id',$user->id)->count();
            $watched    =  DB::table('user_watched')->where('watched_usr_id',$user->id)->count();
            $watchlist  =  DB::table('user_watchlist')->where('uw_usr_id',$user->id)->count();
            $favourite  =  DB::table('user_fav')->where('fav_usr_id',$user->id)->count();
            $FB         =  DB::table('user_facebook')->where('ufb_usr_id',$user->id)->count();
            $followers  =  DB::table('user_friends')->where('friend_user_id',$user->id)->count();

        ?>
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td><a target="_blank" href="http://www.berdict.com/{{$user->username}}">{{$user->usr_fname.' '.$user->usr_lname}}</a></td>
          <td><a href="mailTo:{{$user->usr_email}}">{{$user->usr_email}}</a></td>
          <td>@if($user->usr_fb_link)<a target="_blank"  href="{{$user->usr_fb_link}}"><i class="glyphicon glyphicon-send"></i></a>@endif</td>
          <td>{{$ratings}}</td>
          <td>{{$reviews}}</td>
          <td>{{$watched}}</td>
          <td>{{$watchlist}}</td>
          <td>{{$favourite}}</td>   
          <td>{{$FB}}</td> 
          <td>{{$followers}}</td>
          <td><a rel="tooltip" data-placement="bottom" title="" data-original-title="Give one new follower to this user" href="{{Config::get('url.home')}}random/{{$user->id}}"> <i class="glyphicon glyphicon-plus"></i></a></td>                              
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