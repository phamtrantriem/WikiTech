<?php include('./header.php')?>
   <div class="row" style="margin-top: 15px">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">comment Table</h4>
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle" id="comment_table">
                            <thead>
                                <tr>
                                    <th style="width: 10%" scope="col">#</th>
                                    <th style="width: 20%" scope="col">Product</th>
                                    <th style="width: 30%" scope="col-4">Content</th>
                                    <th style="width: 15%" scope="col">User</th>
                                    <th style="width: 10%" scope="col">Reply</th>
                                    <th style="width: 20%" scope="col">Timestamp</th>
                                    <th style="width: 10%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql_comment = "Select * from comment";
                                    $result_comment = mysqli_query($conn, $sql_comment);
                                    echo "</br>";
                                    if (mysqli_num_rows($result_comment) > 0) {
                                        while($row_comment = mysqli_fetch_assoc($result_comment)) {
                                ?>  
                                <tr id="comment_<?php echo $row_comment['comment_id']?>">
                                    <th>
                                        <?php echo $row_comment['comment_id']?>
                                    </th>
                                        <?php
                                            $sql_product = "Select * from product where product_id = ".$row_comment['product_id'];
                                            $result_product = mysqli_query($conn, $sql_product);
                                            $row_product = mysqli_fetch_assoc($result_product); 
                                        ?>
                                    <td data-toggle="popover-hover" data-img="">
                                        <span><?php echo $row_product['product_name']?></span>
                                    </td>
                                    <td>
                                        <?php echo $row_comment['content']?>
                                    </td>
                                    <td>
                                        <?php echo $row_comment['username']?>
                                    </td>
                                    <!-- <td>
                                        <?php 
                                            $sql_cate = "Select * from category where category_id = ".$row_comment['category_id'];
                                            $result_cate = mysqli_query($conn, $sql_cate);
                                            if (mysqli_num_rows($result_cate) > 0) {
                                                while($row_cate = mysqli_fetch_assoc($result_cate)) {
                                                    echo $row_cate['category_name'];  
                                                }
                                            }
                                        ?>
                                    </td> -->
                                    <td>
                                        <?php echo $row_comment['target_id']?>
                                    </td>
                                    <td>
                                        <?php echo $row_comment['timestamp']?>
                                    </td>
                                    <td>
                                        <span>
                                            <a onclick="ReplyComment(<?php echo $row_comment['comment_id'].','.$row_comment['product_id'] ?>)" href="#" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-comment color-muted m-r-5"></i></a>
                                            <a onclick="ConfirmDelete(<?php echo $row_comment['comment_id'] ?>)" href="#" name="deleting-comment" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
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
    function ReplyComment(comment_id, product_id) {
        console.log(comment_id);
        console.log(product_id);
        (async () => {
            const { value: text } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Message',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            });
            if (text) {
                $.ajax({
                    url:"comment-reply.php?comment_id="+comment_id ,
                    data: { text : text , product_id : product_id },
                    method:"GET",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: data,
                            timer: 1500
                        });
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
        }) ();
        
    }
    function ConfirmDelete(comment_id) {
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
                    url:"delete.php?comment_id="+comment_id,
                    method:"GET",
                    success:function(data){ 
                        Swal.fire({
                          icon: 'success',
                          title: data,
                          timer: 1500
                        })
                        $('#comment_'+comment_id).remove();
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