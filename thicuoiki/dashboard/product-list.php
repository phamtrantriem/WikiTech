<?php include('./header.php')?>
   <div class="row" style="margin-top: 15px">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Table</h4>
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle" id="product_table">
                            <thead>
                                <tr>
                                    <th style="width: 10%" scope="col">#</th>
                                    <th style="width: 25%" scope="col">Product name</th>
                                    <th style="width: 35%" scope="col-5">Description</th>
                                    <th style="width: 15%" scope="col">Category</th>
                                    <th style="width: 10%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql_product = "Select * from product";
                                    $result_product = mysqli_query($conn, $sql_product);
                                    echo "</br>";
                                    if (mysqli_num_rows($result_product) > 0) {
                                        while($row_product = mysqli_fetch_assoc($result_product)) {
                                ?>  
                                <tr id="product_<?php echo $row_product['product_id']?>">
                                    <th><?php echo $row_product['product_id']?></th>
                                    <td data-toggle="popover-hover" data-img="">
                                        <span><?php echo $row_product['product_name']?></span>
                                    </td>
                                    <td>
                                        <?php echo $row_product['product_desc']?>
                                    </td>
                                    <td>
                                        <?php 
                                            $sql_cate = "Select * from category where category_id = ".$row_product['category_id'];
                                            $result_cate = mysqli_query($conn, $sql_cate);
                                            if (mysqli_num_rows($result_cate) > 0) {
                                                while($row_cate = mysqli_fetch_assoc($result_cate)) {
                                                    echo $row_cate['category_name'];  
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="product-edit.php?product_id=<?php echo $row_product['product_id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                            <a onclick="ConfirmDelete(<?php echo $row_product['product_id'] ?>)" href="#" name="deleting-product" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                <?php       
                                        }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-lg-1"></div>
<script type="text/javascript">
    function ConfirmDelete(product_id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xoá?',
            text: "Bạn sẽ không thể hoàn tác hành động này.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"delete.php?product_id="+product_id,
                    method:"GET",
                    success:function(data){ 
                        Swal.fire({
                          icon: 'success',
                          title: data,
                          timer: 1500
                        })
                        $('#product_'+product_id).remove();
                    },
                    error: function (jqXHR, exception) {
                        if(jqXHR.status==401) {
                            Swal.fire({
                              icon: 'error',
                              title: jqXHR.status+": "+jqXHR.responseText,
                              timer: 1500
                            })
                        }
                    }
                 });
                
            }
        });
    }
</script>
<?php include('./footer.php')?>