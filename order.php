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
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = "SELECT * FROM orders WHERE user_id = '$user_id'";
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
                            <td><?php echo $status; ?></td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>


                </table>
                
    </div>
</div>