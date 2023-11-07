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
}
?>
        
