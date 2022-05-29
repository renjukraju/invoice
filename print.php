
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center"><strong>Tax Invoice</strong></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-container"><strong>ABC Company</strong></div>
                </div>
                <div class="col-xs-8 text-right">
                    <div class="input-container"><strong>Invoice Number #00001</strong></div>
                </div>
            </div>
            <hr class="col-xs-12">
            <div class="row">
                <div class="col-xs-4">
                    <div class="input-container"><strong>Order Date</strong> &nbsp;&nbsp; : 29-05-2022</div>
                    <div class="input-container"><strong>Invoice Date</strong> : <?php echo date('d-m-Y'); ?></div>
                </div>
                <div class="col-xs-4">
                    <div class="input-container"><strong>Bill To,</div>
                    <div class="input-container"><strong><?php echo $_POST['invoiceTo']; ?></strong></div>
                </div>
                <div class="col-xs-4 right">
                    <div class="input-container"><strong>Ship To,</strong></div>
                    <div class="input-container"><strong><?php echo $_POST['invoiceTo']; ?></strong></div>
                </div>
            </div>
            <hr class="col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-3">Name</th>
                        <th >Quantity</th>
                        <th>Price (in $)</th>
                        <th>Tax %</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subTotal = 0;
                    $taxTotal = 0;
                    for ($i = 0; $i < count($_POST['name']); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $_POST['name'][$i]; ?></td>
                            <td><?php echo $_POST['qty'][$i]; ?></td>
                            <td><?php echo $_POST['price'][$i]; ?></td>
                            <td><?php echo $_POST['tax'][$i]; ?></td>
                            <td class="text-right"><?php echo $_POST['total'][$i]; ?></td>
                        </tr>
                        <?php
                        $subTotal += $_POST['total'][$i];
                        $taxTotal += $_POST['total'][$i] * $_POST['tax'][$i] / 100;
                    }
                    $subTotalTax = round(($subTotal + $taxTotal), 2);
                    $discType = $_POST['discType'];
                    if ($discType == 0)
                        $discAmt = $_POST['discAmt'];
                    else
                        $discAmt = $_POST['discAmt'] * $subTotalTax / 100;
                    $grandTotal = round($subTotalTax - $discAmt, 2);
                    ?>  
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Sub Total(Without Tax)</strong></td>
                        <td class="text-right"><strong>$<?php echo number_format($subTotal,2); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Total Tax</strong></td>
                        <td class="text-right"><strong>$<?php echo number_format($taxTotal,2); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Sub Total(With Tax)</strong></td>
                        <td class="text-right"><strong>$<?php echo number_format($subTotalTax,2); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Discount</strong></td>
                        <td class="text-right"><strong>$<?php echo number_format($discAmt,2); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Grand Total</strong></td>
                        <td class="text-right"><strong>$<?php echo number_format($grandTotal,2); ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-11 text-right">
                    <div class="input-container">Authorized Signatory</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>