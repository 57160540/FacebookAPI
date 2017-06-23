<?php


class db
{
    /*
     * Connection detail.
     */
    private $db_host = "localhost";
    private $db_user = "it57160029";
    private $db_password = "0983696978";
    private $db_database_select = "it57160029";
    public $db_link = null;

    /*
     * Connect or disconnect the database.
     */
    public function Open()
    {
        if (isset($this->db_link)) {
            echo "Warning : You already connected to MySql.";
        } else {
            $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_database_select);
            if (mysqli_error($this->db_link)) {
                die("Connection failed: " . mysqli_error($this->db_link));
            }
            return true;
        }
        return false;
    }
    
    public function Close()
    {
        mysqli_close($this->db_link);
    }



}