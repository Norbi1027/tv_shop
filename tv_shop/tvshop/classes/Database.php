<?php
class Database {

    private $db = null;
    public $error = false;

    public function __construct($host, $username, $password, $db) {
        try {
            $this->db = new mysqli($host, $username, $password, $db);
            $this->db->set_charset("utf8");
        } catch (Exception $exc) {
            $this->error = true;
            echo '<p>Az adatbázis nem elérhető!</p>';
            exit();
        }
    }
    
    public function login($username, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE users.username LIKE ?;');
        $stmt->bind_param("s",$username);
        
        if ($stmt->execute()) {
            $return = $stmt->get_result();
            $row = $return->fetch_assoc();
            var_dump($row, $password);
            if($username == $row['username']){
                $_SESSION['username'] = $row;
                $_SESSION['login'] = true;
                return true;
            }else{
                $_SESSION['username'] = '';
                $_SESSION['login'] = false;
                return false;
            }
            $result->free_result();
            //header("Location:index.php");
        }
        return false;
    }
    
    public function register($username,$email,$password) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`user_id`, `username`,`email`,`password`) VALUES (NULL,?,?,?)");
        $stmt->bind_param("sss",$username,$email,$password);
        try{
            if($stmt->execute()){
                $_SESSION['login']=true;
            }
            else{
                $_SESSION['login']=false;
                echo'<p>Rögzités sikertelen</p>';
            }
        } catch (Exception $exc) {
            $this->error = true;
        }
    }
    public function osszesTv() {
        $result = $this->db->query("SELECT * FROM `tv`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getKivalasztottTv($id) {
        $result = $this->db->query("SELECT * FROM `tv` WHERE tv_id=" . $id);
        return $result->fetch_assoc();
    }
    public function setKivalasztottAllat($tv_id, $tv_neve, $tv_marka, $tv_atmero, $tv_kijelzo, $tv_felbontas) {
        $stmt = $this->db->prepare("UPDATE `tv` SET `tv_neve`= ?,`tv_marka`= ?,`tv_atmero`= ?,`tv_kijelzo`= ?,`tv_felbontas`= ?WHERE tv_id= ?");
        $stmt->bind_param('isssss', $tv_id, $tv_neve, $tv_marka, $tv_atmero, $tv_kijelzo, $tv_felbontas);
        return $stmt->execute();
    }

}
?>
        
