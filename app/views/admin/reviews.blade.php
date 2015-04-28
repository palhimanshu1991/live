@section('meta')
<title>About Berdict</title>
@stop

@section('container')

<div class="container wrapper" style="width:1100px;">    
<h1>Users: <b>{{$userCount}}</b></h1>
<h1>Reviews: <b>{{$reviewCount}}</b></h1>

<div class="bs-example" data-example-id="striped-table">
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $reviews->links(); ?>
        </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>User</th>
          <th>Review</th>
          <th>Likes</th>
          <th>Reply</th>          
          <th>Views</th>  
          <th>Delete</th>            
        </tr>
      </thead>
      <tbody>

        @foreach($reviews as $review)
            <?php $likes    =  DB::table('review_likes')->where('review_id', $review->fr_id)->count(); ?>
            <?php $user     =  DB::table('users')->where('id', $review->fr_usr_id)->first(); ?>
            <?php $comments =  DB::table('review_comments')->where('rc_review_id', $review->fr_id)->count(); ?>                                   
        <tr>
          <th scope="row"><a target="_blank" href="{{Config::get('url.home')}}{{$user->username}}">{{$user->usr_fname}}</a></th>
          <td>
            {{$review->fr_vote}} - {{$review->fr_review}} <br/>
            <a href="{{Config::get('url.home')}}admin/review/like/{{$review->fr_id}}"> <i class="ion-heart"></i> Give Like</a> - 
            <a href="{{Config::get('url.home')}}admin/review/views/{{$review->fr_id}}"> <i class="ion-stats-bars"></i> Boost Views</a> -
            <a href="{{Config::get('url.home')}}admin/review/edit/{{$review->fr_id}}"> <i class="ion-edit"></i> Edit Review</a> 
          </td>
          <td>{{$likes}} </td>
          <td>{{$comments}}</td>
          <td>{{$review->fr_views}}</td>
          <td><a href="{{Config::get('url.home')}}admin/review/delete/{{$review->fr_id}}"><i class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
        @endforeach

      </tbody>
    </table>
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $reviews->links(); ?>
        </div>    
  </div>

</div>



@stop