$(document).ready(function () {
    $(".student_fee").on('click', function () {
        button_id = this.id;
        var id = button_id.split("/");
        var student_id = id[0];
        var fee_id = id[1];
        $.ajax({
            type: 'GET',
            url: '/pay_student_fee',
            data: {'student_id': student_id, 'fee_id': fee_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                console.log(data);
                console.log(data[0].discount);
                var due_amount = (data[0].fee_amount * data[0].yearly) - data[0].paid_amount - data[0].discount;
                var total = (data[0].fee_amount * data[0].yearly) - data[0].discount;
                $('#payment_add_div').html("");
                option += "<div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Fee Title <span class='error'>*</span></label>\n\
\n\<input type='text'   hidden name=fee_id value=" + data[0].fee_ids + " class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text'  id=" + data[0].fee_ids + " disabled  name=fee_id value=" + data[0].fee_title + " class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div>\n\
                                    <div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Fee Type <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text' id=" + data[0].fee_type_id + " disabled name=fee_type_id value=" + data[0].fee_name + data[0].fee_amount + "   class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div>\n\
                                <div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Total Amount <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text' disabled name=total value=" + total + "   class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div>\n\
                                <div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Paid Amount <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text'  name=paid_amount disabled value=" + data[0].paid_amount + "   class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div>\n\
<div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Due Amount <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text' name=due_amount  value=" + due_amount + " readonly  class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div>\n\
<div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Amount <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='number'  name=amount  class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div><div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Paid by <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <input type='text'  name=paid_by  class='col-xs-10 col-sm-5 col-lg-8 col-mg-8' />\n\
                                            </div></div></div><div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Mode of payment <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <select  name=payment_mode  class='col-xs-10 col-sm-5 col-md-8 col-lg-8'><option value=''>--- Mode of paymeent---</option>\n\
<option value='Cash'>Cash</option><option value='Cheque'>Cheque</option><option value='Demand draft'>Demand draft</option><option value='Online transfer'>Online transfer</option>\n\
<option value='Debit Card'>Debit Card</option><option value='Credit Card'>Credit Card</option><option value='Other'>Other</option></select>\n\
                                            </div></div><div class='form-group'>\n\
                                      <label class='col-sm-4 control-label no-padding-right' >Payment details <span class='error'>*</span></label>\n\
                                           <div class='col-sm-8'>\n\
                                               <textarea cols='25' rows='2' maxlength='100' name=payment_details wrap='soft' class='col-xs-10 col-sm-5 col-md-8 col-lg-8'></textarea>\n\
                                            </div></div></div>";

                $('#payment_add_div').append(option);
                $('#payment_details_div').hide();
                $('#do_payment_form').show();
            },
            error: function (data) {

            }

        });
    });
});