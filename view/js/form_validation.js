"use strict";
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


"use strict";
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    var amount = $("#amount").val();
    if(!amount) {
        $("#amount-info").html("(required)");
        $("#amount-info").css('color','#FF0000');
        $("#amount").css('background-color','#FFFFDF');
        valid = false;
    }
    if(! $.isNumeric(amount)){
        $("#amount-info").html("(please input a valid number)");
        $("#amount-info").css('color','#FF0000');
        $("#amount").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!amount && ! $.isNumeric(amount)){
        $("#amount-info").html("(required and please input a valid number)");
        $("#amount-info").css('color','#FF0000');
        $("#amount").css('background-color','#FFFFDF');
        valid = false;
    }
    var buyer = $("#buyer").val();
    if(!buyer) {
        $("#buyer-info").html("(required)");
        $("#buyer-info").css('color','#FF0000');
        $("#buyer").css('background-color','#FFFFDF');
        valid = false;
    }
    if(buyer.length > 20){
        $("#buyer-info").html("(Buyer should be at most 20 chars.)");
        $("#buyer-info").css('color','#FF0000');
        $("#buyer").css('background-color','#FFFFDF');
        valid = false;
    }

    var receipt = $("#receipt").val();
    if(!receipt) {
        $("#receipt-info").html("(required)");
        $("#receipt-info").css('color','#FF0000');
        $("#receipt").css('background-color','#FFFFDF');
        valid = false;
    }

    var buyer_email = $("#buyer-email").val();
    
    if(!isEmail(buyer_email)) {
        $("#buyer-email-info").html("(please provide a valid email)");
        $("#buyer-email-info").css('color','#FF0000');
        $("#buyer-email").css('background-color','#FFFFDF');
        valid = false;
    }

    var note = $("#note").val();
    if(!note) {
        $("#note-info").html("(required)");
        $("#note-info").css('color','#FF0000');
        $("#note").css('background-color','#FFFFDF');
        valid = false;
    }
    if(note.length > 30){
        $("#note-info").html("(please keep your note within 30 chars.)");
        $("#note-info").css('color','#FF0000');
        $("#note").css('background-color','#FFFFDF');
        valid = false;
    }

    var item_len = $("#item_list>.demoInputBox").length;
    var items = "";
    for(var l=1; l<=item_len; l++){
        var item_val = $("#items_"+l).val();
        if(!item_val) {
            $("#items-info").html("(required)");
            $("#items-info").css('color','#FF0000');
            $("#items").css('background-color','#FFFFDF');
            valid = false;
        }
        items += $("#items_"+l).val().concat("", ",");
    }
    items = items.replace(/,\s*$/, "");

    var city = $("#city").val();
    if(!city) {
        $("#city-info").html("(required)");
        $("#city-info").css('color','#FF0000');
        $("#city").css('background-color','#FFFFDF');
        valid = false;
    }

    var phone = $("#phone").val();
    if(!phone) {
        $("#phone-info").html("(required)");
        $("#phone-info").css('color','#FF0000');
        $("#phone").css('background-color','#FFFFDF');
        valid = false;
    }
    if(! $.isNumeric(phone)){
        $("#phone-info").html("(Phone no should be just no)");
        $("#phone-info").css('color','#FF0000');
        $("#phone").css('background-color','#FFFFDF');
        valid = false;
    }

    if(phone.indexOf(0) != 0 || phone.length != 11){
        $("#phone-info").html("(phone no should be 11 digit and first digit should be 0)");
        $("#phone-info").css('color','#FF0000');
        $("#phone").css('background-color','#FFFFDF');
        valid = false;
    }

    var entry_by = $("#entry-by").val();
    if(! $.isNumeric(entry_by)){
        $("#entry-by-info").html("(please input a valid number)");
        $("#entry-by-info").css('color','#FF0000');
        $("#entry-by").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}

$("#receiptForm").on('submit', function(e){
    e.preventDefault();
    var valid = validate();
    if(valid){
        $.ajax({
            type: 'post',
            url: 'Submission.php',
            data: $('#receiptForm').serialize(),
            success: function (response) {
                if(response.resp_code){
                    $("#validity-message").html(response.message);
                    $("#validity-message").css('color', '#FF0000');
                }else{
                    $("#validity-message").html(response.message);
                    $("#validity-message").css('color', '#008000');
                    $('#receiptForm').trigger("reset");
                }
            }
            }); 
    }       
    
});
$("#resetButton").on('click', function(){
    $("#receiptForm").trigger('reset');
});
var i = 1;
"use strict";
$("#less_"+i).on("click", function(){
    i = $("#item_list>.demoInputBox").length;
    i++;
    var html = '';
    html += '<span id="br_'+i+'"><br /><br /></span><input type="text" name="items[]" id="items_'+i+'" class="demoInputBox mr-2">'
    +'<span class="btn btn-danger btn-sm" id="less_'+i+'" onmouseenter="less('+i+')">Less</span>';
    $("#item_list").append(html);
});
"use strict";
function less(i){
    $("#less_"+i).on("click", function(){
        var item_len = $("#item_list>.demoInputBox").length;
        $("#items_"+i).remove();
        $("#less_"+i).remove();
        $("#br_"+i).remove();
        if(item_len!=i){
            var l = i;
            for(var k=l+1; k<=item_len; k++){
                $("#item_list>#items_"+k).attr("id","items_"+i);
                $("#item_list>#less_"+k).attr({id:"less_"+i, onmouseenter:"less("+i+")"});
                $("#item_list>#br_"+k).attr("id","br_"+i);
                l++;
            }
        }
    });
}
