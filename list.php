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
        <?php
        session_destroy();
        ?>
    });
    }
    
    // getting basic user info
    function getInfo() {
      FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,picture.width(150).height(150)'}, function(response) {
        //document.getElementById('user.id').value = response.id;
        <?php 
        if(empty($fid)){
        ?>
        var myJsVar = response.id;
        // alert(myJsVar);
        window.location.href = "http://angsila.cs.buu.ac.th/~57160029/SaHaKit/list.php?fid="+myJsVar;
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



   function Share(){

    //alert(vichakarnjs);
                FB.ui({
                            method: 'share',
                            href: 'http://angsila.cs.buu.ac.th/~57160029/SaHaKit/',
                         picture: "http://angsila.cs.buu.ac.th/~57160029/SaHaKit/img/sahakit2.jpg",
                           
                            title: "เข้าร่วมอบรมสหกิจกับฉันสิ",
                            description: "ฉันเก็บชั่วโมงสหกิจในช่องวิชาการได้ "+vichakarnjs +" ชั่วโมง "+"และในช่องทักษะได้ "+taksajs+" ชั่วโมงแล้วนะ ",
                            caption: "อย่ารอช้าเข้ามาลงทะเบียนได้เลยและอย่าลืมลงทะเบียนสมัครสมาชิกก่อนนะ",
                        },
                        // callback
                        function (response) {
                            if (response && !response.error_message) {
                                //alert('Posting completed.');
                            } else {
                                //alert('Error while posting.');
                            }
                        }
                );
            }










    </script>


</head>
<body>

<?php

$host = "localhost";
$username = "it57160029";
$password = "0983696978";
$objConnect = mysql_connect($host,$username,$password);
mysql_query("SET NAMES UTF8");
$objDB = mysql_select_db("it57160029");

$strSQL = "SELECT 
                co_list_time, co_name, co_detail, co_list_status, co_date,co_hours, co_type_name
            FROM 
                ((Co_op_List JOIN Co_op_Activity ON (Co_op_Activity_co_id = co_id)) JOIN Member ON (Member_m_id=m_id)) join Co_op_Type on (Co_op_Activity_Co_op_Type_co_type_id= co_type_id)
            WHERE
                m_userID= '".$fid."'  " ;

$strSQL2 = "SELECT 
                co_list_time, co_name, co_detail, co_list_status, co_date,co_hours, co_type_name,Co_op_Activity_Co_op_Type_co_type_id
            FROM 
                ((Co_op_List JOIN Co_op_Activity ON (Co_op_Activity_co_id = co_id)) JOIN Member ON (Member_m_id=m_id)) join Co_op_Type on (Co_op_Activity_Co_op_Type_co_type_id= co_type_id)
            WHERE
                m_userID= '".$fid."'  " ;
                
//print $strSQL;
$objQuery = mysql_query($strSQL) or die (mysql_error());
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());

 







?>



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
font-size: 16px;">Time : <b id="css_time_run"><?=date("H:i:s")?></b> &nbsp;<button onclick="login()" id="login" class="btn btn-danger square-btn-adjust" >Login</button><button onclick="Share()" id="Share" class="btn btn-primary" >Share <i class="fa fa-facebook-square" style="font-size:16px"></i></button><button onclick="logout()" id ="logout" class="btn btn-danger square-btn-adjust">Logout</button> </div>


        </nav>






           <!-- /. NAV TOP  -->
                        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <div id="user.pic"  class="user-image img-responsive"><img src="assets/img/find_user.png" class="img-circle" /></div>
                    
                    <p style="font-family:AngsanaUPC; font-size:30pt; color:white" id="user.name">Loadname</p> 
                    
                    </li>
                     <li>
                        <a  href="index.php"><i class="fa fa-home" style="font-size:36px"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="profile.php"><i class="fa fa-drivers-license-o" style="font-size:36px"></i> โปรไฟล์ </a>
                    </li>
                    <li>
                        <a  class="active-menu" href="list.php"><i class="fa fa-th-list" style="font-size:36px"></i> รายการสหกิจที่ลงไปแล้ว </a>
                    </li>
                          
                      
                                 
                    				
					
					                   
                
                </ul>
               
            </div>
            
        </nav>  


<?php 
$vichakarn=0;
$taksa=0;
while($objResult2 = mysql_fetch_array($objQuery2))
{
echo "string";

if($objResult2["Co_op_Activity_Co_op_Type_co_type_id"]==1 && $objResult2["co_list_status"]==2)
{
$vichakarn+=$objResult2["co_hours"];
}
else  if( $objResult2["Co_op_Activity_Co_op_Type_co_type_id"]==2&& $objResult2["co_list_status"]==2){
  $taksa+=$objResult2["co_hours"];
}

}

?>


<script type="text/javascript">
var vichakarnjs=<?=$vichakarn?>; // ตัวแปร javascript
  var taksajs = <?=$taksa?>;

</script>


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>รายการสหกิจที่เข้าร่วม</h2>
                        <h5>จำนวนชั่วโมง<h5>   
                        <h4>วิชาการ <?php echo  $vichakarn; ?></h4>
                        <h4>ทักษะ <?php echo $taksa; ?> </h4>




                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                   

  <table width="900" border="5" bordercolor="#8B0000" >
  <tr bgcolor="#CC0000">
    <th width="50"> <font color="white"><div align="center" >ลำดับ </div></font></th>
    <th width="200"> <font color="white"><div align="center">โครงการอบรม </div></font></th>
    <th width="120"> <font color="white"><div align="center">วันที่ลงทะเบียน </div></font></th>
    <th width="210"> <font color="white"><div align="center">รายละเอียด </div></font></th>
    <th width="60"> <font color="white"><div align="center">จำนวนชั่วโมง </div></font></th>
    <th width="60"> <font color="white"><div align="center">ประเภท</div></font></th>
    <th width="100"> <font color="white"><div align="center">ผลการอนุมัติ </div></font></th>
 
  </tr>
<?php
$count=0;
while($objResult = mysql_fetch_array($objQuery))
{

    $count++;
?>
  <tr>
  <td bgcolor="#363636"><font color="white"><div align="center"><?php echo $count;?></div></font></td>
    <td><div align="left"><?php echo $objResult["co_name"];?></div></td>
    <td><?php echo $objResult["co_list_time"];?></td>
    
    <td><?php echo $objResult["co_detail"];?></td>
    <td><?php echo $objResult["co_hours"];?></td>
  <td><?php echo $objResult["co_type_name"];?></td>

    <?php  if($objResult["co_list_status"]==0){ ?> 


    <td><div align="center"><?php echo "ไม่ได้เข้ารว่ม" ?></div></td>

       <?php  } 

         if($objResult["co_list_status"]==1){  ?>
<td><div align="center"><?php echo "ลงทะเบียนสำเร็จ" ?></div></td>
       
       <?php  }


       if($objResult["co_list_status"]==2){ ?> 

    <td><div align="center"><?php echo "เข้าร่วม" ?></div></td>


      <?php } ?>
    
  
  </tr>
<?php
}
?>






</table>
<?php
mysql_close($objConnect);
?> 

                          
           
             

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
