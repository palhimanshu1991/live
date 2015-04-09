@section('meta')
<title>Berdict</title>
<meta name="title" content="Berdict - short movie reviews from your friends and critics.">
<meta name="description" content="Berdict shows you short movie reviews of 400 characters from you friends and critics.">
<meta name="keywords" content="movies,films,film reviews,critic reviews,movie reviews,berdict,berdict.com">
<meta name="image" content="{{Config::get('url.home')}}public/berdict/img/main_index.png"/>
<meta property='og:image' content="{{Config::get('url.home')}}public/berdict/img/main_index.png" />
@stop



@section('container')


<div class="container" id="mainframe">
    <div class="col-md-8 column search-start" style="min-height:600px">
        <div class="search_results mbot mtop0">
            <section id="search-results-container">

                <h2 style="font-weight:700;text-transform: uppercase;border-bottom: 1px solid #efefef;padding: 0px 0px 15px 0px;">                    
                    Edit Your Review 
                </h2>


                <div class="res-review-header clearfix">

                    {{ Form::open()}}


          
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group pad0 col-sm-12">
                                    <textarea name="review_text" id="update" maxlength="400" class="form-control" style="height:80px;">{{$review->fr_review}}</textarea>
                                </div>
                            </div>    
                        </div>  
                    </div>


                    {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

                    {{ Form::close() }}

                </div>

            </section>
        </div>
    </div>
</div>

<div class="container" style="margin-top:15px;">

    <div class="col-lg-4 col-lg-offset-4 m-t-lg">

    </div>
</div>


@stop