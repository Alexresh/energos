<?php
class Context
{
    private $mysql_login = "root";
    private $mysql_password = "";
    private $mysql_adress = "127.0.0.1:3306";
    private $mysql_db = "energos";

    private function create_connection()
    {
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
                $where = $where." AND ".$whereBRAND;
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
            echo $sql;
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

    public function get_user($username, $password){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $stmt = $connection->prepare('SELECT id, username, password FROM computer_shop.user where username = ? and password = ?;');
            $stmt->bind_param('is', $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows_num = mysqli_num_rows($result);
            if($rows_num == '0'){
                mysqli_close($connection);
                return null;
            }

            $user = null;
            while($row = mysqli_fetch_array($result))
            {
                $user = new User($row['id'], $row['username']);
                break;
            }

            mysqli_close($connection);
            return $user;
        }
    }

    public function create_user($username, $password)
    {
        $user = null;
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $stmt = $connection->prepare("INSERT INTO computer_shop.user (username, password) VALUES (?, ?)");
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $id = mysqli_insert_id($connection);
            $user = new User($id, $username);
            mysqli_close($connection);
        }

        return $user;
    }

    public function get_product($id)
    {
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $stmt = $connection->prepare("SELECT product.id, product.title, description, price, category.title as category, producer.title as producer
            FROM computer_shop.product inner join computer_shop.category on category.id = product.category_id
            INNER JOIN computer_shop.producer on computer_shop.product.producer_id = computer_shop.producer.id
            WHERE product.id = ?");
            $stmt->bind_param('i', $id);  
            $stmt->execute();
            $result = $stmt->get_result();

            $product = null;
            while($row = mysqli_fetch_array($result))
            {
                $product = new Product($row['id'], $row['title'], $row['description'], $row['category'], $row['price'], $row['producer']);
                $product->images = $this->get_images($product->id);
                break;
            }

            mysqli_close($connection);
            return $product;
        }
    }

    
}
?>