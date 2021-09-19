<?php include('./header.php')?>
<?php 

    if(isset($_POST['product_name'])) {

        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $category_id = $_POST['category_id'];

        $target_dir = "../img/products/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo "file".$target_file;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "update product set product_name = '".$product_name."',product_desc = '".$product_desc."',category_id = '".$category_id."', product_image = '".$target_file."' where product_id = ".$_GET['product_id'];
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Edit successfully!!');
            window.location.href='product-list.php';
        </script>");
        }
    } 
?>
<?php
    $sql = "select * from product where product_id =".$_GET['product_id'];
    $ketqua = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($ketqua);
?>
<div class="col-lg-12" style=" margin-top: 15px">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Product</h4>
            <div class="basic-form">
                <form action="product-edit.php?product_id=<?php echo $row['product_id']?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: normal;">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_name" class="form-control input-rounded" value="<?php echo $row['product_name']?>"  placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="product_desc" id="product_desc" placeholder="Mô tả sản phẩm"><?php echo $row['product_desc']?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id">
                                <?php 
                                    $sql_cate = "Select * from category";
                                    $result_cate = mysqli_query($conn, $sql_cate);
                                    if (mysqli_num_rows($result_cate) > 0) {
                                        while($row_cate = mysqli_fetch_assoc($result_cate)) {
                                            $selected = '';
                                            if($row['category_id'] == $row_cate['category_id']) { 
                                                $selected = 'selected';
                                            }
                                            echo '<option '.$selected.' value="'.$row_cate["category_id"].'">'.$row_cate["category_name"].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label">Image</div>
                        <div class="col-sm-10">
                            <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $row['product_image']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php')?>