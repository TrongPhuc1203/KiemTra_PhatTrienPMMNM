<!-- LAB3->config->db.class.php -->
<?php //IDEA:

class Db{
    protected static $connection;
    public function connect(){
        if(!Isset(self::$connection)){
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost",$config["username"],$config["password"],$config["databasename"]);
            }
            if(self::$connection==false){
                return false;
            }        
            return self::$connection;
        }

        public function query_execute($queryString){
            $connection = $this->connect();
            $result = $connection->query($queryString);
            // $connection->close();// Loại bỏ dòng này để giữ kết nối mở
            return $result;
        }

        public function select_to_array($queryString){
            $rows = array();
            $result = $this->query_execute($queryString);
            if($result==false) return false;
            while($item = $result->fetch_assoc()){
                $rows[] = $item;
        }
        $result->free(); // Giải phóng bộ nhớ của kết quả truy vấn
        return $rows;
    }
}
?>
