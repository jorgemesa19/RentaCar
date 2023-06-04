<?php 
if(isset($_POST['add-rental'])){
    
    $rental_id= null;
    $rental_date= $_POST['rental_date'];
    $rental_time= $_POST['rental_time'];
    $return_date= $_POST['return_date'];
    $car_id= $_POST['car_id'];
    $customer_id= $_POST['customer_id'];
    $rental_status= $_POST['rental_status'];
    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT owner_id FROM tblcar WHERE car_id = $car_id";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($owner_id);
    $qry->store_result();
    $qry->fetch();
    
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="INSERT INTO tblrental VALUES (?,?,?,?,?,?,?,?)";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssssss", $rental_id, $rental_date, $rental_time, $return_date, $owner_id, $car_id, $customer_id, $rental_status);
    if ($qry->execute()){
        
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblcar SET status = 0 WHERE car_id = $car_id";
        $qry=$cn->prepare($sql);
        $qry->execute();
        
        echo "<script>window.location.href = 'rental.php?status=success';</script>";        
    }
    else {
        echo "<script>window.location.href = 'rental.php?status=failed';</script>";
    } 
    
}

if(isset($_POST['delete-rental'])){
    
    $rental_id= $_POST['rental_id'];
         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblrental WHERE rental_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $rental_id);
        if ($qry->execute()){
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT COUNT(payment_id) FROM tblpayment WHERE rental_id = $rental_id";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($ct_payment_id);
            $qry->store_result();
            $qry->fetch();
            if ($ct_payment_id == 1){
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT proof_of_payment FROM tblpayment WHERE rental_id = $rental_id";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($proof_of_payment);
                $qry->store_result();
                $qry->fetch();
                
                if ($proof_of_payment != 'img-default.jpg'){
                //delete old proof_of_payment
                unlink("../uploads/$proof_of_payment");
                }
                
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="DELETE FROM tblpayment WHERE rental_id=?";
                $qry=$cn->prepare($sql);
                $qry->bind_param("s", $rental_id);
                $qry->execute();
                
                echo "<script>window.location.href = 'rental.php?status=success';</script>"; 
            }         
        }
        else {
            echo "<script>window.location.href = 'rental.php?status=failed';</script>";
        }     
}

?>