<?php include  "inc/home_header.php" ?>

<?php
include "inc/conn.php";

if(isset($_POST['submit'])){
    $cat_title = $_POST['category'];
    if($cat_title == "" || empty($cat_title)){
        echo "This field should not be empty";
    }else{
        $query = "INSERT INTO category(name) VALUES('$cat_title')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query Failed" . mysqli_error($conn));
        }
    }

}
 //delete category row from database
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM category WHERE id = {$id}";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed" . mysqli_error($conn));
    }
    header("Location: category.php");
}


?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>
                    Add Category
                </h3>
                <form action="category.php" method="post">
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$name</td>";
                    echo "<td><a href='category.php?delete=$id'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>