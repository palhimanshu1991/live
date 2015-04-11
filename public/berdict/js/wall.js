// search function
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


$(document).ready(function()
{



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
        var redirect = element.attr("href");
        var data_id = element.attr("data-id");
        //window.location.href = redirect;

        //var data_id = 'data-id=' + I;

        $.ajax({
            type: "POST",
            url: HOST + "notifications/read",
            data: {data_id: data_id},
            dataType: 'json',
            cache: false,
            success: function(data)
            {
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
        //var usrval = ;
        //var vote = $("#current-rating_f" + film).attr("vote");
        var vote = $("#rateit-range-2").attr("aria-valuenow");

        if (vote == '0') {
            $("#error").html('Please Rate the Movie.');
            $("#error").slideDown(500);		
        } else if (review_len < 50) {
            $("#error").html('The Review should be atleast 50 characters long.');
            $("#error").slideDown(500);
        } else {
            $("#flash").show();
            $("#flash").fadeIn(400).html('<img src="images/spinner.gif" />');
            $.ajax({
                type: "POST",
                url: HOST + "review/add",
                data: {review: review, film: film, user: user, vote: vote},
                dataType: 'text',
                cache: false,
                success: function(data) {

                    $('#content').prepend(data);
                    $("#flash").fadeOut(2000);
                    $("#update").val('');
                    $("#update").focus();
                    $("#noreview").fadeOut(500);
                    $("#stexpand").oembed(updateval);

                }
            });
        }
        return false;
    });

//////////////////////////////////// Mod Review
    $("#update_button_mod").click(function()
    {
        var review = $('#update').val();
        var review_len = review.length;

        var film = $("#review-form").attr("data-id");
        var user = $("#review-form").attr("data-res-id");
        //var vote = $("#current-rating_f"+flval).attr("vote");
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
            $("#flash").fadeIn(400).html('<img src="images/spinner.gif" />');
            $.ajax({
                type: "POST",
                url: HOST + "ajax_add_review.php",
                data: {review: review, film: film, user: user, vote: vote},
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

});