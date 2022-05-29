
function addRow(ev) {
    var newRow = $(ev).parent().parent().clone().find("input:text").val("").removeClass("error").end();
    $(".invoice").append(newRow);
}
function removeRow(ev) {
    if ($('.inv_row').length > 1) {
        ev.closest('.inv_row').remove();
        calcTotal();
    }
}
function calcTotal() {
    var subTotal = 0;
    var taxTotal = 0;
    $(".inv_row").each(function () {
        var qty = Number($(this).children().find(".qty").val());
        var price = Number($(this).children().find(".price").val());
        var tax = Number($(this).children().find(".tax").val());
        var total = (qty * price);
        subTotal += total;
        taxTotal += (total * tax / 100);
        $(this).children().find(".total").val(total.toFixed(2));
    });
    var subTotalTax = (subTotal + taxTotal);
    $("#subTotal").html('$' + Number(subTotal).toFixed(2));
    $("#taxTotal").html('$' + Number(taxTotal).toFixed(2));
    $("#subTotalTax").html('$' + Number(subTotalTax).toFixed(2));
    $("#subTotalTemp").val(subTotalTax);
    var discType = Number($("#discType").val());
    if (discType == 0)
        var discAmt = Number($("#discAmt").val());
    else
        var discAmt = Number($("#discAmt").val()) * subTotalTax / 100;
    var grandTotal = subTotalTax - discAmt;
    $("#grandTotal").html('$' + Number(grandTotal).toFixed(2));
}
function changeDisc() {
    $("#discAmt").val("");
    calcTotal();
}
function resetForm() {
    $('#invform').get(0).reset();
    window.location = 'invoice.php';
}
function isNumeric(ev) {
    if (!$.isNumeric($(ev).val())) {
        $(ev).val("");
    }
    calcTotal();
}
$(document).ready(function () {
    $('#invform').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var invData = $.ajax({
            url: "print.php",
            type: 'POST',
            async: false,
            data: form.serialize()
        }).responseText;
        $('#myModal').html(invData);
        $('#myModal').modal('show');
    });
});
function modifyDiscount(ev) {
    var subTotal=Number($("#subTotalTemp").val());
    var disc=$(ev).val();
    if ($("#discType").val() == 0) {
        if (disc > subTotal) {
            alert("Discount Exceeded!!");
            $(ev).val("0");
            calcTotal();
        } 
    }else{
        var discAmt=disc*subTotal/100;
        if(discAmt>subTotal){
            alert("Discount Exceeded!!");
            $(ev).val("0");
            calcTotal();
        }
    }
}
