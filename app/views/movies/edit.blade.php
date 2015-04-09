






@section('container')


<div class="res-imagery-default imagery item-to-hide-parent">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding: 0px 0px 20px 0px;">
        <a href="{{Config::get('url.home')}}movie/{{ $movie->fl_id}}/{{Common::cleanUrl($movie->fl_name)}}">  <input type="button"  value="Back to Movie" class="btn btn-red left" style="margin-right:10px; margin-top:5px;" /> </a>	
    </section>
</div>
<div class="res-imagery-default imagery item-to-hide-parent" itemscope itemtype="http://schema.org/Movie">
    <section class="res-main res-imagery-tshadow container clearfix pbot" style="padding-top: 20px; padding-bottom: 20px;">
        {{Form::model($movie, array('method' => 'POST','files'=> true))}}

        {{ Form::label('fl_name', 'Film Name:', array('class' => 'grid_8')) }}
        {{ Form::text('fl_name') }}<br/>
        
        {{ Form::label('fl_year', 'Film year:', array('class' => 'grid_8')) }}
        {{ Form::text('fl_year') }}<br/>

        {{ Form::label('fl_dir_ar_id', 'Film director:', array('class' => '')) }}
        {{ Form::text('fl_dir_ar_id') }}    <br/>
        
        {{ Form::label('fl_stars', 'Film stars:', array('class' => '')) }}
        {{ Form::text('fl_stars') }}    <br/>
        
        {{ Form::label('fl_writer', 'Film writer:', array('class' => '')) }}
        {{ Form::text('fl_writer') }}    <br/>
        
        {{ Form::label('fl_story', 'Film Story:', array('class' => '')) }}
        {{ Form::textarea('fl_story') }}   <br/>      

        {{ Form::label('fl_outline', 'Film Outline:', array('class' => '')) }}
        {{ Form::textarea('fl_outline') }}<br/>

        {{ Form::label('fl_genre', 'Film Genre:', array('class' => '')) }}
        {{ Form::text('fl_genre') }}        <br/> 

        {{ Form::label('fl_releasedate', 'Actual Release:', array('class' => '')) }}
        {{ Form::text('fl_releasedate') }} <br/>

        {{ Form::label('fl_release_date', 'Berdict Release:', array('class' => '')) }}
        {{ Form::text('fl_release_date') }} <br/>

        {{ Form::label('fl_duration', 'Film Duration:', array('class' => '')) }}
        {{ Form::text('fl_duration') }}     <br/>        

        {{ Form::label('fl_rating', 'Film Rating:', array('class' => '')) }}
        {{ Form::text('fl_rating') }}    <br/>

        {{ Form::label('fl_country', 'Film Country:', array('class' => '')) }}
        {{ Form::text('fl_country') }}    <br/>

        {{ Form::label('fl_language', 'Film Language:', array('class' => '')) }}
        {{ Form::text('fl_language') }}    <br/>		

        {{Form::file('image', array('id' => 'image'))}}<br/><br/>
        
        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}<br/>
        {{ Form::close()}}
    </section>
</div>

@stop