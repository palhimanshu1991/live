@section('meta')
<title>Edit Profile</title>
@stop




@section('container')

<div class="" style="background:rgb(234,234,234);margin: 0px 0px 20px 0px">
    <div class="container">
        <div class="row-fluid" style="padding: 20px 0px;">
            <section class="" style="">
                This information is optional, but if you tell us a bit more about yourself, then we can provide you with much better movie recommendations, localized content and include your votes in our demographic breakdowns.
            </section>
        </div>       
    </div>

</div>


<div class="container">
    <div class="row-fluid" style="">
        {{ Form::open(array('url' => '/edit', 'files' => true )) }}
        <div class="col-sm-8 pad0" style="padding-right: 15px;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <div>First Name</div>
                            <input name="firstname" id="firstname" type="text" class="form-control" value="{{$user->usr_fname}}">					
                        </div>
                    </div>    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <div>Last Name</div>
                            <input class="form-control" id="lastname" placeholder="" name="lastname" type="text" value="{{$user->usr_lname}}">                            
                        </div>
                    </div>    
                </div>               
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <div>About Me <span style="color:#999;font-size:13px;">(160 Characters)</span></div>
                            <textarea name="about_me" id="about_me" maxlength="160" class="form-control" style="height:80px;">{{$user->usr_bio}}</textarea>
                        </div>
                    </div>    
                </div>  
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <div>Gender</div>
                            <select name="gender" id="gender" class="form-control" style="padding:9px 5px;">
                                <option value="0">-Select-</option>
                                <option value="f" @if ($user->usr_gender=='f') selected="selected" @endif>Female</option>
                                <option value="m" @if ($user->usr_gender=='m') selected="selected" @endif>Male</option>
                            </select>
                        </div>
                    </div>    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <div>Country</div>
                            <select id="country" name="country" class="form-control" style="padding:9px 5px;">
                                <option value="0">-Select-</option>
                                @foreach ($country as $cn)
                                <option value="{{$cn->cn_id}}" @if ($cn->cn_id==$user->usr_cn_id) selected="selected" @endif  >{{$cn->cn_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>    
                </div>               
            </div>
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input-group pad0 col-sm-12">
                            <input value="save changes" id="submitbutton" name="submitbutton" type="submit" class="btn btn-block btn-main" style="">
                        </div>
                    </div>    
                </div>               
            </div>
        </div>

        <div class="col-sm-4" style="background:rgb(234,234,234);min-height:400px">
            <div class="step2" style="margin: 15px auto 15px 0px;border-bottom: 1px dashed #ccc;">         
                <div align="center"> 
                    <img id="preview" />
                    <div class="info">                    
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                    </div>						
                </div>
            </div>
            <div class="error"></div>
            <div class="dialog-head-container clearfix" style="background:none;border-bottom: 0px solid #e4e4e2;">
                <div class="left" style="width:210px;">
                    <div class=""  style="padding: 10px 0px;font-size: 15px;font-weight: 600;">UPDATE PROFILE PICTURE  <br> </div>
                    <div class="col-sm-12 pad0" style="margin-right:0px;">
                        <img src="{{Config::get('url.home')}}public/user_uploads/1000/{{ $user->id }}/{{ $user->usr_image }}" width="90" height="90" style="box-shadow: 0px 0px 1px #a8a8a8;">
                    </div><br/>
                    <div class="col-sm-12" id="" style="padding:5px 0px;">
                        <!--your content start-->
                        <div style="width:400px">	
                            <input type="hidden" id="x1" name="x1">
                            <input type="hidden" id="y1" name="y1">
                            <input type="hidden" id="x2" name="x2">
                            <input type="hidden" id="y2" name="y2">
                            <input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()"> 
                            <p style="font-size:11px;">JPG/PNG formats only <br>
                                Maximum size 4 MB <br>
                                Greater than 200px in height and width <br> 
                            </p>                    
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        {{ Form::close() }}
    </div>
   


    <!-- Social Settings 	
    <h2 class="heading1">Social Settings</h2>   -->	    

    <!-- Connect to facebook -->
    <!---<p class="mtop mbot0 ttupper"><b>Facebook</b></p>
    <div class="grid_6 mbot0" id="fb_off">
        <div id="fb-ac-details">
            <div class="usr-fb-perms" align="center">
                <a style="padding:6px 60px" id="ajax_add_fb" class="fb_connect">Connect with Facebook</a>   
            </div>  
        </div>
        <div class="clear"></div>
        <div class="error" id="error" style="font-weight:600;padding:5px;margin-top:15px"> </div>
    </div>		

    <!-- Facebook settings -->
    <!---<div class="grid_6 mbot0" id="fb_on" style="display:none;">
        <div id="fb-ac-details">				                                   
            <div class="mbot0 fb-ac-details-dv">
                <div class="column alpha" style="height: 20px;">
                    <img src="https://graph.facebook.com//picture" width="20" height="20">
                </div>
                <div class="column alpha" style="line-height:20px;line-height:20px;">Connected as 
                    <a href="https://www.facebook.com/profile.php?id=" target="_BLANK">



                    </a>
                </div>
                <div class="alpha right" style="line-height:20px;line-height:20px;"> 
                    <a href="" id="ajax_del_fb">Disconnect </a>
                </div>					
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>	-->		




</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
</div>

@stop




@section('extra')

<!-- add extra styles -->
<link href="{{Config::get('url.home')}}public/crop/css/main.css" rel="stylesheet" type="text/css" />
<link href="{{Config::get('url.home')}}public/crop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
<!-- add extra scripts -->
<script src="{{Config::get('url.home')}}public/crop/js/jquery.min.js"></script>
<script src="{{Config::get('url.home')}}public/crop/js/jquery.Jcrop.min.js"></script>
<script src="{{Config::get('url.home')}}public/crop/js/script.js"></script>   

@stop