
@section('container')

<div class="container">
    <div class="grid_16 column mbot2 mtop ptop2">
        {{ Form::open(array('route' => 'movie.store','files'=> true)) }}



        {{ Form::label('name', 'Film name:') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('name', 'Film year:') }}
        {{ Form::text('year', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('director', 'Film director:') }}
        {{ Form::text('director', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('writer', 'Film writer:') }}
        {{ Form::text('writer', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('stars', 'Film stars:') }}
        {{ Form::text('stars', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('outline', 'Film outline:') }}
        {{ Form::text('outline', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('story', 'Film story:') }}
        {{ Form::text('story', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('genre', 'Film genre:') }}
        {{ Form::text('genre', '', array('class' => 'form-control')) }}<br/>        
		   		
        {{ Form::label('release', 'Film releasedate:') }}
        {{ Form::text('release', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('rating', 'Film rating:') }}
        {{ Form::text('rating', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('duration', 'Film duration:') }}
        {{ Form::text('duration', '', array('class' => 'form-control')) }}<br/>

        {{ Form::label('country', 'Film country:') }}
        {{ Form::text('country', '', array('class' => 'form-control')) }}<br/><br/>


        {{Form::file('image', array('id' => 'image'))}}<br/><br/>

        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
        {{ Form::close() }}     

    </div>




</div>


@stop