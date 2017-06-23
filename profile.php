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
 $query = "select * from Member where m_userID = '".$fid."'";

  $query2 = "select * from Member where m_userID = '".$fid."'";
  $data2 = mysql_query($query2);

$data = mysql_query($query); //query ข้อมูล

$count=0;
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
        document.getElementById('user.id').value = response.id;

         <?php 
        if(empty($fid)){
        ?>
        var myJsVar = response.id;
        // alert(myJsVar);
        window.location.href = "http://angsila.cs.buu.ac.th/~57160029/SaHaKit/profile.php?fid="+myJsVar;
        <?php } ?>
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
                <a class="navbar-brand" href="index.html">SaHaKit</a> 
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
                        <a   href="index.php"><i class="fa fa-home" style="font-size:36px"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a class="active-menu" href="profile.php"><i class="fa fa-drivers-license-o" style="font-size:36px"></i> โปรไฟล์ </a>
                    </li>
                    <li>
                        <a  href="list.php"><i class="fa fa-th-list" style="font-size:36px"></i> รายการสหกิจที่ลงไปแล้ว </a>
                     
                    
                    
                                       
                   
                
                </ul>
               
            </div>
            
        </nav>  






        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>ข้อมูลส่วนตัว</h2>   
                        <h5>ข้อมูลส่วนตัวของหนู</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 


                    <div class="row"> 
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <!-- <div class="panel-heading">
                             กรอกข้อมูลส่วนตัวตรงนี้นะแจ๊ะ
                          </div>  -->              
                          <div class="panel-body">      
                            <!-- <div style="margin-top: 10px;">
  										      </div> -->   

                            <!-- <div style="margin:5px;" class="btn-toolbar">
                            </div> -->
<?php
$check=0;

                  while($row2 = mysql_fetch_array($data2)){
                             if( $row2["m_Firstname"]!=null){
                              $check++;
                             } 


}


 ?>


<?php if($check==0){  ?>
                            <form name="form1" method="post" action="process_profile.php">
                              <!-- <table width="400" border="1" style="width: 400px"> -->
                                
                                 
                                    <input name="m_userID" type="hidden" id="user.id" size="35">
                                   
                                    รหัสนิสิต
                                    <input type="text" class="form-control"  style="width:300px;" name="m_StudentID"><br>

                                    ชื่อ
                                    <input type="text" class="form-control"  style="width:300px;" name="m_Firstname"><br>
                                    
                                    นามสกุล
                                    <input type="text" class="form-control"  style="width:300px;" name="m_Lastname"><br>
                                           
                                    สาขา
                                    <input type="text" class="form-control"  style="width:300px;" name="m_major"><br>
                                  
                                    เบอร์โทรศัพท์
                                    <input type="text" class="form-control"  style="width:300px;" name="m_phone"><br>
                                  
                                    E-mail
                                    <input type="text" class="form-control"  style="width:300px;" name="m_email"><br>
                  
                                    ชั้นปี
                                    <input type="text" class="form-control"  style="width:300px;" name="m_level">
                              


                                  <!--   Status

                                    <select class="form-control" style="width:150px;">
                                        <option  value="ADMIN">ควายในร่างคน</option>
                                        <option value="USER">คนในร่างควาย</option>
                                    </select>
                                     -->
                              
                              <br>
                              <button type="submit" name=submitForm class="btn btn-active"  value="Save">บันทึก</button>
                            </form>


<?php } else { ?>




                                
<input name="m_userID" type="hidden" id="user.id" size="35">

                                
                                <center>
                                <table width="900" border="5" bordercolor="#8B0000">
                                <tr bgcolor="#CC0000">
                                  <th width="50"> <font color="white"><div align="center" >รหัสนิสิต </div></font></th>
                                  <th width="200"> <font color="white"><div align="center">ชื่อ </div></font></th>
                                  <th width="120"> <font color="white"><div align="center">นามสกุล </div></font></th>
                                  <th width="210"> <font color="white"><div align="center">สาขา </div></font></th>
                                  <th width="60"> <font color="white"><div align="center">เบอร์โทรศัพท์ </div></font></th>
                                  <th width="60"> <font color="white"><div align="center">E-mail</div></font></th>
                                  <th width="100"> <font color="white"><div align="center">ชั้นปี </div></font></th>
                                </tr>
                                <?php
                                

                                while($row = mysql_fetch_array($data)){

                                ?>
              <tr>
              <td bgcolor="#363636"><font color="white"><div align="center"><?php echo  $row["m_StudentID"] ?></div></font></td> 
                               
                               <td><div align="center"> <?php echo  $row["m_Firstname"]; ?></div></td>
                               <td><div align="center"><?php echo  $row["m_Lastname"]; ?></div></td> 
                               <td><div align="center"><?php echo  $row["m_major"]; ?></div></td>
                               <td><div align="center"> <?php echo  $row["m_phone"]; ?></div></td>
                               <td><div align="center"><?php echo  $row["m_email"]; ?></div></td>
                               <td><div align="center"><?php echo  $row["m_level"]; ?></div></td>
                               </tr>

                                <?php }?>
                                </table>
                                </center>


<?php } ?>


                          </div>
                        </div>
                      </div>
                    </div>
               </div>
             <!-- /. PAGE INNER  -->
        </div>







         <!-- /. PAGE WRAPPER  -->
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
