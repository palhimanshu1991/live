<div class="container pad0" style="background: #fff;margin-top: 10%;width:450px">
    <div class="col-sm-12 pad0" style="">
        <h2 class="modal-h2" style=""> {{count($people)}} people agree  </h2>
        <div class="col-sm-12 pad0" style="overflow-y: scroll;max-height: 350px;">
            @foreach($people as $people)
            <div class="row-fluid" style="border-bottom: 1px solid #dbdbdb;padding: 15px 0px;">
                <div class="res-review-header col-md-12" style="width:100%;height:48px;">
                    <div class="res-review-user col-md-6 pad0">
                        <a class="left" href="{{Config::get('url.home')}}{{$people->username}}">
                            @if($people->usr_image)
                            <img class="lazy img-responsive " src="{{Config::get('url.web')}}public/user_uploads/1000/{{$people->id}}/{{$people->usr_image}}" alt="" style="width: 48px; display: inline;">
                            @else
                            <img class="lazy img-responsive " src="{{Config::get('url.home')}}public/berdict/img/avatar_50.png" alt="" style="width: 48px; display: inline;">
                            @endif
                        </a>
                        <div class="res-review-user-details">
                            <a href="{{Config::get('url.home')}}{{$people->username}}">{{$people->usr_fname.' '.$people->usr_lname}}</a> 
                        </div>
                    </div>
                    <div class="res-review-rating col-md-6 pad0">
                    </div>
                </div>
            </div>
            @endforeach          
        </div>
    </div>
</div>
