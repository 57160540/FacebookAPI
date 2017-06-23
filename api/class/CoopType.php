<?php

require("db.php");
class CoopType extends db
{

    function __construct()
    {
        /*
        * Database Connect
        */
        $this->Open();
    }

    public function getAllType()
    {
        $sql = "select * from Co_op_Type";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if($result = mysqli_query($this->db_link, $sql)){
            $this->Close();
            return $result; 
        }
    }

    public function getTypeByID($id)
    {
        $sql = "select *  from Co_op_Type  where co_type_id = '".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if($result = mysqli_query($this->db_link, $sql)){
            $this->Close();
            return $result; 
        }
    }

    public function registUser($id)
    {
        if($this->checkUser($id)){
            return "{\"error\" : false,\"message\" : \"login success\"}";
        }else{
            $this->register($id);
            $this->inviteFriends($id);
            return "{\"error\" : false,\"message\" : \"login success and register success\"}";
        }
        return;
    }

    public function checkUser($id)
    {
        $sql = "select * from `HMD_user` where fb_id ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        $result = mysqli_query($this->db_link, $sql);
        $this->Close();
        if($result->num_rows != 0){
            return true;
        }else{
            return false;
        }
        
    }

    public function register($id)
    {
        $sql = "insert into `HMD_user`(`fb_id`) values ('".$id."')";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return true;
        }
    }

    public function inviteFriends($id){
        $sql = "select * from `HMD_invite_friends` where receiver_invite='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if($result = mysqli_query($this->db_link, $sql)){
            for ($i = 0; $i < 5; $i++) {
                $row = mysqli_fetch_object($result);
                $coin = $row['coin']+1000;
                $sql = "update `HMD_user` SET  `coin` = '".$coin."' WHERE `fb_id` ='".$row['invitee']."'";
            }
            $this->Close();
            return true;
        }
    }
    
    public function updateCoins($id,$coin){
        $sql = "update `HMD_user` SET  `coin` =  '".$coin."' WHERE `fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update coins success\"}";
        }
    }

    public function updateLevels($id,$level){
        $sql = "update `HMD_user` SET  `level` =  '".$level."' WHERE `fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update levels success\"}";
        }
    }

    public function updateExp($id,$exp){
        $sql = "update `HMD_user` SET  `exp` =  '".$exp."' WHERE `fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update EXP success\"}";
        }
    }

    public function updateSingleHighScores($id,$score){
        $sql = "update `HMD_user` SET  `single_high_score` =  '".$score."' WHERE  `HMD_user`.`fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update single high scores success\"}";
        }
    }

    public function updateRanks($id,$rank){
        $sql = "update `HMD_user` SET  `rank` =  '".$rank."' WHERE  `HMD_user`.`fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update rank success\"}";
        }
    }

    public function updateFamousPoints($id,$point){
        $sql = "update `HMD_user` SET  `famous_points` =  '".$point."' WHERE  `HMD_user`.`fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update famous points success\"}";
        }
    }

    public function updateStatus($id,$status){
        $sql = "update `HMD_user` SET  `status` =  '".$status."' WHERE  `HMD_user`.`fb_id` ='".$id."'";
        mysqli_query($this->db_link, "SET NAMES UTF8");
        if(mysqli_query($this->db_link, $sql)){
            $this->Close();
            return "{\"error\" : false,\"message\" : \"update status success\"}";
        }
    }

}

// $db = new user();
// $db->inviteFriends(5);

?>