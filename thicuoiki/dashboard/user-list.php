<?php include('./header.php')?>
   <div class="row" style="margin-top: 15px">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Account Table</h4>
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle">
                            <thead>
                                <tr>
                                    <th style="width: 5%" scope="col">#</th>
                                    <th style="width: 20%" scope="col">Username</th>
                                    <th style="width: 25%" scope="col-5">Fullname</th>
                                    <th style="width: 15%" scope="col">Email</th>
                                    <th style="width: 10%" scope="col">Role</th>
                                    <td style="width: 15%" scope="col">Created time</td>
                                    <th style="width: 10%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql_account = "Select * from account";
                                    $result_account = mysqli_query($conn, $sql_account);
                                    echo "</br>";
                                    if (mysqli_num_rows($result_account) > 0) {
                                        while($row_account = mysqli_fetch_assoc($result_account)) {
                                ?>  
                                <tr id="account_<?php echo $row_account['id']?>">
                                    <th><?php echo $row_account['id']?></th>
                                    <td data-toggle="popover-hover" data-img="">
                                        <span><?php echo $row_account['username']?></span>
                                    </td>
                                    <td>
                                        <?php echo $row_account['fullname']?>
                                    </td>
                                    <td>
                                        <?php echo $row_account['email']?>
                                    </td>
                                    <td>
                                        <span class="label gradient-1 btn-rounded"><?php echo $row_account['role']?></span>
                                    </td>
                                    <td>
                                        <?php echo $row_account['timestamp']?>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                            <a onclick="ConfirmDelete(<?php echo $row_account['id']?>)" href="#" name="deleting-account" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
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
        function ConfirmDelete(account_id) {
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
                        url:"delete.php?account_id="+account_id,
                        method:"GET",
                        success:function(data){ 
                            Swal.fire({
                              icon: 'success',
                              title: "Delete Successfully",
                              timer: 1500
                            })
                            $('#account_'+account_id).remove();
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