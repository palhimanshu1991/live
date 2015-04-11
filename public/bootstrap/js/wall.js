
$(document).ready(function() 
{

			$(".ajax_follow_s").click(function()
			{
				var user_id = $(this).attr("data-id");
				var wid = $(this).attr("data-id");
				 $.ajax({
				   type: "POST",
				   url: HOST+ "ajax-add-follow.php",
				   data: { wid : wid},
				   dataType: 'text',
				   success: function(html){}
				 });
					$("#follow"+user_id).hide();
					$("#remove"+user_id).show();
					return false;
			});

			$(".ajax_following_s").click(function()
			{
				var user_id = $(this).attr("data-id");
				var wid = $(this).attr("data-id");
				 $.ajax({
				   type: "POST",
				   url: HOST+ "ajax-del-follow.php",
				   data: { wid : wid},
				   dataType: 'text',
				   success: function(html){}
				 });
					$("#remove"+user_id).hide();
					$("#follow"+user_id).show();
					return false;
			});				
		
		

	
/*
        $('.review-form-container').off('click', '.prom-filter-box-cont');
        $('.review-form-container').on('click', '.prom-filter-box-cont', function(event) {
            var prom_filter_box = $('.prom-filter-box');
            var no_comments_flag = $(prom_filter_box).data('no-comments-flag');

            if ( parseInt(no_comments_flag) == 0 ) {
                $(prom_filter_box).data('no-comments-flag', 1);
                $(prom_filter_box).removeClass('sel');
                $(prom_filter_box).removeAttr('data-icon');
            } else {
                $(prom_filter_box).data('no-comments-flag', 0);
                $(prom_filter_box).addClass('sel');
                $(prom_filter_box).attr('data-icon', ';');
            }    
        });

*/		


//////////////////////////////////// Insert Review
$("#review_submit").click(function() 
{
	var updateval = $('#update').val(); 
	var review_len = updateval.length;

	var flval = $("#review-form").attr("data-id");
	var usrval = $("#review-form").attr("data-res-id");
	var vote = $("#current-rating_f"+flval).attr("vote");

	if (vote=='0') {
		$("#error").html('Please Rate the Movie.');
		$("#error").slideDown(500);
	} else if (review_len<50) {
		$("#error").html('The Review should be atleast 50 characters long.');
		$("#error").slideDown(500);
	} else {
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/spinner.gif" />');
		$.ajax({
		type: "POST",
		url: HOST+ "ajax_add_review.php",
		data: { update: updateval, fl_id : flval, uid : usrval, vote : vote },
		dataType: 'text',
		//cache: false,
			success: function(html)
			{
			$("#flash").fadeOut(2000);
			$("#content").prepend(html);
			$("#update").val('');	
			$("#update").focus();
			$("#noreview").fadeOut(500);
			$("#stexpand").oembed(updateval);			
			
			}
		 });
	}
			setTimeout(function() {$("#error").slideUp(500);}, 5000);
			return false;
});

//////////////////////////////////// Mod Review
$("#update_button_mod").click(function() 
{
	var updateval = $('#update').val(); 
	var review_len = updateval.length;

	var flval = $("#review-form").attr("data-id");
	var usrval = $("#review-form").attr("data-res-id");
	//var vote = $("#current-rating_f"+flval).attr("vote");
	var vote = $('#vote option:selected').val();

	if (vote=='0') {
		$("#error").html('Please Rate the Movie Mod.');
		$("#error").slideDown(500);
	} else if (vote=='') {
		$("#error").html('Please Rate the Movie Mod.');
		$("#error").slideDown(500);
	} else if (review_len<50) {
		$("#error").html('The Review should be atleast 50 characters long.');
		$("#error").slideDown(500);
	} else {
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/spinner.gif" />');
		$.ajax({
		type: "POST",
		url: HOST+  "ajax_add_review.php",
		data: { update: updateval, fl_id : flval, uid : usrval, vote : vote },
		dataType: 'text',
		//cache: false,
			success: function(html)
			{
			$("#flash").fadeOut(2000);
			$("#content").prepend(html);
			$("#update").val('');	
			$("#update").focus();
			$("#noreview").fadeOut(500);
			$("#stexpand").oembed(updateval);			
			
			}
		 });
	}
			setTimeout(function() {$("#error").slideUp(500);}, 5000);
			return false;
});	


//////////////////////////////////// Contact Form
$(".contact_submit").click(function() 
{
	var contact_msg = $('#contact_msg').val(); 
	var contact_email = $('#contact_email').val(); 
	var contact_name = $('#contact_name').val(); 
	
	var contact_msg_len = contact_msg.length;

	if (contact_msg_len<10) {
		$("#error").html('Please attach the link to your blog or website.');
		$("#error").slideDown(500);
	} else if (contact_email=='') {
		$("#error").html('Email Address you entered does not appear to be valid.');
		$("#error").slideDown(500);
	} else if (contact_name=='') {
		$("#error").html('Please enter your name.');
		$("#error").slideDown(500);
	} 	else {
		$.ajax({
		type: "POST",
		url: "signup.php",
		data: { contact_msg: contact_msg, contact_email : contact_email, contact_name : contact_name},
		dataType: 'text',
		//cache: false,
			success: function(html)
			{	
			
			}
		 });
	}
			setTimeout(function() {$("#error").slideUp(500);}, 5000);
			return false;
});


	
/////////////////////////////////////// Watchlist button /////////////////////////////////////////

 $("#ajax_add_watch").click(function() {
 
	var btn = $("#ajax_add_watch");
	var wid = $("#ajax_add_watch").attr("data-id");

	//$(btn).html('<img src="images/spinner.gif" />');

	$(btn).empty();
	$("#ajax_add_watch").hide();
	$("#ajax_del_watch").show();
	$(btn).html('WANT TO WATCH');		


	$.ajax({
		type: "POST",
		url: HOST+  "ajax-add-watch.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{			
			
			//$(btn).removeClass('load');

			}
	 });

			return false;
	});	
	
	

 $("#ajax_del_watch").click(function() {
 
	var btn = $("#ajax_del_watch");
	$(btn).html('<img src="images/spinner.gif" />');

	var wid = $("#ajax_del_watch").attr("data-id");
	//var wid = $("#fl_id").val();
	//var usrval = $("#uid").val();

	$.ajax({
		type: "POST",
		url: HOST+  "ajax-del-watch.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{
			$(btn).empty();
			$("#ajax_del_watch").hide();
			$("#ajax_add_watch").show();
			$(btn).html('Added to Watchlist');	
			}
	 });

return false;
	});		
	
	
////////////////////////////////////////////// facebook

// Adding FB
$("#ajax_add_fb").click(function() {		 
		 
		 FB.login(function(response) {
		 
           if (response.authResponse) 
           {
				FB.api('/me', function(response) {
				
				var fb_uid = response.id;
				//var fb_email = response.email;
				//var fb_fname = response.first_name;		
				//var fb_lname = response.last_name;
				//var fb_username = response.username;		
				var fb_link = response.link;
				var fb_gender = response.gender;		
				var fb_token = FB.getAuthResponse()['accessToken'];
				

				$.ajax({
					type: "POST",
					url: HOST+  "ajax-add-fb.php",
					data: { fb_uid : fb_uid, fb_link : fb_link, fb_gender : fb_gender, fb_token : fb_token},
					dataType: 'JSON',
					//cache: false,
					   success: function(response) {
							if (response==false) {
									alert('Sorry a user with the same facebook ID already exists');
							} else {
										$("#fb_off").slideUp(500);	
										$("#fb_on").slideDown(500);	
							}
						}
				 });
						return false;		
				});
				
            } else 
            {
             console.log('User cancelled login or did not fully authorize.');
            }
         },{scope: 'email,publish_stream,publish_actions,user_friends'});



		return false;
	});		
	


// Deleeting FB
 $("#ajax_del_fb").click(function() {

	$.ajax({
		type: "POST",
		url:  HOST+ "ajax-del-fb.php",
		//data: { wid : wid},
		//dataType: 'text',
		//cache: false,
			success: function(html)
			{
				$("#fb_on").slideUp(500);	
				$("#fb_off").slideDown(500);	
			}
	 });

return false;
	});			
	
		
/////////////////////////////////////// Favourite Button /////////////////////////////////////////

 $("#ajax_add_fav").click(function() {
	$(this).parent().addClass('load');	

	var wid = $("#ajax_add_fav").attr("data-id");
	//var usrval = $("#uid").val();
	
	$("#ajax_add_fav").hide();
	$("#ajax_del_fav").show();	

	$.ajax({
		type: "POST",
		url: HOST+ "ajax-add-fav.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{
			//var btn = $("#resinfo-bt");
			//$(btn).addClass('active').attr('title','Title set to new').parent().removeClass('load');
			//$(btn).fadeIn(400).html('<font color="red">ADDED</font>');



			}
	 });

return false;
	});	
	
	

 $("#ajax_del_fav").click(function() {
	$(this).parent().addClass('load');	

	var wid = $("#ajax_del_fav").attr("data-id");
	//var usrval = $("#uid").val();

	$.ajax({
		type: "POST",
		url:  HOST+ "ajax-del-fav.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{
			//var btn = $("#resinfo-bt");
			//$(btn).addClass('active').attr('title','Title set to new').parent().removeClass('load');
			//$(btn).fadeIn(400).html('<font color="red">ADDED</font>');
			$("#ajax_del_fav").hide();
			$("#ajax_add_fav").show();

			}
	 });

return false;
	});		
	


////////////////////////////////////////////// Follow 

 $("#ajax_add_follow").click(function() {
	//$(this).parent().addClass('load');	

	var wid = $("#ajax_add_follow").attr("data-id");
	//var usrval = $("#uid").val();

	$.ajax({
		type: "POST",
		url: HOST+ "ajax-add-follow.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{
			//var btn = $("#resinfo-bt");
			//$(btn).addClass('active').attr('title','Title set to new').parent().removeClass('load');
			//$(btn).fadeIn(400).html('<font color="red">ADDED</font>');
			$("#ajax_add_follow").hide();
			$("#ajax_del_follow").show();


			}
	 });

return false;
	});		
	

//////////////Unfollow 

 $("#ajax_del_follow").click(function() {
	
	//$(this).parent().addClass('load');	
	var wid = $("#ajax_del_follow").attr("data-id");
	//var usrval = $("#uid").val();

	$.ajax({
		type: "POST",
		url: HOST+ "ajax-del-follow.php",
		data: { wid : wid},
		dataType: 'text',
		cache: false,
			success: function(html)
			{
			//var btn = $("#resinfo-bt");
			//$(btn).addClass('active').attr('title','Title set to new').parent().removeClass('load');
			//$(btn).fadeIn(400).html('<font color="red">ADDED</font>');
			$("#ajax_del_follow").hide();
			$("#ajax_add_follow").show();


			}
	 });

return false;
	});		
	
	
	
//////////////////////////////////// signup buttons
 $("#signup_email").click(function() {
	
	$("#signup_button_box").slideUp(500);		
	$("#signup_form").slideDown(500);
	
});	
	
	
	
//commment Submint

$('.comment_button').live("click",function() 
{

var ID = $(this).attr("id");

var comment= $("#ctextarea"+ID).val();
var dataString = 'comment='+ comment + '&msg_id=' + ID;

if(comment=='')
{
alert("Please Enter Comment Text");
}
else
{
$.ajax({
type: "POST",
url: "comment_ajax.php",
data: dataString,
cache: false,
success: function(html){
$("#commentload"+ID).append(html);
$("#ctextarea"+ID).val('');
$("#ctextarea"+ID).focus();
 }
 });
}
return false;
});
// commentopen 
$('.commentopen').live("click",function() 
{
var ID = $(this).attr("id");
$("#commentbox"+ID).slideToggle(100);
return false;
});	

// delete comment
$('.stcommentdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'com_id='+ ID;

if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "delete_comment_ajax.php",
data: dataString,
cache: false,
success: function(html){
 $("#stcommentbody"+ID).fadeOut(500);
 }
 });

}
return false;
});


///////////////////////////////////////////////////////////////////////////// delete review
$(".stdelete").click(function() 
{
	
	
	var ID = $(this).attr("id");
	var review = $(this).attr("id");
	var film = $("#review-form").attr("data-id");	
	var owner = $(this).attr("data-id");		
	$("#stbody"+ID).fadeOut(500);

		$.ajax({
		type: "POST",
		url: HOST+ "ajax-del-review.php",
		data: { review : review, film : film, owner : owner},
		dataType: 'JSON',
		cache: false,
			success: function(html){
				$("#stbody"+ID).fadeOut(500);
			 }
		 });

		return false;
});

///////////////////////////////////////////////////////////////
   
});