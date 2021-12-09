<?php
class Context
{
    private $mysql_login = "root";
    private $mysql_password = "";
    private $mysql_adress = "127.0.0.1:3306";
    private $mysql_db = "energos";

    private function create_connection()
    {
        return mysqli_connect($this->mysql_adress, $this->mysql_login, $this->mysql_password, $this->mysql_db);
    }

    private function set_charset($connection)
    {
        mysqli_set_charset($connection, "utf8");
    }

    /*public function get_products()
    {
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $sql = "SELECT product.id, product.title, description, price, category.title as category FROM computer_shop.product inner join computer_shop.category on category.id = product.category_id";
            $result = mysqli_query($connection, $sql);
            $resultArray = array();
            while($row = mysqli_fetch_array($result))
            {
                $product = new Product($row['id'], $row['title'], $row['description'], $row['category'], $row['price']);
                array_push($resultArray, $product);
            }

            mysqli_close($connection);
            return $resultArray;
        }
    }*/

    public function get_categories(){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $sql = "SELECT id, title FROM computer_shop.category";
            $result = mysqli_query($connection, $sql);
            $resultArray = array();
            while($row = mysqli_fetch_array($result))
            {
                $product = new Category($row['id'], $row['title']);
                array_push($resultArray, $product);
            }

            mysqli_close($connection);
            return $resultArray;
        }
    }

    public function get_producers(){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $sql = "SELECT id, title FROM computer_shop.producer";
            $result = mysqli_query($connection, $sql);
            $resultArray = array();
            while($row = mysqli_fetch_array($result))
            {
                $product = new Category($row['id'], $row['title']);
                array_push($resultArray, $product);
            }

            mysqli_close($connection);
            return $resultArray;
        }
    }

    public function get_items(){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $sql = "SELECT id, title, image, type, description, price
            FROM items";

            $result = mysqli_query($connection, $sql);
            $resultArray = array();
            while($row = mysqli_fetch_array($result))
            {
                $item = new Item($row['id'], $row['title'], $row['image'], $row['type'], $row['description'], $row['price']);
                array_push($resultArray, $item);
            }
            mysqli_close($connection);
            return $resultArray;
        }
    }

    public function get_filtered_products($predicate){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $sql = "SELECT product.id, product.title, description, price, category.title as category, producer.title as producer
            FROM computer_shop.product inner join computer_shop.category on category.id = product.category_id
            INNER JOIN computer_shop.producer on computer_shop.product.producer_id = computer_shop.producer.id";
            
            $sql = $sql.$predicate;
            echo $sql;
            $result = mysqli_query($connection, $sql);
            $resultArray = array();
            while($row = mysqli_fetch_array($result))
            {
                $product = new Product($row['id'], $row['title'], $row['description'], $row['category'], $row['price'], $row['producer']);
                $product->images = $this->get_images($product->id);
                array_push($resultArray, $product);
            }

            mysqli_close($connection);
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

    function get_images($id){
        $connection = $this->create_connection();
        if($connection)
        {
            $this->set_charset($connection);
            $stmt = $connection->prepare("SELECT data as image 
            FROM product_image inner join product on product.id = product_image.product_id 
            inner join image on image.id = product_image.image_id 
            where product.id = ?");
            $stmt->bind_param('i', $id);  
            $stmt->execute();
            $result = $stmt->get_result();
            $imagesArray = array();
            while($row = mysqli_fetch_array($result))
            {
                array_push($imagesArray, $row['image']);
            }

            mysqli_close($connection);
            return $imagesArray;
        }
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