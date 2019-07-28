<?php 

include 'connection.php';

$act = $_GET['act'];

if($act == "login"){
    // $username = $_GET['username'];
    // $pin = $_GET['pin'];
    $username = $_POST['username'];
    $pin = $_POST['pin'];
    
    if((!is_null($username)) && (!is_null($pin))){

    $response = array();
	$resultEmployee = array();	
	$qEmployee = mysqli_query($con, "SELECT * FROM employees where name = '$username' and password = '$pin'");
		if(mysqli_num_rows($qEmployee) > 0){
			while ($Employee = mysqli_fetch_assoc($qEmployee)){
				$resultEmployee[] = $Employee;
				$response['success'] = "true";
				$response['result'] = $resultEmployee;
			}
		}
		else{
			$response['success'] = "false";
		}
	}
	echo json_encode($response);
}

if($act == "selectProduct"){
    $outlet_id = $_POST['outlet_id'];
    
    if(!is_null($outlet_id)){

    $response = array();
	$resultProducts = array();	
	$qProducts = mysqli_query($con, "SELECT * FROM products where outlet_id = '$outlet_id'");
		if(mysqli_num_rows($qProducts) > 0){
			while ($Products = mysqli_fetch_assoc($qProducts)){
				$resultProducts[] = $Products;
				$response['success'] = "true";
				$response['result'] = $resultProducts;
			}
		}
		else{
			$response['success'] = "false";
		}
	}
	echo json_encode($response);
}

if($act == "selectOutlet"){
    $outlet_id = $_POST['outlet_id'];
    
    if(!is_null($outlet_id)){

    $response = array();
	$resultProducts = array();	
	$qProducts = mysqli_query($con, "SELECT * FROM outlets where id = '$outlet_id'");
		if(mysqli_num_rows($qProducts) > 0){
			while ($Products = mysqli_fetch_assoc($qProducts)){
				$resultProducts[] = $Products;
				$response['success'] = "true";
				$response['result'] = $resultProducts;
			}
		}
		else{
			$response['success'] = "false: "."SELECT * FROM outlets where id = '$outlet_id'";
		}
	}
	echo json_encode($response);
}

if($act == "updateOrder"){
	$order_id = $_POST['order_id'];
    $outlet_id = $_POST['outlet_id'];
    $employee_id = $_POST['employee_id'];
    $total = $_POST['total'];
    
    if(!is_null($outlet_id)){

    $response = array();
	$resultProducts = array();	
	// echo "INSERT INTO orders SET  order_id = '$order_id', outlet_id = '$outlet_id', employee_id = '$employee_id', total = '$total'";
	$qProducts = mysqli_query($con, "INSERT INTO orders SET no_struk = '$order_id', outlet_id = '$outlet_id', employee_id = '$employee_id', total = '$total'");
		if($qProducts){
			$response['success'] = "true";
		}
		else{
			$response['success'] = "false";
		}
	}
	echo json_encode($response);
}

// if($act == "updateOrderDtl"){
// 	$no_struk = $_POST['no_struk'];
//     $product_id = $_POST['product_id'];
//     $qty = $_POST['qty'];
//     $price = $_POST['price'];
    
//     if(!is_null($no_struk	)){

//     $response = array();
// 	$resultProducts = array();	
// 	// echo "INSERT INTO orders SET  order_id = '$order_id', outlet_id = '$outlet_id', employee_id = '$employee_id', total = '$total'";
// 	$qProducts = mysqli_query($con, "INSERT INTO order_details SET no_struk = '$no_struk', product_id = '$product_id', qty = '$qty', price = '$price'");
// 		if($qProducts){
// 			$response['success'] = "true";
// 		}
// 		else{
// 			$response['success'] = "false: "."INSERT INTO order_details SET no_struk = '$no_struk', product_id = '$product_id', qty = '$qty', price = '$price'";
// 		}
// 	}
// 	echo json_encode($response);
// }

if($act == "updateOrderDtl"){
	$no_struk = $_POST['no_struk'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $hpp = $_POST['hpp'];
    $outlet_id = "";
    
    if(!is_null($no_struk)){

    	$qSelectHpp = mysqli_query($con, "SELECT * FROM products where id = '$product_id'");
    		while ($selectHpp = mysqli_fetch_array($qSelectHpp)){
    			$hpp = $selectHpp['hpp'];
    			$outlet_id = $selectHpp['outlet_id'];
        }
    $hpp2 = $hpp * $qty;
    $profit = $price - $hpp2;
    

    $response = array();
	$resultProducts = array();	
	// echo "INSERT INTO orders SET  order_id = '$order_id', outlet_id = '$outlet_id', employee_id = '$employee_id', total = '$total'";
	$qProducts = mysqli_query($con, "INSERT INTO order_details SET no_struk = '$no_struk', product_id = '$product_id', qty = '$qty', price = '$price',
	hpp = '$hpp2', profit = '$profit', outlet_id = '$outlet_id'");
		if($qProducts){
			$response['success'] = "true";
		}
		else{
			$response['success'] = "false: "."INSERT INTO order_details SET no_struk = '$no_struk', product_id = '$product_id', qty = '$qty', price = '$price', hpp = '$hpp2', profit = '$profit'";
		}
	}
	echo json_encode($response);
}


?>