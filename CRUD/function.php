<?php 
$con=new mysqli('localhost','root','','db_6_7_crud');
// if($con){
//     echo 'Hello';
// }
    if(isset($_POST['btnSave'])){
        function insertProduct(){
            $name=$_POST['name'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $thumbnail=rand(1,10000).'_'.$_FILES['thumbnail']['name'];
            $tmp_name=$_FILES['thumbnail']['tmp_name'];
            $path='./Image/'.$thumbnail;
            move_uploaded_file($tmp_name,$path);
            $total=round($price*$qty,2);
            $discount='';
            if($total>=1 && $total <=10){
                $discount=5;
            }else if($total>10 && $total <=20){
                $discount=10;
            }else if($total>20 && $total <=30){
                $discount=12;
            }else if($total>30 && $total <=40){
                $discount=15;
            }else{
                $discount=20;
            }
            $payment=round($total-($total*$discount)/100,2);
            global $con;
            $sql="INSERT INTO `products`(`name`, `price`, `qty`, `total`, `discount`, `payment`, `thumbnail`) 
            VALUES ('$name','$price','$qty','$total','$discount','$payment','$thumbnail')";
            $con->query($sql);
        }
        insertProduct();
    }
    function selectProduct(){
        global $con;
        $sql="SELECT * FROM `products`";
        $data=$con->query($sql);
        while($row=$data->fetch_assoc()){
            echo '<tr>
                    <td>'.$row['proID'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['total'].'$</td>
                    <td>'.$row['discount'].'%</td>
                    <td>'.$row['payment'].'$</td>
                    <td>
                        <img width="100px" src="./Image/'.$row['thumbnail'].'" alt="">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success" id="btnEdit">Edit</button>
                        <button  type="submit" class="btn btn-danger openDelete" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                    </td>
                </tr>';
        }
    }
    if(isset($_POST['btnDelete'])){
        function deleteProduct(){
            $id=$_POST['id'];
            global $con;
            $sql="DELETE FROM `products` WHERE `proID`=$id";
            $con->query($sql);
        }
        deleteProduct();
    }
    if(isset($_POST['btnEdit'])){
        date_default_timezone_set('Asia/Phnom_Penh');
        global $con;
        $hide_id=$_POST['hide_id'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $qty=$_POST['qty'];
        $hide_image=$_POST['hide_image'];
        $thumbnail=$_FILES['thumbnail']['name'];
        $update_pro=date('YmdHis');
        $total=round($price*$qty,2);
            $discount='';
            if($total>=1 && $total <=10){
                $discount=5;
            }else if($total>10 && $total <=20){
                $discount=10;
            }else if($total>20 && $total <=30){
                $discount=12;
            }else if($total>30 && $total <=40){
                $discount=15;
            }else{
                $discount=20;
            }
            $payment=round($total-($total*$discount)/100,2);
            if(!empty($thumbnail)){
                $thumbnail=rand(1,1000).'_'.$thumbnail;
                $tmp_name=$_FILES['thumbnail']['tmp_name'];
                $path='./Image/'.$thumbnail;
                move_uploaded_file($tmp_name,$path);
                echo 'thumbnail';
            }else{
                $thumbnail=$hide_image;
            }
            $sql="UPDATE `products` SET `name`='$name',`price`='$price',`qty`='$qty',`total`='$total',
            `discount`='$discount',`payment`='$payment',`thumbnail`='$thumbnail',`update_at`='$update_pro' WHERE `proID`=$hide_id";
            $con->query($sql);
             
    }

?>