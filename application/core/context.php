<?php
class Context
{
    private $mysql_login = "root";
    private $mysql_password = "";
    private $mysql_adress = "127.0.0.1:3306";
    private $mysql_db = "energos";

    private function create_connection(){
        $connection = new PDO("mysql:host=".$this->mysql_adress.";dbname=".$this->mysql_db,
            $this->mysql_login, $this->mysql_password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $connection;
    }

    // private function set_charset($connection)
    // {
    //     mysqli_set_charset($connection, "utf8");
    // }

    public function get_items(){
        $connection = $this->create_connection();
        if($connection)
        {

            //$this->set_charset($connection);
            $sql = "SELECT id, title, image, type, description, price
            FROM items";

            //$result = mysqli_query($connection, $sql);
            $statement = $connection->query($sql);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $resultArray = array();
            //while($row = mysqli_fetch_array($result))
            while($row = $statement->fetch())
            {
                $item = new Item($row['id'], $row['title'], $row['image'], $row['type'], $row['description'], $row['price']);
                array_push($resultArray, $item);
            }
            //mysqli_close($connection);
            $connection = null;
            return $resultArray;
        }
    }

    public function get_filtered_items($predicate){
        $connection = $this->create_connection();
        //var_dump($predicate);
        $whereTYPE = "";
        $whereBRAND = "";
        if(array_key_exists('zb', $predicate)){
            $whereTYPE = $whereTYPE." type = 'zb'";
        }
        if(array_key_exists('pet', $predicate)){
            if(strlen($whereTYPE) == 0){
                $whereTYPE = $whereTYPE." type = 'pet'";
            }else{
                $whereTYPE = $whereTYPE." OR type = 'pet'";
            }
        }
        $brands = $this->get_brands();
    
        foreach ($brands as $brand) {
            if(array_key_exists($brand->id, $predicate)){
                if(strlen($whereBRAND) == 0){
                    $whereBRAND = $whereBRAND." brand = ".$brand->id;
                }else{
                    $whereBRAND = $whereBRAND." OR brand = ".$brand->id;
                }
            }
        }
        if(strlen($whereTYPE) != 0){
            $where = $whereTYPE;
            if(strlen($whereBRAND) != 0){
                $where = "(".$where.") AND (".$whereBRAND.")";
            }
        }else{
            if(strlen($whereBRAND) != 0){
                $where = $whereBRAND;
            }
        }
        if(strlen($where) != 0) $where = "WHERE".$where;
        
        //$where = strlen($whereTYPE) != 0 ? "WHERE".$whereTYPE." AND ".$whereBRAND : "WHERE".$whereBRAND;
        if($connection)
        {
            $sql = "SELECT id, title, image, type, description, price
            FROM items";
            
            $sql = $sql." ".$where;
            $statement = $connection->query($sql);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $resultArray = array();
            while($row = $statement->fetch())
            {
                $item = new Item($row['id'], $row['title'], $row['image'], $row['type'], $row['description'], $row['price']);
                array_push($resultArray, $item);
            }

            $connection = null;
            return $resultArray;
        }
    }

    public function get_brands(){
        
        $connection = $this->create_connection();
        if($connection)
        {
            //$this->set_charset($connection);
            $sql = "SELECT id, name FROM brands";
            //$result = mysqli_query($connection, $sql);
            $statement = $connection->query($sql);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $resultArray = array();
            //while($row = mysqli_fetch_array($result))
            while($row = $statement->fetch())
            {
                $product = new Brand($row['id'], $row['name']);
                array_push($resultArray, $product);
            }

            //mysqli_close($connection);
            $connection = null;
            return $resultArray;
        }
    }

    public function get_user($userData){
        $connection = $this->create_connection();
        if($connection)
        {
            $stmt = $connection->prepare('SELECT id, nickname, password, firstName, lastName, location FROM users where nickname = :nickname and password = :password;');
            $stmt->execute($userData);
            $user = null;
            while($row = $stmt->fetch())
            {
                $user = new User($row["id"], $row["nickname"],$row["password"],$row["firstName"],$row["lastName"],$row["location"]);
            }
            $connection = null;
            return $user;
        }
    }

    public function create_user($userData)
    {
        //return var_dump($userData);
        $user = null;
        $connection = $this->create_connection();
        if($connection)
        {
            $stmt = $connection->prepare("INSERT INTO users (nickname, password, firstName, lastName, location) VALUES (:nickname, :password, :firstName, :lastName, :location);");
            $stmt->execute($userData);
            $id = $connection->lastInsertId();
            $user = new User($id, $userData["nickname"],$userData["password"],$userData["firstName"],$userData["lastName"],$userData["location"]);
            
        }
        $connection = null;
        return $user;
    }

    public function get_item_by_id($id){
        $connection = $this->create_connection();
        if($connection)
        {
            $stmt = $connection->prepare('SELECT id, title, image, type, description, price
            FROM items WHERE id = ?');
            $stmt->execute(array($id));
            $item = null;
            while($row = $stmt->fetch())
            {
                $item = new Item($row['id'], $row['title'], $row['image'], $row['type'], $row['description'], $row['price']);
            }
            $connection = null;
            return $item;
        }
    }

    
}
?>