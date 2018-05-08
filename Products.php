<?php
require './vendor/autoload.php';
$app = new Slim\App;
//test
$app->get('/api/test', function ($request, $response) {
    return 'hello world';
});
//getAll
$app->get('/api/products', function ($request, $response) {
    header("Content-Type: application/json");
    getProducts();
});
//getByID
$app->get('/api/products/{id}', function ($request, $response, $args) {


    $sql = "SELECT * FROM product where productID =  ('".$args['id']."')";
    
    try {
        $db = getConnection();
        $stmt =$db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($product);
    }catch(PDOException $e){
        echo'{"error":{"text":}'.$e->getMessage().'}';
    }
});

  $app->post('/api/products', function ($request, $response) {
     $productID = $request->getParam('productID') ;
      $title = $request->getParam('title') ;
      $picture = $request->getParam('picture') ;
      $description = $request->getParam('description') ;
      $price = $request->getParam('price') ;
     
try {
    $db = getConnection();
    
    $sql="INSERT INTO product(productID,title,picture,description,price)
    VALUES ('" .$productID."','" .$title."','" .$picture."' ,'" .$description."','" .$price."')";
    $stmt = $db->query($sql);
    $db = null;
    return '{"status" : "success" }';
} catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
}

});
  
 $app->put('/api/products/{id}',function($request, $response, $args) {
    header("Content-Type: application/json");
    
    $productID = $request->getParam('productID') ;
    $title = $request->getParam('title') ;
    $picture = $request->getParam('picture') ;
    $description = $request->getParam('description') ;
    $price = $request->getParam('price') ;
try{
 $db = getConnection();  
 $sql="UPDATE product SET 
    (productID=$productID,
    title=$title,
    picture=$picture,
    description=$description,
    price=$price)
            WHERE productID=('".$args['id']."')" ;
      
      $stmt = $db->query($sql);
      $db = null;
      return '{"status" : "success" }';
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }

        
     
});

//Delete
$app->delete('/api/products/delete/{id}', function($request, $response, $args) {

    $sql = "DELETE FROM product WHERE productID = ('".$args['id']."')";
    
    try {
        $db = getConnection();
        $stmt =$db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"notice": {"text": "Product Deleted"}';
    }catch(PDOException $e){
        echo json_encode($e->getMessage("Product Deleted"));
    }
});





$app->run();


function getProducts() {
    $sql = "SELECT * FROM product";
      try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($products);
      }
      catch(PDOException $e) {
        echo json_encode($e->getMessage());
      }
    }
 function addProducts(){
        $db = getConnection();
		if(isset($_POST['productID'])){
			$productID = $_POST['productID'];
            $title= '';
            $picture = '';
            $description ='';
            $price ='';
			if(isset($_POST['title'])){
				$title = $_POST['title'];
			}
			if(isset($_POST['picture'])){
				$picture = $_POST['picture'];
            }
            if(isset($_POST['description'])){
				$description = $_POST['description'];
            }
            if(isset($_POST['price'])){
				$price = $_POST['price'];
			}
            $query="INSERT INTO product(productID,title,picture,description,price) 
                    values ('" . $name ."','". $title ."','" . $picture ."','". $description ."',,'". $price ."')";
            //$dbcontroller = new DBController();
            
			$result = $db->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
    
function getConnection() {
    $dbhost="db4free.net";
    $dbuser="product_api";
    $dbpass="123456789Product";
    $dbname="product_api";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}
?>