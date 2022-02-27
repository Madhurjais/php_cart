<?php 
session_start();

$arr = array(array('id'=>'101','img'=>'football.png','price'=>'150.00','name'=>'foot ball'),
array('id'=>'102','img'=>'tennis.png','price'=>'120.00','name'=>'tennis'),
array('id'=>'103','img'=>'basketball.png','price'=>'90.00','name'=>'Basket ball'),
array('id'=>'104','img'=>'table-tennis.png','price'=>'110.00','name'=>'table tannis'),
array('id'=>'105','img'=>'soccer.png','price'=>'80.00','name'=>'soccar'));



function display($arr){
     $html = '<div id = "display">';
     foreach($arr as $key => $val){
           $html .= '<form action="" method="POST"><input type="hidden" name="listid" value = "'.$val['id'].'" >
           <img src="images/'.$val['img'].'">
           <h3>'.$val['name'].'</h3><span> Price :'.$val['price'].' </span>
           <input type="submit" value="add" name="action" id = "addbtn">
           </form>';
     }
     $html .= "</div>";
     return $html ;
}
function getproduct($id,$arr){
    foreach($arr as $key => $val){
            if($val['id'] == $id){
                return $val ;
            }
    }
}

function checkIfProductExists($id){
    $cart = $_SESSION['cart'];

    foreach($cart as $key => $val){
        if($val['id'] == $id){
            return true ;
        }
    }

    return false;
}
function display_cart(){
	$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
    $total = 0 ;
    $tab = "<table><button class = 'clear_cart' name = 'clearcart'>X</button>
    <tr><th>ID</th><th>NAME</th>
    <th>PRICE</th><th>QUANTITY</th><th>QUANTITY update</th></tr>";
    foreach($cart as $key => $val){
        $tab .= "<form method = 'POST' action = ''><tr><td>".$val['id']."</td>
        <td>".$val['name']."</td>
        <td>".$val['price']."</td>
        <td>".$val['quantity']."</td>
        <td>
        <input type = 'number'  name = 'input'>
        <button  name = 'action' >update</button>
       </td>
        <td>
        <button  name = 'delete' >remove</button>
        <input type='hidden' name ='pro' value = '".$val['id']."' >
        </td></tr></form>";
        $total += (int)$val['price']*(int)$val["quantity"] ;
        // echo $val['price'];
    } 
     $tab .= "<tr><td colspan = '4'>total price : ".$total."</td></tr></table>";
     return $tab ;
}
if(isset($_POST['action'])){
    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
    $id = $_POST['pro'];
    foreach($cart as $key => $val){
        if($val['id'] == $id){
            $_SESSION['cart'][$key]['quantity'] += $_POST['input'];
        }
    }
     
}
if(isset($_POST['delete'])){
    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
    $id = $_POST['pro'];
    foreach($cart as $key => $val){
        if($val['id'] == $id){
            array_splice($_SESSION['cart'],$key,1);
        }
    }
     
}
if(isset($_POST['clearcart'])){
    // $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
   $_SESSION['cart'] = array();   
}

?>
