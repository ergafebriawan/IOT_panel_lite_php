<?php
class Config
{

    var $connect;
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "iot_basic";

    function __construct()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    //PANEL
    public function getData($id = null)
    {
        if ($id === null) {
            return mysqli_query($this->connect, "SELECT * FROM `device`");
        } else {
            return mysqli_query($this->connect, "SELECT * FROM 'device' WHERE id='$id'");
        }
    }

    public function get_role($role){
        return mysqli_query($this->connect, "SELECT * FROM device WHERE role='$role'");
    }

    public function tombolControl($id, $x)
    {
        $update = mysqli_query($this->connect, "UPDATE `device` SET value = $x WHERE id= $id");
        return $update;
    }
    //----------------------------------------------------------------------------------------------------------------------//

    //API
    public function getDevice($id = null)
    {
        if ($id === null) {
            $data = mysqli_query($this->connect, "SELECT * FROM `device`");
        } else {
            $data = mysqli_query($this->connect, "SELECT * FROM `device` WHERE id=$id");
        }
        $array_data = array();
        while ($baris = mysqli_fetch_assoc($data)) {
            $array_data[] = $baris;
        }

        return $array_data;
    }

    public function updateDevice($id, $value)
    {
        return mysqli_query($this->connect, "UPDATE `device` SET value= $value WHERE `device`.`id` = $id;");
    }
    //-----------------------------------------------------------------------------------------------------------------------//

    //AUTHENTICATIONS
    public function login($username, $password)
    {
        $query = mysqli_query($this->connect, "SELECT * FROM user WHERE username='$username'");
        $data_user = $query->fetch_array();
        if ($data_user['password'] == $password) {
            $_SESSION['username'] = $data_user['username'];
            $_SESSION['is_login'] = TRUE;
            return TRUE;
        }
    }
    //------------------------------------------------------------------------------------------------------------------------//
}