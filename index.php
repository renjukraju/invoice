<!DOCTYPE html>
<html>
    <head>
        <title>Invoice</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/invoice.js"></script>
    </head>
    <body>
        <div class="container col-xs-10 col-md-offset-1">
            <div id="myModal" class="modal fade" role="dialog"></div>
            <div class="row">
                <div class="text-center">
                    <h2>TAX INVOICE</h2>
                </div>
            </div>

            <form id="invform" method="post">
                <div class="row">                    
                    <div class="col-xs-9 text-right">Invoice To*</div>
                    <div class="col-xs-3 text-right">
                        <input class="form-control input-sm" required name="invoiceTo" type="text" autocomplete="off">
                    </div>
                </div>
                <hr class="col-xs-12">
                <div class="row">
                    <div class="col-xs-1">
                        <label for="name"></label>
                    </div>
                    <div class="col-xs-3">
                        <label>Name*</label>
                    </div>
                    <div class="col-xs-2">
                        <label>Quantity*</label>
                    </div>
                    <div class="col-xs-2">
                        <label>Unit Price (in $)*</label>
                    </div>
                    <div class="col-xs-1">
                        <label>Tax %*</label>
                    </div>
                    <div class="col-xs-2">
                        <label>Total</label>
                    </div>
                    <div class="col-xs-1">
                        <label></label>
                    </div>
                </div> 
                <div class="row invoice">
                    <div class="form-group row inv_row">
                        <div class="col-xs-1">
                            <a class="btn btn-danger input-sm" onclick="removeRow($(this))">-</a>
                        </div>
                        <div class="col-xs-3">
                            <input class="form-control input-sm name" required name="name[]" type="text" autocomplete="off">
                        </div>
                        <div class="col-xs-2">
                            <input class="form-control input-sm qty" required onkeyup="isNumeric($(this))" name="qty[]" type="text" autocomplete="off">
                        </div>
                        <div class="col-xs-2">
                            <input class="form-control input-sm price" required onkeyup="isNumeric($(this))" name="price[]"  type="text" autocomplete="off">
                        </div>
                        <div class="col-xs-1">
                            <select name="tax[]" onchange="calcTotal()" class="form-control input-sm tax" autocomplete="off">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                            </select> 
                        </div>
                        <div class="col-xs-2">
                            <input class="form-control input-sm  bg-secondary total" readonly name="total[]" type="text" autocomplete="off">
                        </div>
                        <div class="col-xs-1 remove-item-container">
                            <a class="btn btn-success input-sm" onclick="addRow($(this))">+</a>
                        </div>
                    </div>
                </div>
                <hr class="col-xs-12">
                <div class="row">
                    <div class="col-xs-5 text-left"><i>Fields with * are mandatory</i></div>
                    <div class="col-xs-5 text-right">Sub Total(Without Tax)</div>
                    <div class="col-xs-2 text-right" id="subTotal">$0.00</div>
                </div>
                <div class="row">
                    <div class="col-xs-10 text-right">Total Tax</div>
                    <div class="col-xs-2 text-right" id="taxTotal">$0.00</div>
                </div>
                <div class="row">
                    <div class="col-xs-10 text-right">Sub Total(With Tax)<input type="hidden" id="subTotalTemp"/></div>
                    <div class="col-xs-2 text-right" id="subTotalTax">$0.00</div>
                </div>
                <div class="row">
                    <div class="col-xs-offset-7 col-xs-3 text-right">Discount*                    
                        <select class="input-xs" id="discType" onchange="changeDisc()" name="discType">
                            <option value="0">Amount</option>
                            <option value="1">Percentage</option>
                        </select>
                    </div>
                    <div class="col-xs-1 text-right">
                        <input class="input-xs" required id="discAmt" value="0" name="discAmt" onkeyup="isNumeric($(this))" onchange="modifyDiscount($(this))" type="text" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10 text-right">Grand Total</div>
                    <div class="col-xs-2 text-right" id="grandTotal">$0.00</div>
                </div>
                <div class="row noPrint actions">
                    <a class="btn btn-primary" onclick="resetForm()">Clear</a>
                    <input class="btn btn-primary" type="submit" value="Generate Invoice">
                </div>
            </form>
            <div id="myInvoice"></div>
        </div>       
    </body>
</html>
