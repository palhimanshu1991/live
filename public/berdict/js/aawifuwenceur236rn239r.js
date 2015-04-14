
$(document).ready(function() {

    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    });

    // Validate facebook signup form	
    $("#fb_form").validate({
        rules: {
            fb_username: {
                required: true,
                alphanumeric: true,
                minlength: 3,
                maxlength: 13,
                async: false,
                remote: {
                    url: HOST + "facebook/checkUsername",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        username: function() {
                            return $("#fb_username").val();
                        }
                    }
                }
            },
            fb_email: {
                required: true,
                email: true,
                async: false,
                remote: {
                    url: HOST + "facebook/checkEmail",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        email: function() {
                            return $("#fb_email").val();
                        }
                    }
                }
            },
            fb_pass: {
                required: true,
                minlength: 5
            },
            re_fb_pass: {
                required: true,
                minlength: 5,
                equalTo: "#fb_pass"
            }
        },
        // Error messages	
        messages: {
            fb_username: {
                required: "Please enter a username",
                alphanumeric: "Only Alphabets and numbers are allowed",
                minlength: "Username should be of 3-15 characters long",
                maxlength: "Username should be of 3-15 characters long",
                remote: "Username is already taken."
            },
            fb_email: {
                required: "Please provide a email",
                email: "Please provide a vaild email.",
                remote: "Email is already taken."
            },
            fb_pass: {
                required: "Please provide a password",
                minlength: "Password must be at least 5 characters long"
            },
            re_fb_pass: {
                required: "Please provide a password",
                minlength: "Password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            }
        },
        submitHandler: function(form) {

            $("#fb_submit").val('Processing....');
            $("#fb_submit").removeAttr("id");
            $("#fb_submit").removeAttr("type");
            $("#facebook_form").slideUp();
            $("#signup_loading").slideDown();
            fb_pass_submit();
        }

    });



    function fb_pass_submit() {

        FB.api('/me', function(response) {
            var uid = response.id;
            var email = response.email;
            var fname = response.first_name;
            var lname = response.last_name;
            var link = response.link;
            var gender = response.gender;
            //var token = FB.getAuthResponse()['accessToken'];
            var pass = $("#fb_pass").val();
            var username = $("#fb_username").val();

            $.ajax({
                type: "POST",
                url: HOST + "facebook/addUser",
                data: {uid: uid, email: email, fname: fname, lname: lname, username: username, link: link, gender: gender, pass: pass},
                dataType: 'text',
                cache: false,
                success: function(data)
                {
                    window.location.assign(HOST);
                },
                error: function(data)
                {
                    window.location.assign(HOST);
                }
            });
            return false;
        });

    }

    // Validate SignUp Form	
    $("#signup_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            username: {
                required: true,
                alphanumeric: true,
                minlength: 3,
                maxlength: 13,
                async: false,
                remote: {
                    url: HOST + "facebook/checkUsername",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        username: function() {
                            return $("#signup_form #username").val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                async: false,
                remote: {
                    url: HOST + "facebook/checkEmail",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        email: function() {
                            return $("#signup_form #email").val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        // Error messages	
        messages: {
            name: {
                required: "Please enter your full name.",
                minlength: "Musr be atleast 2 characters."
            },
            username: {
                required: "Please enter a username",
                alphanumeric: "Only Alphabets and numbers are allowed",
                minlength: "Username should be of 3-15 characters long",
                maxlength: "Username should be of 3-15 characters long",
                remote: "Username is already taken."
            },
            email: {
                required: "Please provide a email",
                email: "Please provide a vaild email.",
                remote: "Email is already taken."
            },
            password: {
                required: "Please provide a password",
                minlength: "Password must be at least 5 characters long"
            }
        },

        submitHandler: function(form) {
            $("#signup_form .landing-signup").val('Loading....');
			signupSubmit();
        }		

    });

    function signupSubmit() {
		var name = $("#signup_form #name").val();
		var email = $("#signup_form #email").val();
		var username = $("#signup_form #username").val();
		var password = $("#signup_form #password").val();

		$.ajax({
			type: "POST",
			url: HOST + "user/create",
			data: {name: name, email: email, username: username, password: password},
			dataType: 'text',
			cache: false,
			success: function(data)
			{
				window.location.assign(HOST);
			},
			error: function(data)
			{
				window.location.assign(HOST);
			}
		});
    }






});


window.fbAsyncInit = function() {
    FB.init({
        appId: FB_APP_ID, // Set YOUR APP ID berdictlocal 292311107459306
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true  // parse XFBML
    });

    FB.Event.subscribe('auth.authResponseChange', function(response)
    {
        if (response.status === 'connected')
        {
            //document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
            //SUCCESS
        }
        else if (response.status === 'not_authorized')
        {
            document.getElementById("message").innerHTML += "<br>Failed to Connect";

            //FAILED
        } else
        {
            document.getElementById("message").innerHTML += "<br>Logged Out";

            //UNKNOWN ERROR
        }
    });

};

function Login()
{

    FB.login(function(response) {
        if (response.authResponse)
        {
            getUserInfo();
        } else
        {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {scope: 'email,publish_stream,publish_actions,user_friends'});

}



function SignUp()
{
    $('#spam-msg').html('<div style="color:red;">Please allow your browser to open the pop-up.</div><br/>');  
    
    FB.login(function(response) {
        if (response.authResponse)
        {
            FacebookSignUp();
        } else
        {
            alert('Please authorise Facebook to sign up. Don"t worry we don"t spam your timeline. :)');            
            console.log('User cancelled login or did not fully authorize.');
            mixpanel.track("facebook-signup-cancelled");
        }
    }, {scope: 'email,user_friends'});

}

function getUserInfo() {
    FB.api('/me', function(response) {
        var fb_uid = response.id;
        var fb_email = response.email;
        var fname = response.first_name;
        var lname = response.last_name;
        var username = response.username;
        var link = response.link;
        var gender = response.gender;
        //var fb_token = FB.getAuthResponse()['accessToken'];
		$('#load-screen').show();
        $.ajax({
            type: "POST",
            url: HOST + "facebook/checkFb",
            data: {fb_email: fb_email, fb_uid: fb_uid, fname: fname, lname: lname, username: username, link: link, gender: gender},
            dataType: 'text',
            cache: false,
            success: function(data) {
                if (data == 'false') {
                	//User exists
                    console.log('login');
                    //window.location.assign(HOST);						
                } else {
                	// user does not exist
                    console.log('signup');
                    //window.location.assign(HOST);
                }
            },
            error: function() {
                alert('Some error ocurred, please try again.');
            }
        });
        return false;
    });
}




function getPhoto()
{
    FB.api('/me/picture?type=large', function(response) {

        var str = "<br/><b>Pic</b> : <img src='" + response.data.url + "'/>";
        document.getElementById("status").innerHTML += str;
    });
}




function Logout()
{
    FB.logout(function() {
        document.location.reload();
    });
}


    function FacebookSignUp() {
    	console.log('FacebookSignUp');
	    $('#buttons-container').html('<div>Logging you in.....</div><br/>');

        FB.api('/me', function(response) {
            var uid 		= response.id;
            var email 		= response.email;
            var fname 		= response.first_name;
            var lname 		= response.last_name;
            var link 		= response.link;
            var gender 		= response.gender;
            //var token 	= FB.getAuthResponse()['accessToken'];
            var pass 		= "";
            var username 	= response.username;



            setTimeout(function() {             
	            $('#buttons-container').html('<div>Please wait a like a boss while we do the stuff for you.....</div><br/>');            	
				$('#buttons-container').append('<img width="500px" src="http://www.laboiteverte.fr/wp-content/uploads/2011/09/28-The-Godfather.gif">');
            },1000);

            $.ajax({
                type: "POST",
                url: HOST + "facebook/addUser",
                data: {uid: uid, email: email, fname: fname, lname: lname, username: username, link: link, gender: gender, pass: pass},
                dataType: 'text',
                cache: false,
	            success: function(data) {
	                if (data == 'false') {
	                	//User exists
	                    console.log('login');
	                    //Show the loading sign
	    				$('#buttons-container').html('<div>Logging you in.....</div><br/>');
						window.location.assign(HOST);						
	                } else {
	                	// user does not exist
	                    console.log('signup');
	                    // show the loading sign
	                    window.location.assign(HOST);
	                }
	            },
	            error: function() {
	                alert('Some error ocurred, please try again.');
	            }
            });
            return false;
        });

    }

// Load the SDK asynchronously
(function(d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));
$(document).ready(function() {

// Validate signup form	
    $("#upload_form").validate({
        rules: {
            firstname: {
                required: true,
                alphanumeric: true,
                minlength: 2
            },
            lastname: {
                alphanumeric: true
            },
            about_me: {
                maxlength: 400
            }
        },
        // Error messages	
        messages: {
            firstname: {
                required: "First name can't be empty",
                minlength: "Must be atleast 2 characters long"

            },
            about_me: {
                maxlength: "Maximum 400 characters allowed."

            }
        }

//submitHandler: function(form) {
//	  user_details_edit();
//}		

    });
    // Submitting the form if all goes well	
    function user_details_edit()
    {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var about_me = $("#about_me").val();
        var gender = $("#gender").attr("value");
        var country = $("#country").attr("value");
        var city = $("#city").val();
        var dob = $("#dob").val();
        $.ajax({
            type: "POST",
            url: "ajax-user-edit.php",
            data: {firstname: firstname,
                lastname: lastname,
                about_me: about_me,
                gender: gender,
                country: country,
                city: city,
                dob: dob
            },
            dataType: 'text',
            //cache: false,
            success: function(data)
            {
                window.location.assign("user-details-edit.php");
            }
        });
        return false;
    }

});


