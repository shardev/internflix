jQuery(function () {

  let firstName, lastName, emailInput, gender = ""

  // Open first popup dialog
  jQuery("#optIn").click(function (event) {
    jQuery('#dialog-opt-1').dialog({
      title: "Enter information:",
      width: 500
    })
  })

  // Close first then open second popup dialog
  jQuery("#next1").click(function (event) {
    event.preventDefault()
    if (jQuery("#form1")[0].checkValidity()) {
      firstName = jQuery("#firstName").val()
      lastName = jQuery("#lastName").val()
      emailInput = jQuery("#emailInput").val()

      jQuery(this).closest('#dialog-opt-1').dialog('close');
      jQuery('#dialog-opt-2').dialog({
        title: "Enter information:",
        width: 500
      })
    }
  })

  // Close second then open third popup dialog
  jQuery("#next2").click(function (event) {
    event.preventDefault()
    if (jQuery("#form2")[0].checkValidity()) {
      jQuery(this).closest('.ui-dialog-content').dialog('close');
      jQuery('#dialog-opt-3').dialog({
        title: "Enter information:",
        width: 500,
        create: function () {
          jQuery(this).closest('div.ui-dialog')
            .find('button.ui-dialog-titlebar-close')
            .click(function (e) {
              jQuery("#next3").prop("disabled", false)
              jQuery("#responsePlaceholder").attr("hidden", true)
              e.preventDefault()
            });
        }
      })
    }
  })

  // Send request for save subscription
  jQuery("#next3").click(function (event) {
    event.preventDefault()
    if (jQuery("#form3")[0].checkValidity()) {
      if (jQuery("#email2").val() !== jQuery("#email3").val()) {
        alert('Email Not Matching!');
      } else {
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
            if (response["success"]) {
              jQuery("#dialog-opt-3").closest('.ui-dialog-content').dialog('close');
              jQuery('#dialog-success').dialog({
                title: "Subscription successful!",
                width: 500
              })
            } else {
              jQuery("#responsePlaceholder").attr("hidden", false)
              jQuery("#next3").prop("disabled", true)
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            jQuery("html").html("<p>Error occurred while making subscription. </br> <input type='submit' onclick=\"window.history.go(-1); return false;\">Go back</input> ")
          }
        });
      }
    }
  })
})
