<?php include('./header.php')?>
<?php 
    if(isset($_POST['brand_name'])) {
        $target_dir = "images/brand/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo "file".$target_file;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $brand_name = $_POST['brand_name'];
        $brand_desc = $_POST['brand_desc'];
        echo "<script>console.log('Debug Objects: " . $brand_name . " : ".$brand_desc."' );</script>";
        $sql = "insert into brand(brand_name,brand_desc,brand_image) value ('".$brand_name."','".$brand_desc."','".$target_file."')";
        echo "<script>console.log('Debug Objects: " . $sql . "' );</script>";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Create successfully!!');
            window.location.href='brand-list.php';
        </script>");
        }
    } 
?>

<div class="col-lg-12" style=" margin-top: 15px">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Brand</h4>
            <div class="basic-form">
                <form action="brand-create.php" enctype="multipart/form-data"  method="post">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"  style="white-space: normal;">Brand Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="brand_name" class="form-control input-rounded" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea type="textarea" name="brand_desc" class="form-control" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="fileToUpload"class="form-control">     
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
<?php include('./footer.php')?>