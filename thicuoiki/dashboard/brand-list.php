<?php include('./header.php')?>
   <div class="row" style="margin-top: 15px">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Brand Table</h4>
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%" scope="col">#</th>
                                    <th style="width: 25%" scope="col">Brand name</th>
                                    <th style="width: 35%" scope="col-5">Description</th>
                                    <th style="width: 15%" scope="col">Number of Product</th>
                                    <th style="width: 10%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql_brand = "Select * from brand";
                                    $result_brand = mysqli_query($conn, $sql_brand);
                                    echo "</br>";
                                    if (mysqli_num_rows($result_brand) > 0) {
                                        while($row_brand = mysqli_fetch_assoc($result_brand)) {
                                ?>  
                                <tr id="brand_<?php echo $row_brand['brand_id']?>">
                                    <th><?php echo $row_brand['brand_id']?></th>
                                    <td data-toggle="popover-hover" data-img="">
                                        <span><?php echo $row_brand['brand_name']?></span>
                                    </td>
                                    <td>
                                        <?php echo $row_brand['brand_desc']?>
                                    </td>
                                    <td>
                                        <span class="label gradient-1 btn-rounded">900</span>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                            <a onclick="ConfirmDelete(<?php echo $row_brand['brand_id']?>)" href="#" name="deleting-brand" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
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
        function ConfirmDelete(brand_id) {
            Swal.fire({
                title: 'Are you sure to delete?',
                text: "You can't redoing this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"delete.php?brand_id="+brand_id,
                        method:"GET",
                        success:function(data){ 
                            Swal.fire({
                              icon: 'success',
                              title: data,
                              timer: 1500
                            })
                            $('#brand_'+brand_id).remove();
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