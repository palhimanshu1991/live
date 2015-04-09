
@section('container')

<div class="container" style="margin-top:15px;">

    <div class="col-lg-4 col-lg-offset-4 m-t-lg">
        {{ Form::open(array('route' => 'reviews.store')) }}


        {{ Form::label('film_id', 'Film id:') }}
        {{ Form::text('film_id', '', array('class' => 'form-control')) }}



        {{ Form::label('user_id', 'User id:') }}
        {{ Form::text('user_id', '', array('class' => 'form-control')) }}



        {{ Form::label('review_text', 'Review text:') }}
        {{ Form::textarea('review_text', '', array('class' => 'form-control')) }}



        {{ Form::label('review_vote', 'Review vote:') }}
        {{ Form::text('review_vote', '', array('class' => 'form-control')) }}


        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

        {{ Form::close() }}
    </div>
</div>


@stop