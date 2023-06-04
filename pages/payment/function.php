<?php 
if(isset($_POST['add-payment'])){
    
    $temp = explode(".", $_FILES["proof_of_payment"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["proof_of_payment"]["name"]);
    
    if (move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_payment"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $payment_id= null;
        $rental_id= $_POST['rental_id'];
        $payment_amount= $_POST['payment_amount'];
        $add_charges= $_POST['add_charges'];
        $payment_date= $_POST['payment_date'];
        $proof_of_payment= $newfilename;
        $customer_id= $_POST['customer_id'];

        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblpayment VALUES (?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("sssssss", $payment_id, $rental_id, $payment_amount, $add_charges, $payment_date, $proof_of_payment, $customer_id);
        if ($qry->execute()){
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT car_id FROM tblrental WHERE rental_id = ?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("s", $rental_id);
            $qry->execute();
            $qry->bind_result($car_id);
            $qry->store_result();
            $qry->fetch();
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="UPDATE tblcar SET status = 1 WHERE car_id = $car_id";
            $qry=$cn->prepare($sql);
            $qry->execute();
            
            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=success';</script>";        
        }
        else {
            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed';</script>";
        } 
        
    } else {
        echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed-upload';</script>";
    }
}
if(isset($_POST['delete-payment'])){
    
    $payment_id= $_POST['payment_id'];
    $rental_id= $_POST['rental_id'];
         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblpayment WHERE payment_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $payment_id);
        if ($qry->execute()){
            
            $old_proof_of_payment = $_POST ['old_proof_of_payment'];
            if ($old_proof_of_payment != 'img-default.jpg'){
                //delete old proof_of_ownership
                unlink("../uploads/$old_proof_of_payment");
            }
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT car_id FROM tblrental WHERE rental_id = ?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("s", $rental_id);
            $qry->execute();
            $qry->bind_result($car_id);
            $qry->store_result();
            $qry->fetch();
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="UPDATE tblcar SET status = 0 WHERE car_id = $car_id";
            $qry=$cn->prepare($sql);
            $qry->execute();
            
//            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=success';</script>";            
        }
        else {
//            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed';</script>";
        }     
}
?>