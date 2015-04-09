@section('meta')
<title>Contact Us - Berdict</title>
@stop

@section('container')

<div class="container">
    <div class="row">
        <form id="contactform" method="post" action="">
            <div class="col-sm-5 col-sm-offset-4">
                <h2>CONTACT US</h2>
                <div style="font-size:13px;margin-bottom:10px">
                    @if (Session::has('flash_error'))        
                    <font color="green"> {{ Session::get('flash_error') }}</font>
                    @else
               
					@endif
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group pad0 col-sm-12">
                                <div>Movie Name</div>
                                <input type="text" name="name" id="name" maxlength="50" size="30" class="form-control" value="">					
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group pad0 col-sm-12">
                                <div>Movie Id</div>
                                <input type="text" id="fl_id" name="fl_id" maxlength="80" size="30" class="form-control" value="">					
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						<div class="form-group">
							<div class="input-group pad0 col-sm-12">
								<div>Language</div>
								<select name="language" id="gender" class="form-control" style="padding:9px 5px;">
									<option value="English">English</option>
									<option value="Hindi" >Hindi</option>
								</select>
							</div>
						</div>  
                    </div>
                </div>				
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group pad0 col-sm-12">
                                <input type="submit" value="Submit" name="invite " class="btn btn-block">   
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>




<!------ Sign Up Form ---

<div class="col-lg-6" style="width:600px;">
    <div class="search_results mbot mt5">
        <section id="search-results-container">




            <br>

            <table width="">
                <tbody><tr>
                        <td valign="top">
                            <div class="label" for="con_name">Name <br>
                                <input type="text" name="con_name" id="con_name" maxlength="50" size="30" style="width:380px;">
                            </div></td>
                    </tr>
                    <tr><td valign="top">


                            <div class="label" for="con_email">Your Email <br>
                                <input type="text" id="con_email" name="con_email" maxlength="80" size="30" style="width:380px;">
                            </div></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div class="label" for="con_msg">Message <br>
                                <textarea name="con_msg" id="con_msg" maxlength="1000" cols="32" rows="6" style="width:380px;"></textarea>
                            </div></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="float:left; margin-left:272px; margin-top:8px;">
                            <input type="submit" value="Submit" name="invite " class="ajax_follow">   

                        </td>
                    </tr>
                </tbody></table>
            </form>




        </section></div>

    <br style="clear:both">
</div>
</div></div>
-->
@stop