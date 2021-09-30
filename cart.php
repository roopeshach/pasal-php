<?php include "inc/home_header.php"; ?>


<?php 
$conn = mysqli_connect('localhost', 'root', '', 'pasal');
session_start();
// get user id from session variable email
$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];
if (isset($_GET['uid']) && isset($_GET['pid'])){
    $user_id = $_GET['uid'];
    $product_id = $_GET['pid'];

    $sql = "insert into cart(user_id , p_id) values ('$user_id', '$product_id')";
    $result = mysqli_query($conn, $sql);
    if ($result){
        echo "<script>window.location = 'cart.php'</script>";
    }

}

//delete cart
if (isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $del_query = "delete from cart where id = '$del_id'";
    $del_result = mysqli_query($conn, $del_query);
    if ($del_result){
        echo "<script>window.location = 'cart.php'</script>";
    }
}


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>S.N</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Checkout</th>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "select * from cart where user_id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $i = 1;
                    $total_price = 0;
                    while ($row = mysqli_fetch_assoc($result)){
                        $product_id = $row['p_id'];
                        $sql = "select * from product where id = '$product_id'";
                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row2['name']; ?></td>
                            <td><?php echo $row2['price']; ?></td>
                            <td>
                                <a href="cart.php?delete=<?php echo $row['cart_id']; ?>"><button class="btn btn-danger">Delete</button></a>
                            </td>
                            <!-- checkout -->
                            <td>
                                <a href="checkout.php?uid=<?php echo $user_id; ?>&pid=<?php echo $product_id; ?>&cid=<?php echo $row['id']?>"><button class="btn btn-success">Checkout</button></a>
                            </td>
                        </tr>
                        

                        <?php
                        $i++;
                    }
                    ?>
                    <!-- checkout button with total -->
                    <tr>
                        <td colspan="2" align="right">Total</td>
                        <td>
                            <?php
                            $sql = "select * from cart where user_id = '$user_id'";
                            $result = mysqli_query($conn, $sql);
                            $total_price = 0;
                            while ($row = mysqli_fetch_assoc($result)){
                                $product_id = $row['p_id'];
                                $sql = "select * from product where id = '$product_id'";
                                $result2 = mysqli_query($conn, $sql);
                                $row2 = mysqli_fetch_assoc($result2);
                                $total_price += $row2['price'];
                            }
                            echo $total_price;
                            ?>
                        </td>
                    </tr>
                   
                    
                </tbody>

            </table>
        </div>
    </div>
</div>