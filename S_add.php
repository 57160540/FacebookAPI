<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> SaHaKit </title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>


    <script>
    // initialize and setup facebook js sdk
    window.fbAsyncInit = function() {
        FB.init({
          appId      : '222997664846378',
          cookie : true,
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

        getInfo();
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
        getInfo();
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
       // document.getElementById('user.id').value = response.id;
        var user_id=response.id;
        document.getElementById('user.name').innerHTML = response.name;
         //document.getElementById('user.first_name').innerHTML = response.first_name;
        // document.getElementById('user.last_name').innerHTML = response.last_name;
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
    <div id="wrapper">
  <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SaHaKit</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <button onclick="login()" id="login" class="btn btn-danger square-btn-adjust" >Login</button><button onclick="logout()" id ="logout" class="btn btn-danger square-btn-adjust">Logout</button> </div>
        </nav>


           <!-- /. NAV TOP  -->
                        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <div id="user.pic"  class="user-image img-responsive"><img src="assets/img/find_user.png" class="user-image img-responsive"/></div>
                    
                    <p style="font-family:AngsanaUPC; font-size:30pt; color:white" id="user.name">Loadname</p> 
                    
                    </li>
                
                    
                    <li>
                        <a   href="index.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="profile.php"><i class="fa fa-desktop fa-3x"></i> โปรไฟล์ </a>
                    </li>
                    <li>
                        <a  href="list.php"><i class="fa fa-qrcode fa-3x"></i> รายการสหกิจที่ลงไปแล้ว </a>
                    </li>
                           <li  >
                        <a class="active-menu"   href="manager.php"><i class="fa fa-bar-chart-o fa-3x"></i> ผู้ดูแล </a>
                    </li>   
      
                </ul>
               
            </div>
            
        </nav>  


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>SaHaKit</h2>   
                        <h5></h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                    
                      <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         สหกิจ
                        </div>        
                                      
                                    <div class="panel-body"> 

                  
<form name="form1" method="post" action="process_admin.php">
  เพิ่มข้อมูลสหกิจ <br>
  <table width="400" border="1" style="width: 500px">
    <tbody>
     
       
        
          <input name="m_userID" type="hidden" id="user.id" size="35">
       
      
      <tr>
        <td> &nbsp;ชื่อ</td>
        <td><input name="co_name" type="text" id="co_name" size="50">
        </td>
      </tr>
      <tr>
        <td> &nbsp;วันที่</td>
        <td><input type="datetime-local" name="co_date"  id="co_date" size="50">
        </td>
      </tr>
      <tr>
        <td>&nbsp;เวลา</td>
        <td><input name="co_time" type="text" id="co_time" size="50"></td>
      </tr>

       <tr>
        <td>&nbsp;รายละเอียด</td>
        <td><textarea name="co_detail" type="text" id="co_detail" width="200"> </textarea>
      </tr>

  <tr>
        <td>&nbsp;จำนวนชั่วโมง</td>
        <td><input name="co_hours" type="text" id="co_hours" size="50"></td>
      </tr>

       <tr>
        <td>&nbsp;สถานที่</td>
        <td><input name="co_place" type="text" id="co_place" size="50"></td>
      </tr>
         <tr>
        <td>&nbsp;เวลาที่เริ่มลงทะเบียน</td>
        <td><input type="datetime-local" name="co_StartTime" id="co_StartTime" size="50"></td>
      </tr>
        <tr>
        <td>&nbsp;เวลาสิ้นสุดลงทะเบียน</td>
        <td><input type="datetime-local" name="co_StopTime" id="co_StopTime" size="50"></td>
      </tr>
        
      <tr>
        <td> &nbsp;ชนิดสหกิจ</td>
        <td>
          <select name="Co_op_Type_co_type_id" id="Co_op_Type_co_type_id">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
</td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="Save">
</form>
                   
               			 			</div>
            		</div>
                         </div>


             <!-- /. PAGE INNER  -->
            	</div>
         <!-- /. PAGE WRAPPER  -->
        </div>
      </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
 <div id="status"></div>
</body>
</html>
