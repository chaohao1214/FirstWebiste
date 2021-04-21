<?php
require_once('abstractDAO.php');

class productDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }  
    
    public function getProduct($productId){
        $query = 'SELECT * FROM products WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $product = $temp;
            $result->free();
            return $product;
        }
        $result->free();
        return false;
    }


    public function getProducts($keyword){
        //The query method returns a mysqli_result object
//        $result = $this->mysqli->query("SELECT * FROM products where name like '%$keyword%'; ");
        $query = "SELECT * FROM products where name like '%$keyword%'; ";
        $stmt = $this->mysqli->prepare($query);
//        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                $products[] = $row;
            }
            $result->free();
            return $products;
        }
        $result->free();
        return false;
    }   
    public function addProduct($product){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
			$query = 'INSERT INTO products (name, `desc`, price, img) VALUES (?,?,?,?)';
			
			
			$stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $name = $product->getName();
			        $desc = $product->getDesc();
			        $price = $product->getPrice();
			        $img = $product->getImg();
                  
			        $stmt->bind_param('ssds', 
				        $name,
				        $desc,
				        $price,
                        $img
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $product->getName() . ' added successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }     

}
?>

