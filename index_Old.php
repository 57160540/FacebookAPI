<?php 
session_start();
$fid = $_GET['fid'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<?php
$host = "localhost"; // ชื่อ host หรือ ip ที่ใช้
$userhost = "it57160029"; // ชื่อ user ที่ใช้ในการล็อกอิน
$passhost = "0983696978"; // password ที่ใช้ในการล็อกอิน
$database = "it57160029"; // ชื่อ Database
$conn = mysql_connect($host,$userhost,$passhost);
if(!$conn){
  echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
}
mysql_query("use $database"); // เลือกฐานข้อมูลที่ใช้
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

$query = "select * from Co_op_Activity";
$data = mysql_query($query); //query ข้อมูล

$count=0;
// while($show = mysql_fetch_array($data)){

// $count++;
//   echo $count ." ";
//   echo $show[4];
//   echo "<br>";

//   echo $show[1];
//   echo "<br>"; 
// }
?>

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
                    
                    <p  id="user.name"></p>
                    
                    </li>
                
                    
                    <li>
                        <a class="active-menu"  href="index.php"><i class="fa fa-bathtub" style="font-size:36px"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="profile.php"><i class="fa fa-drivers-license-o" style="font-size:36px"></i> โปรไฟล์ </a>
                    </li>
                    <li>
                        <a  href="list.php"><i class="fa fa-qrcode fa-3x"></i> รายการสหกิจที่ลงไปแล้ว </a>
                    </li>
                           <li  >
                        <a   href="admin_page.php"><i class="fa fa-bar-chart-o fa-3x"></i> ผู้ดูแล </a>
                    </li>   
                      <li  >
                        <a  href="table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>               
                    
                                       
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li>   
                </ul>
               
            </div>
            
        </nav>  


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>รายการสหกิจที่เข้าร่วมได้</h2>   
                        <h5>ลงแล้วมาด้วยนะจ๊ะ</h5>
                    </div>
                </div>
                            
                    <div class="row"> 
                      <div class="col-md-10">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                             อ่านรายละเอียดด้วยนะจ๊ะ
                          </div>               
                          <div class="panel-body">      
                    


<table width="800" border="5" bordercolor="#8B0000">

<tr bgcolor="#CC0000">
<td width="150"><font size="3" color="white"><div align="center">ชื่อโครงาน</div></font></td>
<td width="200"><font size="3" color="white"><div align="center">รายละเอียดโครงการ</div></font></td>
<td><font size="3" color="white"><div align="center">วันที่อบรม</div></font></td>
<td width="60"><font size="3" color="white"><div align="center">จำนวนชั่วโมง</div></font></td>
<td><font size="3" color="white"><div align="center">สถานที่ลงทะเบียน</div></font></td>

<td colspan="2"><font size="3" color="white"><div align="center">ตัวเลือก</div></font></td>
</tr>
<?php
echo $_GET['co_id'];;

while($row = mysql_fetch_array($data)){

?>
<tr>
<td><?php echo $row["co_name"] ?> </td>
<td><?php echo  $row["co_detail"]; ?> </td>
<td><?php echo  $row["co_date"]; ?> </td>
<td><?php echo  $row["co_hours"]; ?> </td>
<td><?php echo  $row["co_place"]; ?> </td>

<td><a href="S_regist.php?co_id=<?php echo $row["co_id"]; ?>" > เข้าร่วม </TD>


</tr>

<?php }?>



</table>
                          </div>
                        </div>
                      </div>
                    </div>
               </div>
             <!-- /. PAGE INNER  -->
        </div>







         <!-- /. PAGE WRAPPER  -->
        </div>
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
