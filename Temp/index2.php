
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook API Demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <script>
		// initialize and setup facebook js sdk
		window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '222997664846378',
		      xfbml      : true,
		      version    : 'v2.8'
		    });

				checkstaus();
		};

		(function(d, s, id){
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) {return;}
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/en_US/sdk.js";
		    fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		

		//check facbook status

		function checkstaus() {
		    FB.getLoginStatus(function(response) {
		    	if (response.status === 'connected') {
		    		document.getElementById('status').innerHTML = 'We are connected.';
		    		document.getElementById('login').style.visibility = 'hidden';
						document.getElementById('logout').style.visibility = 'visible';
		    	} else if (response.status === 'not_authorized') {
						document.getElementById('logout').style.visibility = 'hidden';
						document.getElementById('login').style.visibility = 'visible';
		    		document.getElementById('status').innerHTML = 'We are not logged in.'
		    	} else {
						document.getElementById('logout').style.visibility = 'hidden';
						document.getElementById('login').style.visibility = 'visible';
		    		document.getElementById('status').innerHTML = 'You are not logged into Facebook.';
		    	}
		    });
		}

		// login with facebook with extra permissions
		function login() {
			FB.login(function(response) {
				checkstaus();
			}, {scope: 'public_profile,email,user_friends'});
		}

    function logout() {
				FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });
		}
		
		// getting basic user info
		function getInfo() {
			FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,picture.width(150).height(150)'}, function(response) {
				document.getElementById('user.id').innerHTML = response.id;
        document.getElementById('user.name').innerHTML = response.name;
        document.getElementById('user.first_name').innerHTML = response.first_name;
        document.getElementById('user.last_name').innerHTML = response.last_name;
        document.getElementById('user.pic').innerHTML = "<img src='" + response.picture.data.url + "' class='img-circle'>"; 

			});
		}


    function getUserFriends() {

      FB.api("me/taggable_friends",function (response) {
        if (response && !response.error) {
          console.log('Got friends: ', response.data);
            $.each(response.data,function(index,friend) {
                //alert(friend.name);
		                $("#friendslist").append("<li>" + friend.name + "<li>" + '<img src="'+ friend.picture.data.url +'"/>');
            });
        } else {
            alert("Error!");
        }
      }
    );}

    </script>

	

  
<div class="row">
  <div class="col-md-12">
    <div class="fb-like" data-href="http://localhost:8000/fbjs.html" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
  </div>
</div>

<div class="row">
  <div class="col-md-4"><div id="status"></div></div>
  <div class="col-md-8">	
    <button onclick="getInfo()">Get Info</button>
	  <button onclick="getUserFriends()">Get Friend</button>
    <button onclick="login()" id="login">Login</button>
    <button onclick="logout()" id ="logout">Logout</button>
    <div class="fb-login-button" scope="public_profile,email,user_friends" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="true"></div>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
  <div id="user.id">Facebook User Id</div>
  <div id="user.name">Facebook User name</div>
  <div id="user.first_name">Facebook User firstname</div>
  <div id="user.last_name">Facebook User lastname</div>
  <div id="user.pic">Facebook User Pic</div>
  <div>Friend<ul id="friendslist"></ul></div>
  </div>
  <div class="col-md-4">
    <div class="fb-comments" data-href="http://localhost:8000/fbjs.html" data-numposts="5"></div>
  </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>