<?php include('./header.php')?>
<?php 
    if(isset($_POST['product_name'])) {
        $target_dir = "../img/products/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo "file".$target_file;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $category_id = $_POST['category_id'];        
        
        $sql = "insert into product(product_name,product_desc,category_id,product_image) value ('".$product_name."','".$product_desc."','".$category_id."','".$target_file."')";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Create successfully!!');
            window.location.href='product-list.php';
        </script>");
        }
    } 
?>

<div class="col-lg-12" style=" margin-top: 15px">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Product</h4>
            <div class="basic-form">
                <form action="product-create.php" enctype="multipart/form-data" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: normal;">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_name" class="form-control input-rounded" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea type="textarea" id="product_desc" name="product_desc" class="form-control" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id">
                                <option value="" disabled selected>Choose</option>
                                    <?php 
                                        $sql_cate = "Select * from category";
                                        $result_cate = mysqli_query($conn, $sql_cate);
                                        if (mysqli_num_rows($result_cate) > 0) {
                                            while($row_cate = mysqli_fetch_assoc($result_cate)) {
                                    ?>  
                                <option value="<?php echo $row_cate["category_id"] ?>"><?php echo $row_cate["category_name"] ?></option>
                                    <?php   
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label">Image</div>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="fileToUpload">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#product_table').DataTable();
    } );
</script>
<?php include('./footer.php')?>