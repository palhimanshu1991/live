$(".movie-rating-bar a").mouseover(function() {
    var rating = $(this).attr('data-rating');
    var parent = $(this).parent();
    
    $('.your-review-rating').html(rating);

    parent.find('.level-0').removeClass('active');
    for (var i = 1; i <= 10; i++) {
        if(i<=rating){
            parent.find('.level-'+i).addClass('active');
        }
    }
});

$(".movie-rating-bar a").mouseout(function() {
    $(this).removeClass('active');
});

$(".movie-rating-bar").mouseout(function() {
    var rating = $(this).attr('data-original-rating');

    if(rating==='0'){
        $('.your-review-rating').html('-');
    } else {
        $('.your-review-rating').html(rating);
    }

    $(this).find('.level-0').removeClass('active');
    for (var i = 1; i <= 10; i++) {
        if(i<=rating){
            $(this).find('.level-'+i).addClass('active');
        }
    }    
});

$(".movie-rating-bar a").click(function(){
    var value = $(this).attr('data-rating');
    var film = $(this).attr('film-id');
    $('.movie-rating-bar').attr('data-original-rating',value);

    $.ajax({
        url: HOST + "review/rate", //your server side script
        data: {film: film, value: value}, //our data
        type: 'POST',
        success: function(data) {
            //$('#response').append('<li>' + data + '</li>');
        },
        error: function(data) {
            //$('#response').append('<li style="color:red">' + msg + '</li>');
            alert('error');
        }
    });
});


$(".movie-review-textarea").keyup(function() {
    var text = $(this).val().length;
    if (text>0) {
        $(this).parent().parent().find('.review-submit').removeClass('hidden');        
    } else {
        $(this).parent().parent().find('.review-submit').addClass('hidden');                
    }
});

/*
$(".review-submit").click(function() {

    var review = $('.movie-review-textarea').val();
    var review_len = review.length;

    alert(review)

    var film = $(this).attr("movie-id");
    var user = USER;
    var vote = $("#rateit-range-2").attr("aria-valuenow");  
    if($('#fbshare').is(':checked')) {
        var fbshare = '1';
    } else {
        var fbshare = '0';  
    }   

    if (vote == '0') {
        $("#error").html('Please Rate the Movie.');
        $("#error").slideDown(500);
    } else if (review_len < 50) {
        $("#error").html('The Review should be atleast 50 characters long.');
        $("#error").slideDown(500);
    } else {
        $("#review-form-textarea").val('');
        $("#review-form-textarea").focus();
        $("#noreview").fadeOut(800);
        $("#error").html('Posting your review.......');
        $("#error").slideDown(500);

        $.ajax({
            type: "POST",
            url: HOST + "review/add",
            data: {review: review, film: film, user: user, vote: vote, fbshare: fbshare},
            dataType: 'text',
            //cache: false,
            success: function(data) {
                $("#error").slideUp(500);
                $('#my-review').prepend(data);
                $("#noreview").fadeOut(500);
                $("#stexpand").oembed(updateval);
            }
        });
    }
    
    setTimeout(function() {
        $("#error").slideUp(500);
    }, 2000);
    
    return false;
});

*/

$(".activity-comment-submit").click(function() {
    var comment = $(this).parent().find(".js_activity_comment").val();
    var review = $(this).attr("data-review-id");
    var container = $(".activity_comments_container");
    $(this).parent().find(".js_activity_comment").val('');
    $.ajax({
        type: "POST",
        url: HOST + "comment/add",
        data: {review: review, user: USER, comment: comment},
        dataType: 'text',
        //cache: false,
        success: function(data) {
            container.append(data);
        }
    });
    return false;   
});
$('.review-comment').on('keyup', function(e){
    var text = $(this).val().length;

    if(text>0){
        $(this).parent().parent().find(".review-comment-submit").removeClass('hidden');
    }
    if(text<1 || text==0){
        $(this).parent().parent().find(".review-comment-submit").addClass('hidden');
        return;
    }

    if (e.keyCode == 13) {


        //posting a comment
        var comment     =   $(this).val();
        var review      =   $(this).attr("comment-review-id");
        var container   =   $(".comment-container-"+review);

        $(this).parent().find(".js_activity_comment").val('');

        //If enter button is press then it posts it
        $(this).val("");
        $(this).attr("placeholder","Posting your comment.....");
        $(this).parent().parent().find(".review-comment-submit").addClass('hidden');
        
        container.removeClass('hidden');

        $(this).attr("placeholder","Comment posted");        


        $.ajax({
            type: "POST",
            url: HOST + "comment/add",
            data: {review: review, user: USER, comment: comment},
            dataType: 'text',
            //cache: false,
            success: function(data) {
                container.append(data);
            }
        });
        return false;   
    }


});

$('.comment-open').on('click', function(e){
    var review = $(this).attr('review-id');
    $('.comment-container-'+review).removeClass('hidden');
    
});

$('#review-form-textarea').on('focusin', function(e){
    $('#review-tools').removeClass('hidden');
});





$('#invite-friend-submit').on('click', function(e){
	$(this).html('Sending...');
	var email = $('#invite-friend-email').val();
	
	var check = validateEmail(email);
	
	if(check){
		
		$.ajax({
			type: "GET",
			url: HOST + "invite/friend",
			data: {email: email},
			success: function(html)
			{
				$('#invite-friend-submit').html('Sent');			
			},
			error: function(html)
			{
				$('#invite-submit').html('Sent');
			}			
		});		
	
	} else {

		alert('Please enter a correct email');	
		$('#invite-friend-submit').html('Send Invite Code');
	}	
});

$('#invite-submit').on('click', function(e){
	$(this).html('Submitting...');
	var email = $('#invite-email').val();
	
	var check = validateEmail(email);
	
	if(check){
		
		$.ajax({
			type: "GET",
			url: HOST + "invite/add",
			data: {email: email},
			success: function(html)
			{
				$('.invite-body').hide();
				$('#invite-submit').hide();
				$('#invite-message').html('Your request has been submitted. We will get back to you soon.');				
			},
			error: function(html)
			{
				$('#invite-submit').html('Submitted');
			}			
		});		
	
	} else {

		alert('Please enter a correct email');	
		$('#invite-submit').html('Request Invite');
	}
	
});


function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 


$('.comments-open').on('click', function(e){
	var review = $(this).attr("data-id");
	$(this).removeClass("comments-open");
	$(this).addClass("comments-close");
	$("#comments-" + review).show();
});

$('.comments-close').on('click', function(e){
	var review = $(this).attr("data-id");
	alert(review);
	$(this).removeClass("comments-close");
	$(this).addClass("comments-open");
	$("#comments-" + review).hide();
});

// search functions
function search() {
    var rec = document.getElementById('find');
    if (rec.value == '')
    {
        return false;
    } else {
        document.forms["navbar-form"].action = HOST + "search/" + document.forms["navbar-form"]["find"].value;
        return true;
    }
}

$(document).ready(function(){
    $('#navbar-form').on('submit', function(e){
        e.preventDefault();
		var term = $('#typehead-search').val();
		window.location.href = HOST + 'search/' + term;		
    });
	
	//Load more reviews	
	$("#load-more").click(function() {
	
		$(this).html("loading....");
		var count = $(this).attr("data-count");
		var total = $(this).attr("data-total");
		var left = parseInt(total) - parseInt(count);
		var next = parseInt(count) + 5;
		//alert(left);
		var film  = $(this).attr("data-id");				
		//alert(film);
		
		$.ajax({
			type: "POST",
			url: HOST + "reviews/more",
			data: {count: count, film: film},
			cache: false,
			success: function(html)
			{
				$("#load-more").html("load more");
				if (left<6) { $("#load-more").hide(); }				
				$("#load-more").attr("data-count", next);			
				$("#others-content").append(html);
			},
			error: function(html)
			{
				$("#load-more").html("Oops looks like some error occured.");
			}			
		});
		return false;
	});	
});

///////////////// rating plugin
//we bind only to the rateit controls within the products div

$('#movie-rating .rateit').bind('rated reset', function(e) {
    var ri = $(this);
    ri.rateit({step: 2});

    //if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
    var value = $("#rateit-range-2").attr("aria-valuenow");
    var film = ri.attr("data-film"); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()

    //maybe we want to disable voting?
    //ri.rateit('readonly', true);

    $.ajax({
        url: HOST + "review/rate", //your server side script
        data: {film: film, value: value}, //our data
        type: 'POST',
        success: function(data) {
            //$('#response').append('<li>' + data + '</li>');
            //alert('rating posted');
        },
        error: function(jxhr, msg, err) {
            //$('#response').append('<li style="color:red">' + msg + '</li>');
            //alert('error');
        }
    });
});



//////////////////////////////////// Facebook small follow

$(".ajax_follow_s").click(function()
{
    var user = $(this).attr("data-id");
    $("#follow" + user).hide();
    $("#remove" + user).show();
    $.ajax({
        type: "POST",
        url: HOST + "users/follow",
        data: {user: user},
        dataType: 'json',
        cache: false,
        success: function(html)
        {
        }
    });
    return false;
});

$(".ajax_following_s").click(function()
{
    var user = $(this).attr("data-id");
    $("#remove" + user).hide();
    $("#follow" + user).show();
    $.ajax({
        type: "POST",
        url: HOST + "users/unfollow",
        data: {user: user},
        dataType: 'json',
        cache: false,
        success: function(html)
        {
        }
    });

    return false;
});

$("#follow_all").click(function()
{
    var user = '1';
    $(".ajax_follow_s").parent().hide();
    $(".ajax_following_s").parent().show();
    $.ajax({
        type: "POST",
        url: HOST + "users/followAll",
        data: {user: user},
        dataType: 'json',
        cache: false,
        success: function(html)
        {
            alert('followed all');
        }
    });
    return false;
});




// 
$("#email_signup").click(function() {

    $("#btn_signup").slideUp();
    $("#email_form").slideDown();
    return false;
});


///////////////////////// review like 

$(".review-like").click(function()
{

    var element = $(this);
    var review = element.attr("data-id");

    $("#review-like-" + review).hide();
    $("#review-unlike-" + review).show();

    $.ajax({
        type: "POST",
        url: HOST + "review/like",
        data: {review: review},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });

});

$(".review-unlike").click(function()
{

    var element = $(this);
    var review = element.attr("data-id");

    $("#review-unlike-" + review).hide();
    $("#review-like-" + review).show();

    $.ajax({
        type: "POST",
        url: HOST + "review/unlike",
        data: {review: review},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });

});

////////////////////////////////////////////// Follow 

$("#ajax_add_follow").click(function() {

    var user = $("#ajax_add_follow").attr("data-id");

    $(this).hide();
    $("#ajax_del_follow").show();
    $.ajax({
        type: "POST",
        url: HOST + "users/follow",
        data: {user: user},
        dataType: 'json',
        cache: false,
        success: function(html)
        {
        }
    });

    return false;
});


//////////////Unfollow 

$("#ajax_del_follow").click(function() {

    var user = $("#ajax_del_follow").attr("data-id");

    $(this).hide();
    $("#ajax_add_follow").show();

    $.ajax({
        type: "POST",
        url: HOST + "users/unfollow",
        data: {user: user},
        dataType: 'json',
        cache: false,
        success: function(html)
        {

        }
    });

    return false;
});


/////////////////////////////////////// Watchlist button /////////////////////////////////////////

$("#ajax_add_watch").click(function() {

    var film = $("#ajax_add_watch").attr("data-id");

    $(this).hide();
    $("#ajax_del_watch").show();

    $.ajax({
        type: "POST",
        url: HOST + "watchlist/add",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data) {
            
        },
        error: function(data) {

        }
    });
    return false;
});

$("#ajax_del_watch").click(function() {

    var film = $("#ajax_del_watch").attr("data-id");

    $(this).hide();
    $("#ajax_add_watch").show();

    $.ajax({
        type: "POST",
        url: HOST + "watchlist/delete",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data) {

        }
    });
    return false;
});


/////////////////////////////////////// Favourite Button /////////////////////////////////////////
$("#ajax_add_fav").click(function() {

    var film = $("#ajax_add_fav").attr("data-id");

    $(this).hide();
    $("#ajax_del_fav").show();

    $.ajax({
        type: "POST",
        url: HOST + "favourite/add",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });

    return false;
});

$("#ajax_del_fav").click(function() {

    var film = $("#ajax_del_fav").attr("data-id");

    $(this).hide();
    $("#ajax_add_fav").show();

    $.ajax({
        type: "POST",
        url: HOST + "favourite/delete",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });

    return false;
});

////////////////////////////////////// Notification
$(".noti_read").click(function()
{

    var element = $(this);
    var redirect = element.attr("data-url");
    var data_id = element.attr("data-id");
    //window.location.href = redirect;

    //var data_id = 'data-id=' + I;

    $.ajax({
        type: "POST",
        url: HOST + "notifications/read",
        data: {data_id: data_id},
        dataType: 'text',
        cache: false,
        success: function(data)
        {
            window.location.href = redirect;
        }
    });
    return false;
});

$("#noti-read-all").click(function()
{

    var element = $(this);
    $("#noti-count").html('0');
    var data_id = element.attr("id");

    $.ajax({
        type: "POST",
        url: HOST + "notifications/readall",
        data: {data_id: data_id},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });
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
    var review = $('#update').val();
    var review_len = review.length;
    var film = $("#review-form").attr("data-id");
    var user = $("#review-form").attr("data-res-id");

    var vote = $(".movie-rating-bar").attr("data-original-rating");	
	
    console.log(vote);

    if($('#fbshare').is(':checked')) {
		var fbshare = '1';
	} else {
		var fbshare = '0';	
	}	

    if (vote == '0') {
        $("#error").html('Please Rate the Movie.');
        $("#error").slideDown(500);
    } else if (review_len < 10) {
        $("#error").html('Please write a few more words.');
        $("#error").slideDown(500);
    } else {
        $("#update").val('');
        $("#update").focus();
        $("#noreview").fadeOut(800);
        $("#error").html('Posting your review.......');
        $("#error").slideDown(500);

        $.ajax({
            type: "POST",
            url: HOST + "review/add",
            data: {review: review, film: film, user: user, vote: vote, fbshare: fbshare},
            dataType: 'text',
            //cache: false,
            success: function(data) {
				$("#error").slideUp(500);
                $('#content').prepend(data);
                $("#noreview").fadeOut(500);
                $("#stexpand").oembed(updateval);
            }
        });
    }
    setTimeout(function() {
        $("#error").slideUp(500);
    }, 2000);    
    return false;
});


//////////////////////////////////// Mod Review
$("#update_button_mod").click(function()
{
    var review = $('#update').val();
    var review_len = review.length;

    var film = $("#review-form").attr("data-id");
    var user = $("#review-form").attr("data-res-id");
    var vote = $('#vote option:selected').val();

    if (vote == '0') {
        $("#error").html('Please Rate the Movie Mod.');
        $("#error").slideDown(500);
    } else if (vote == '') {
        $("#error").html('Please Rate the Movie Mod.');
        $("#error").slideDown(500);
    } else if (review_len < 50) {
        $("#error").html('The Review should be atleast 50 characters long.');
        $("#error").slideDown(500);
    } else {
        $("#flash").show();
        $("#flash").fadeIn(400).html('<img src="http://www.berdict.com/public/berdict/img/spinner.gif" />');
        $.ajax({
            type: "POST",
            url: HOST + "review/modAdd",
            data: {review: review, film: film, user: user, vote: vote},
            dataType: 'text',
            //cache: false,
            success: function(data)
            {
                $('#content').prepend(data);
                $("#flash").fadeOut(2000);
                $("#update").val('');
                $("#update").focus();
                $("#noreview").fadeOut(500);
                $("#stexpand").oembed(updateval);

            }
        });
    }
    setTimeout(function() {
        $("#error").slideUp(500);
    }, 5000);
    return false;
});


//////////////////////////////////// Contact Form
$(".contact_submit").click(function() {
    var contact_msg = $('#contact_msg').val();
    var contact_email = $('#contact_email').val();
    var contact_name = $('#contact_name').val();

    var contact_msg_len = contact_msg.length;

    if (contact_msg_len < 10) {
        $("#error").html('Please attach the link to your blog or website.');
        $("#error").slideDown(500);
    } else if (contact_email == '') {
        $("#error").html('Email Address you entered does not appear to be valid.');
        $("#error").slideDown(500);
    } else if (contact_name == '') {
        $("#error").html('Please enter your name.');
        $("#error").slideDown(500);
    } else {
        $.ajax({
            type: "POST",
            url: "signup.php",
            data: {contact_msg: contact_msg, contact_email: contact_email, contact_name: contact_name},
            dataType: 'text',
            //cache: false,
            success: function(html)
            {

            }
        });
    }
    setTimeout(function() {
        $("#error").slideUp(500);
    }, 5000);
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
                    url: HOST + "ajax-add-fb.php",
                    data: {fb_uid: fb_uid, fb_link: fb_link, fb_gender: fb_gender, fb_token: fb_token},
                    dataType: 'JSON',
                    //cache: false,
                    success: function(response) {
                        if (response == false) {
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
    }, {scope: 'email,publish_stream,publish_actions,user_friends'});



    return false;
});



// Deleeting FB
$("#ajax_del_fb").click(function() {

    $.ajax({
        type: "POST",
        url: HOST + "ajax-del-fb.php",
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




$(".suggestionAdd").click(function() {	
    var element = $(this);
    var film = element.attr("data-id");
	
    $("#suggestionAdd-" + film).hide();
    $("#suggestionDel-" + film).show();
	
    $.ajax({
        type: "POST",
        url: HOST + "suggestion/add",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });	
});
$(".suggestionDel").click(function() {	
    var element = $(this);
    var film = element.attr("data-id");
    $("#suggestionDel-" + film).hide();
    $("#suggestionAdd-" + film).show();
    $.ajax({
        type: "POST",
        url: HOST + "suggestion/remove",
        data: {film: film},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
        }
    });	
});

//////////////////////////////////// signup buttons
$("#signup_email").click(function() {

    $("#signup_button_box").slideUp(500);
    $("#signup_form").slideDown(500);

});



//commment Submint

$('.comment_button').live("click", function()
{

    var ID = $(this).attr("id");

    var comment = $("#ctextarea" + ID).val();
    var dataString = 'comment=' + comment + '&msg_id=' + ID;

    if (comment == '')
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
            success: function(html) {
                $("#commentload" + ID).append(html);
                $("#ctextarea" + ID).val('');
                $("#ctextarea" + ID).focus();
            }
        });
    }
    return false;
});
// commentopen 
$('.commentopen').live("click", function()
{
    var ID = $(this).attr("id");
    $("#commentbox" + ID).slideToggle(100);
    return false;
});

// delete comment
$('.stcommentdelete').live("click", function()
{
    var ID = $(this).attr("id");
    var dataString = 'com_id=' + ID;

    if (confirm("Sure you want to delete this update? There is NO undo!"))
    {

        $.ajax({
            type: "POST",
            url: "delete_comment_ajax.php",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#stcommentbody" + ID).fadeOut(500);
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
    $("#stbody" + ID).fadeOut(500);

    $.ajax({
        type: "POST",
        url: HOST + "ajax-del-review.php",
        data: {review: review, film: film, owner: owner},
        dataType: 'JSON',
        cache: false,
        success: function(html) {
            $("#stbody" + ID).fadeOut(500);
        }
    });

    return false;
});


///////////////////////////////////////////////////////////////
		function showSpinner(){
		$('#loading-indicator').html('<img src="'+HOST+'public/berdict/img/spinner.gif">');
		};

		$(document).ajaxComplete(function(event, jqXHR, settings) {
			//Call method to hide spinner
			$('#loading-indicator').html('<span class="glyphicon glyphicon-search"></span>');
		});			
			
		var countries = new Bloodhound({
		  datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name); },
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  limit: 10,
		  valueKey: 'id',		  
		  remote: {
			url: HOST + 'ajax/%QUERY',
			beforeSend: function(xhr){
				showSpinner();
			},			
            filter: function(parsedResponse) {
                var dataset = [];
                for (i = 0; i < parsedResponse.length; i++) {
                    dataset.push({
                        name: parsedResponse[i].name,
                        year: parsedResponse[i].year,
                        id: parsedResponse[i].id,
                        url: parsedResponse[i].url
                    });
                }
                if (parsedResponse.length == 0) {
                    dataset.push({
                        name: "No search results",
                        id: "1",
                        url: "1"
                    });
                }
                return dataset;
            }
		  }
		});
		 
		countries.initialize();
		 
		$('.example-countries .typeahead').typeahead(null, {
		  name: 'movies',
		  displayKey: 'name',
		  source: countries.ttAdapter(),
		  templates: {
			footer: '<div class="tt-suggestion"><p style="white-space: normal;">Darasingh: Ironman</p></div>'
		  },
		  
		}).bind('typeahead:selected', function(obj, datum) {
			window.location.href = HOST + 'movie/' + datum.id + '/' + datum.url;
		});		
