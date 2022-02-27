<?php 
	session_start();
	// session_destroy();
	include('function.php');
	//include('cart.php');

	$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();

	if(isset($_POST['listid'])){

		// echo $arr ;
		$id = $_POST['listid'];
		$product = getproduct($id,$arr);
		
		
		
		// $cart = array();
		//$_SESSION['cart'];
		//$quant = 0 ;
		// var_dump(sizeof($cart));
		if(sizeof($cart) == 0){
			$product['quantity'] = 1 ;
			array_push($cart, $product);
			// echo "if one";
		}else{
			
			if(checkIfProductExists($id)){
				//$quant += 1 ;
				//$product['quantity'] += 1 ;
				foreach($cart as $key => $val){
					if($val['id'] == $product['id']){
						$cart[$key]['quantity'] += 1; 
					}				
				}
			//    $_SESSION['cart'];
			//    print_r($_SESSION['cart']) ;
			}else{
				$product['quantity'] = 1 ;
				array_push($cart, $product);
			}
		}


		

		// print_r($_POST['pro_id']);
		
	
			$_SESSION['cart'] = $cart;
		
	}
	// if(isset($_POST['action'])){
	// 	// $cart = $_SESSION['cart'];
	// 	foreach($cart as $key => $val){
	// 		if($val['id'] == $_POST['pro_id']){
	// 			$_SESSION['cart'][$key]['quantity'] += $_POST['input'];
	// 		}
	// 	}
		 
	// }
	

// echo '<pre>';
// print_r($_SESSION['cart']) ;
// echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div id="header">
		<h1 id="logo">Logo</h1>
		<nav>
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
	<div id="main">
		<div id="products">
			<?php echo display($arr); ?>
		</div>
	</div>
	<div class="table">
	<?php 
			echo display_cart($arr) ;
			
			
			?>
	</div>
	<div id="footer">
		<nav>
			<ul id="footer-links">
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Declaimers</a></li>
			</ul>
		</nav>
	</div>
</body>
</html>