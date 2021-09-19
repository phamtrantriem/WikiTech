<?php include('./header.php')?>
<?php 
    if(isset($_GET['category_name'])) {
        $sql = "insert into category(category_name,category_desc) value ('".$_GET['category_name']."','".$_GET['category_desc']."')";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Create successfully!!');
            window.location.href='category-list.php';
        </script>");
        }
    } 
?>

<div class="col-lg-12" style=" margin-top: 15px">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Category</h4>
            <div class="basic-form">
                <form action="category-create.php" method="get">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: normal;">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="category_name" class="form-control input-rounded" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea type="textarea" name="category_desc" class="form-control" placeholder=""></textarea>
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