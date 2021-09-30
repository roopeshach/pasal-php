<?php
include "inc/home_header.php";
$conn = mysqli_connect("localhost", "root", "", "pasal");
session_start();
// get user id from session variable email
$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

//delete order
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $sql = "DELETE FROM orders WHERE id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Order deleted successfully')</script>";
        echo "<script>window.open('order.php', '_self')</script>";
    }
}

//deliver order 
if (isset($_GET['deliver'])) {
    $order_id = $_GET['deliver'];
    $sql = "UPDATE orders SET status = 'Delivered' WHERE id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Order delivered successfully')</script>";
        echo "<script>window.open('order.php', '_self')</script>";
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Delete</th>
                        <th>Deliver</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = "SELECT * FROM orders ";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $order_id = $row['id'];
                        $product_id = $row['product_id'];
                        $status = $row['status'];
                        $date = $row['date_added'];
                        $query1 = "SELECT * FROM product WHERE id = '$product_id'";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $product_name = $row1['name'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $product_name; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $date; ?></td>
                            <td>
                                <a href="order.php?delete=<?php echo $order_id; ?>" class="btn btn-danger">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                            <td>
                                <!-- check status and add button -->
                                <?php

                                if ($status == 'Pending') {
                                    echo "<a href='order.php?deliver=$order_id' class='btn btn-success'>
                                    <button class='btn btn-success'>Deliver</button>
                                </a>";
                                } else {
                                    echo "<button class='btn btn-success'>Delivered</button>";
                                }
                                ?>
                            </td>
                        </tr>
                                
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>


                </table>
                
    </div>
</div>