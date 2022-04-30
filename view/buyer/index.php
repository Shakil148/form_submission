<?php require_once "view/header.php"; ?>
<div class="title">
        <h2>Report</h2>
    </div>
    <div style="text-align: left; margin: 20px 0px 10px; padding-left: 250px;">
        <?php 
            if(isset($_GET['search'])){
               echo '<a id="btnAddAction" href="index.php">Previous</a>';
            }
        ?>
    </div>
    <div style="padding-left: 250px;">
        <form action="" method="get">
            <div>
                <label style="padding-top: 20px; margin-left: 20px;">User ID</label> 
                <span id="entry_by-info" class="info"></span> 
                <input type="text" name="entry_by" id="entry_by" class="demoInputBox">

                <label style="padding-top: 20px;padding-left:20px;">From</label> 
                <span id="from_date-info" class="info"></span>
                <input type="date" name="from_date" id="from_date" class="demoInputBox">
                
                <label style="padding-top: 20px; margin-left: 20px;">To</label> 
                <span id="to_date-info" class="info"></span> 
                <input type="date" name="to_date" id="to_date" class="demoInputBox">

                <input type="submit" name="search" id="btnSearch" value="Search" />
            </div>
            <div style="margin-left: 20px;" id="validity-message">
                <?php
                    if(isset($validity['resp_code'])){
                        echo $validity['message'] . "<br/>";
                    }
                ?>
            </div>
        </form>
    </div>
    <div style="padding-left:120px; margin: 20px 0px 10px; padding-right: 300px;">
        <a id="btnAddAction" href="index.php?action=buyer-add">Add New</a>
    </div>
    <div style="padding-left: 120px;" class="table table-responsive">
        <table border="1" cellpadding="10" cellspacing="1">
            <thead>
                    <th>Serial No</th>
                    <th>Amount</th>
                    <th>Buyer</th>
                    <th>Receipt</th>
                    <th>Items</th>
                    <th>Buyer Email</th>
                    <th>Buyer Ip</th>
                    <th>Note</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Hash Key</th>
                    <th>Entry Date</th>
                    <th>Entry by</th>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $result[$k]["amount"]; ?></td>
                        <td><?php echo $result[$k]["buyer"]; ?></td>
                        <td><?php echo $result[$k]["receipt_id"]; ?></td>
                        <td><?php echo $result[$k]["items"]; ?></td>
                        <td><?php echo $result[$k]["buyer_email"]; ?></td>
                        <td><?php echo $result[$k]["buyer_ip"]; ?></td>
                        <td><?php echo $result[$k]["note"]; ?></td>
                        <td><?php echo $result[$k]["city"]; ?></td>
                        <td><?php echo $result[$k]["phone"]; ?></td>
                        <td><?php echo $result[$k]["hash_key"]; ?></td>
                        <td><?php echo $result[$k]["entry_at"]; ?></td>
                        <td><?php echo $result[$k]["entry_by"]; ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
            <tbody>
        </table>
    </div>
<?php require_once "view/footer.php"; ?>