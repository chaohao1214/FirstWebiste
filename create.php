<?php
// Include productDAO file and product.php
require_once('./dao/productDAO.php');
require_once('./dao/product.php');
 
// Define variables and initialize with empty values
$name = $desc = $price= $img = "";
$name_err = $desc_err = $price_err= $img_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate description
    $input_desc = trim($_POST["desc"]);
    if(empty($input_desc)){
        $desc_err = "Please enter a description.";     
    } else{
        $desc = $input_desc;
    }
    
    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
          
        $price_err = "Please enter the price.";  
    } elseif(!ctype_digit($input_price)){
        
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }
    
    $types = ['image/jpeg','image/png'];
    if(isset($_FILES['image'])){
        if (!$_FILES['image']['error']){
            if (in_array($_FILES['image']['type'],$types)){
                if ($_FILES['image']['size']<8000000){
                    $img = "./Asset/Product/".$_FILES['image']['name'];
                    //echo($img);
                    move_uploaded_file($_FILES['image']['tmp_name'],$img);
                }else{
                    $img_err = "Size exceeded";
                }
            }else{
                $img_err = "Invalid file type";
            }
        }
        else{
            $img_err = "An error occured when upload";
        }
    } else{
        $img_err = "Please upload a pic";
    }
    // Check input errors before inserting in database

    if(empty($name_err) && empty($desc_err) && empty($price_err) && empty($img_err)){
        $productDAO = new productDAO();    
        $product = new product(0, $name, $desc, $price,$_FILES['image']['name']);
        
       
		$addResult = $productDAO->addProduct($product);
        echo '<br><h6 style="text-align:center">' . $addResult . '</h6>';   
         
        // Close connection
        $productDAO->getMysqli()->close();
        }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add New Product</h2>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>"><?php echo $desc; ?></textarea>
                            <span class="invalid-feedback"><?php echo $desc_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $img; ?>">
                            <span class="invalid-feedback"><?php echo $img_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="addnew.php" class="btn btn-secondary ml-2">Cancel</a>
                        <a href="home.html" class="btn btn-primary" value="home">Home</a>
                    </form>
                </div>
            </div>        
        </div>
        
    </div>
</body>
</html>