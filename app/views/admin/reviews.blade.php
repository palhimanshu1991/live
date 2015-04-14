@section('meta')
<title>About Berdict</title>
@stop

@section('container')

<div class="container wrapper">    
<h1>Users: <b>{{$userCount}}</b></h1>
<h1>Reviews: <b>{{$reviewCount}}</b></h1>

<div class="bs-example" data-example-id="striped-table">
        <div class="search-pagination-top bb" style="margin-top:10px;">
            <?php echo $reviews->links(); ?>
        </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
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
            <?php $likes  =  DB::table('review_likes')->where('review_id', $review->fr_id)->count(); ?>
            <?php $comments =  DB::table('review_comments')->where('rc_review_id', $review->fr_id)->count(); ?>                                   
        <tr>
          <th scope="row">{{$review->fr_id}}</th>
          <td><a target="_blank" href="{{Config::get('url.home')}}{{$review->fr_usr_id}}">{{$review->fr_usr_id}}</a></td>
          <td>{{$review->fr_vote}} - {{$review->fr_review}}</td>
          <td>{{$likes}}</td>
          <td>{{$comments}}</td>
          <td>{{$review->fr_views}}</td>
          <td><a  href="{{Config::get('url.home')}}admin/review/delete/{{$review->fr_id}}"><i class="glyphicon glyphicon-trash"></i></a></td>
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