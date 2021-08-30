jQuery(function () {

  let firstName, lastName, emailInput, gender = ""
  jQuery("#optIn").click(function (event) {

    jQuery('#dialog-opt-1').dialog({
      title: "Enter information:",
      width: 500
    })

    jQuery("#next1").click(function (event) {

      firstName = jQuery("#firstName").val()
      lastName = jQuery("#lastName").val()
      emailInput = jQuery("#emailInput").val()

      jQuery(this).closest('#dialog-opt-1').dialog('close');
      jQuery('#dialog-opt-2').dialog({
        title: "Enter information:",
        width: 500
      })

      jQuery("#next2").click(function (event) {
        jQuery(this).closest('.ui-dialog-content').dialog('close');
        jQuery('#dialog-opt-3').dialog({
          title: "Enter information:",
          width: 500
        })
        jQuery("#next3").click(function (event) {
          // Send request for save subscription
          jQuery.ajax({
            url: "/save-subscription",
            type: "post",
            data: {
              "subscription_data": {
                "first_name": firstName,
                "last_name": lastName,
                "email_address": emailInput
              }
            },
            success: function (response) {
              document.open()
              document.write(response)
              document.close()
            },
            error: function (jqXHR, textStatus, errorThrown) {
              jQuery("html").html("<p>Error occurred while making subscription. </br> <input type='submit' onclick=\"window.history.go(-1); return false;\">Go back</input> ")
            }
          });
        })
      })

    })
  })
})
