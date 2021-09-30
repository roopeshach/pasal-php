<?php 

if (isset($_GET['uid']) && isset($_GET['pid'])) {
    $conn = mysqli_connect("localhost", "root", "", "pasal");

    $uid = $_GET['uid'];
    $pid = $_GET['pid'];
    $cid = $_GET['cid'];
    $sql1 = "delete from cart where id = '$cid'";
    $result = mysqli_query($conn, $sql1);
    
    $sql = "insert into orders(user_id , product_id , status) values ('$uid', '$pid' , 'Pending')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>window.location = 'cart.php'</script>";
    } else {
        echo "Error";
    }

}
