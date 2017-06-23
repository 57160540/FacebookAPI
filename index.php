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

$query = "select * from Co_op_Activity join Co_op_Type on   Co_op_Type_co_type_id=co_type_id";
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

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(function(){
 
 
    var nowDateTime=new Date("<?=date("m/d/Y H:i:s")?>");
    var d=nowDateTime.getTime();
    var mkHour,mkMinute,mkSecond;
     setInterval(function(){
        d=parseInt(d)+1000;
        var nowDateTime=new Date(d);
        mkHour=new String(nowDateTime.getHours());  
        if(mkHour.length==1){  
            mkHour="0"+mkHour;  
        }
        mkMinute=new String(nowDateTime.getMinutes());  
        if(mkMinute.length==1){  
            mkMinute="0"+mkMinute;  
        }        
        mkSecond=new String(nowDateTime.getSeconds());  
        if(mkSecond.length==1){  
            mkSecond="0"+mkSecond;  
        }   
        var runDateTime=mkHour+":"+mkMinute+":"+mkSecond;        
        $("#css_time_run").html(runDateTime);    
     },1000);
 
 
});
</script>
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

        <?php 
        if(empty($fid)){
        ?>
        var myJsVar = response.id;
        // alert(myJsVar);
        window.location.href = "http://angsila.cs.buu.ac.th/~57160029/SaHaKit/index.php?fid="+myJsVar;
        <?php } ?>

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
font-size: 16px;">Time : <b id="css_time_run"><?=date("H:i:s")?></b> &nbsp;<button onclick="login()" id="login" class="btn btn-danger square-btn-adjust" >Login</button><button onclick="logout()" id ="logout" class="btn btn-danger square-btn-adjust">Logout</button> </div>
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
                        <a class="active-menu"  href="index.php"><i class="fa fa-home" style="font-size:36px"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="profile.php"><i class="fa fa-drivers-license-o" style="font-size:36px"></i> โปรไฟล์ </a>
                    </li>
                                        <li>
                        <a  href="list.php"><i class="fa fa-th-list"  style="font-size:36px"></i> รายการสหกิจที่ลงไปแล้ว </a>
                    </li>

<?php if($fid=='1451739611538469') { ?>
                           <li  >
                        <a   href="manager.php"><i class="fa fa-wrench" style="font-size:36px"></i> ผู้ดูแล </a>
                    </li>   
<?php 
}?>


                    
                    
                                       
                   
                
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
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                             อ่านรายละเอียดด้วยนะจ๊ะ
                          </div>               
                          <div class="panel-body">      
                    


<table width="975" border="5" bordercolor="#8B0000">

<tr bgcolor="#CC0000">
    <th width="150"> <font color="white"><div align="center" >ชื่อโครงการ </div></font></th>
    <th width="200"> <font color="white"><div align="center">รายละเอียดโครงการ </div></font></th>
    <th width="120"> <font color="white"><div align="center">วันที่อบรม </div></font></th>
    <th width="210"> <font color="white"><div align="center">จำนวนชั่วโมง </div></font></th>
    <th width="60"> <font color="white"><div align="center">สถานที่ลงทะเบียน </div></font></th>
    <th width="60"> <font color="white"><div align="center">ประเภท</div></font></th>
    <th width="60"> <font color="white"><div align="center">ตัวเลือก </div></font></th>
 
  </tr>

<!-- <tr>
<td width="200">ชื่อโครงาน</td>
<td width="100">รายละเอียดโครงการ</td>
<td>วันที่อบรม</td>
<td>จำนวนชั่วโมง</td>
<td>สถานที่ลงทะเบียน</td>
<td>ประเภท</td>

<td colspan="2">ตัวเลือก</td>
</tr> -->
<?php
echo $_GET['co_id'];;

while($row = mysql_fetch_array($data)){

?>


<tr>
<td bgcolor="#363636"><font color="white"><div align="center"><?php echo  $row["co_name"] ?></div></font></td>                             
<td><div align="center"><?php echo  $row["co_detail"]; ?></div></td>
<td><div align="center"><?php echo  $row["co_date"]; ?></div></td> 
<td><div align="center"><?php echo  $row["co_hours"]; ?></div></td>
<td><div align="center"><?php echo  $row["co_place"]; ?></div></td>
<td><div align="center"><?php echo  $row["co_type_name"]; ?></div></td>
<td><div align="center"><a href="S_regist.php?co_id=<?php echo $row["co_id"]; ?>&fid=<?php echo $fid; ?>&co_typeID=<?php echo $row["Co_op_Type_co_type_id"]; ?>  " > เข้าร่วม </a></div></td>
</tr>


<!-- <tr>
<td><?php echo $row["co_name"] ?> </td>
<td><?php echo  $row["co_detail"]; ?> </td>
<td><?php echo  $row["co_date"]; ?> </td>
<td><?php echo  $row["co_hours"]; ?> </td>
<td><?php echo  $row["co_place"]; ?> </td>
<td><?php echo  $row["co_type_name"]; ?> </td>
<td><a href="S_regist.php?co_id=<?php echo $row["co_id"]; ?>&fid=<?php echo $fid; ?>&co_typeID=<?php echo $row["Co_op_Type_co_type_id"]; ?>  " > เข้าร่วม </a></td>
</tr> -->


<?php }?>



</table>

 <div class="col-md-4">
    <div class="fb-comments" data-href="http://angsila.cs.buu.ac.th/~57160029/SaHaKit/index.php" data-numposts="5"></div>
  </div>
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
