<?php 
if(isset($_POST['add-carreview'])){
    
    $review_id= null;
    $review = $_POST['review'];
    $review_score = $_POST['review_score'];
    $date = date('Y-m-d');
    $customer_id = $_POST['customer_id'];
    $car_id = $_GET['car_id'];
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="INSERT INTO tblcarreview VALUES (?,?,?,?,?,?)";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssss", $review_id, $review, $review_score, $date, $customer_id, $car_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";        
    }
    else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    } 
    
}
if(isset($_POST['edit-carreview'])){
    
    $review_id= $_POST['review_id'];
    $review= $_POST['review'];
    $review_score= $_POST['review_score'];
    $customer_id= $_POST['customer_id'];
            
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tblcarreview SET review = ?, review_score = ?, customer_id = ? WHERE review_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssss", $review, $review_score, $customer_id, $review_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    }
}
if(isset($_POST['delete-carreview'])){
    
    $review_id= $_POST['review_id'];

    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="DELETE FROM tblcarreview WHERE review_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $review_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    } 
    
    
}
?>