<?php require_once "view/header.php"; ?>
<div class="title">
        <h2>Buyer Form</h2>
    </div>
<div style="text-align: left; margin: 20px 0px 10px; padding-left: 120px;">
    <a id="btnAddAction" href="index.php">Report</a>
</div>
<div style="text-align:center">
    <!-- <form name="frmAdd" method="post" action="" id="receiptForm" onSubmit="return validate();"> -->
    <form id="receiptForm">
        <div id="validity-message">
            <?php
                if(isset($validity['resp_code'])){
                    echo $validity['message'];
                }
            ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <label>Amount</label><i class="text-danger">*</i>
                            <span id="amount-info" class="info"></span><br />
                            <input type="text" name="amount" id="amount" class="demoInputBox">
                        </div>

                        <div>
                            <label>Buyer Name</label><i class="text-danger">*</i>
                            <span id="buyer-info" class="info"></span><br />
                            <input type="text" name="buyer" id="buyer" class="demoInputBox">
                        </div>

                        <div>
                            <label>Receipt ID</label><i class="text-danger">*</i>
                            <span id="receipt-info" class="info"></span><br />
                            <input type="text" name="receipt_id" id="receipt" class="demoInputBox">
                        </div>

                        <div id="item_list" class="ml-9">
                            <label>Items</label><i class="text-danger">*</i>
                            <span id="items-info" class="info"></span><br />
                            <input type="text" name="items[]" id="items_1" class="demoInputBox mr-2"><span
                               class="btn btn-info btn-sm" id="less_1">More</span>
                        </div>
                        <div>
                            <label>Buyer Email</label><i class="text-danger">*</i>
                            <span id="buyer-email-info" class="info"></span><br />
                            <input type="text" name="buyer_email" id="buyer-email" class="demoInputBox">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <label>Note</label><i class="text-danger">*</i>
                            <span id="note-info" class="info"></span><br />
                            <input type="text" name="note" id="note" class="demoInputBox">
                        </div>

                        <div>
                            <label>City</label><i class="text-danger">*</i>
                            <span id="city-info" class="info"></span><br />
                            <input type="text" name="city" id="city" class="demoInputBox">
                        </div>

                        <div>
                            <label>Phone</label><i class="text-danger">*</i>
                            <span id="phone-info" class="info"></span><br />
                            <input type="text" name="phone" id="phone" class="demoInputBox">
                        </div>

                        <div>
                            <label>Entry By</label><i class="text-danger">*</i>
                            <span id="entry-by-info" class="info"></span><br />
                            <input type="text" name="entry_by" id="entry-by" class="demoInputBox">
                        </div>
                        <br />
                        <div>
                            <button type="submit" class="btn btn-sm btn-success">Generate</button>
                            <button type="reset" id="resetButton" class="btn btn-sm btn-primary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once "view/footer.php"; ?>
<script src="view/js/form_validation.js"></script>