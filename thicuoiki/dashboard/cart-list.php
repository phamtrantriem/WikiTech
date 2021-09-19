<?php include('./header.php')?>
   <div class="row" style="margin-top: 15px">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cart Table</h4>
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle" id="product_table">
        <thead>
            <tr>
                <th style="width: 10%" scope="col">#</th>
                <th style="width: 25%" scope="col">Infomation</th>
                <th style="width: 35%" scope="col-5">Product</th>
                <th style="width: 15%" scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql_bill = "Select * from checkout";
                $result_bill = mysqli_query($conn, $sql_bill);
                echo "</br>";
                if (mysqli_num_rows($result_bill) > 0) {
                    while($row_bill = mysqli_fetch_assoc($result_bill)) {
            ?>  
            <tr>
                <th><?php echo $row_bill['checkout_id']?></th>
                <td data-toggle="popover-hover" data-img="">
                    <p><?php echo $row_bill['checkout_fullname']?></p>
                    <p><?php echo $row_bill['checkout_phone']?></p>
                    <p><?php echo $row_bill['checkout_email']?></p>
                    <p><?php echo $row_bill['checkout_address']?></p>
                    <p><?php echo $row_bill['checkout_province']?></p>
                    <p><?php echo $row_bill['checkout_country']?></p>
                </td>
                <td>
                    <?php 
                        $sql_item = "select * from order_item where checkout_id = ". $row_bill['checkout_id'];
                        $result_item = mysqli_query($conn,$sql_item);
                        if (mysqli_num_rows($result_item) > 0) {
                            while($row_item = mysqli_fetch_assoc($result_item)) {
                    ?>
                    <p><?php echo $row_item['product_name'] ?> X <?php echo $row_item['quantity'] ?></p>
                    <?php 
                        }
                    }
                    ?>
                </td>
                <td>
                    <select name="category_id" onchange="changeStatus(<?php echo $row_bill['checkout_id']?>, this.value)">
                        <?php 
                            $sql_status = "Select * from status";
                            $result_status = mysqli_query($conn, $sql_status);
                            if (mysqli_num_rows($result_status) > 0) {
                                while($row_status = mysqli_fetch_assoc($result_status)) {
                                    $selected = '';
                                    if($row_bill['checkout_status'] == $row_status['status_id']) { 
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo '<option '.$selected.' value="'.$row_status['status_id'].'">'.$row_status["status_name"].'</option>';
                                }
                            }
                        ?>
                    </select>
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
    
</script>
<?php include('./footer.php')?>