<?php
session_start();
 $p_id=(int)$_GET["id"];
  
  $connection_string=mysqli_connect("localhost","root","","e-commerce");
  $result=mysqli_query($connection_string,"select * from products where id='$p_id'" );
  if(($row=mysqli_fetch_assoc($result))){
  
    echo"from database".$row['name'];
    if (isset($_SESSION['cart'][$p_id])&&$_SESSION['cart'][$p_id]!=""){
       $quantity= $_SESSION['cart'][$p_id]["quantity"];
       $price= $row['price'];
       echo"Quantity here".$quantity;
       if($_GET["action"]=="increase"){ 
            $_SESSION['cart'][$p_id]["quantity"]=$quantity+1; 
            $_SESSION['cart'][$p_id]["price"]=$price*($_SESSION['cart'][$p_id]["quantity"]);
           
        }
      
       if($_GET["action"]=="decrease"&& $quantity>1){
        $_SESSION['cart'][$p_id]["quantity"]=$quantity-1; 
        $_SESSION['cart'][$p_id]["price"]=$_SESSION['cart'][$p_id]["price"]-$price;
    
     
       }
       if($_GET["action"]=="delete"){
        unset($_SESSION['cart'][$p_id]);
       
       }
       

    }

    else{
        $new_product_array=
        $_SESSION['cart'][$p_id]=array("id"=>$row['id'],"name"=>$row['name'],"description"=>$row['description'],
                                       "price"=>$row['price'],"quantity"=>1);
        foreach($_SESSION['cart'] as $pro_arr){
            echo " <br>".$pro_arr["name"]." <br>";
 
        }
       
                                        
   
   }
  
  }
  header('location:cart.php');

//  print_r($_SESSION);



    ?>