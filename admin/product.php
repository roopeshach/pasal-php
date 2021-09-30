<?php include  "inc/home_header.php" ?>

<?php
include "inc/conn.php";

if(isset($_POST['submit'])){
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_desc = $_POST['description'];
    $cat_id = $_POST['category_id'];
    $product_img = $_FILES['image']['name'];

    $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }
        $image = htmlspecialchars( basename( $_FILES["image"]["name"]));
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $insert_product = "INSERT INTO product (name,price,description,category_id,image) VALUES ('$product_name','$product_price','$product_desc','$cat_id','$image')";
            $run_product = mysqli_query($conn,$insert_product);

            if($run_product){
                echo "<script>alert('Product has been inserted')</script>";
            }
            else
            {
                echo "<script>alert('Product has not been inserted')</script>";
            }
        } else {
            echo "Sorry, there was an error.";
        }
        }
           

        }
 //delete product from database
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM product WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed" . mysqli_error($conn));
    }
}


?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="col-md-6">
                <h3>Add Product</h3>
                <form action="product.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="category">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" placeholder="Enter Price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Catgeory</label>
                        <select name="category_id" id="" class="form-control">
                        <option value="">--Select Category --</option>
                        <?php
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $name = $row['name'];
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Image">Insert Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Product">
                    </div>

                </form>
            </div>

            <div class="col-md-6">
            <h3>All Products</h3>
            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $query = "SELECT * FROM product";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $category_id = $row['category_id'];
                    $image = $row['image'];
                    $query1 = "SELECT * FROM category WHERE id = $category_id";
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $category = $row1['name'];
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$name</td>";
                    echo "<td>$description</td>";
                    echo "<td>$price</td>";
                    echo "<td>$category</td>";
                    echo "<td><img src='../images/$image' width='100' height='100'></td>";
                    echo "<td><a href='product.php?delete=$id' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<br>
<br>
<br>



<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>