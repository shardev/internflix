jQuery(function () {
  let availableDaysForMovies = []
  let popupOpened = false
  let confirmationPopupOpened = false

  jQuery("#searchButton").click(function () {
    let genre = document.getElementById('movie-genre').value;

    jQuery.ajax({
      url: "/start-movie-reservation",
      type: "get",
      data: {"genre": genre},
      success: function (response) {
        document.open()
        document.write(response)
        document.close()
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  })

  jQuery('[id^="movieitem-"]').click(function (event) {
    let clickedDiv = jQuery(this).closest('h5').prevObject
    if (clickedDiv.attr("class") == "inactive") {
      let alreadyActive = document.getElementsByClassName("active");

      // Deactivate another active divs if exist
      [...alreadyActive].forEach((activeDiv, i) => {
        if (typeof activeDiv !== "undefined" && activeDiv.id != clickedDiv.attr('id')) {
          activeDiv.className = "inactive"
          jQuery('#reservationButton').remove()
        }
      })

      clickedDiv.removeClass("inactive")
      clickedDiv.addClass("active")

      jQuery(('#' + clickedDiv.attr('id'))).after(`<div id="reservationButton"><button>Reserve movie</button></div>`)
      jQuery("#reservationButton").on("click", null, {divID: clickedDiv.attr('id')}, availableDaysPopupHandler)
    } else {
      clickedDiv.removeClass("active")
      clickedDiv.addClass("inactive")
      jQuery('#reservationButton').remove()
    }
  })

  function availableDaysPopupHandler(event) {
    let extractedId = event.data.divID.slice(10, 11) // pattern: movieitem-id
    availableDaysForMovies[extractedId] = [];
    [...jQuery('#available-days-' + extractedId).children()].forEach((day, i) => {
      availableDaysForMovies[extractedId].push(day.dataset.day)
    })

    // Make popup
    if (!popupOpened && !confirmationPopupOpened) {
      popupOpened = true
      jQuery('<div id="dialog"><div/>').appendTo('#reservationButton')

      let htmlForButton = ''
      if(!availableDaysForMovies[extractedId].length){
        htmlForButton = 'Currently there are not available days for this movie.'
      }else{
        availableDaysForMovies[extractedId].forEach((day, i) => {
          htmlForButton += "<button class='dayButton' value='" + day + "' id='" + day + "' >" + day + "</button><br><br>"
        })
      }

      jQuery('#dialog').dialog({
        title: "Choose one of available days:",
        create: function () {
          jQuery(this).closest('div.ui-dialog')
            .find('button.ui-dialog-titlebar-close')
            .click(function (e) {
              popupOpened = false
              jQuery('#dialog').remove()
              e.preventDefault()
            });
        }
      })

      jQuery('#dialog').html(htmlForButton)
      jQuery(".dayButton").on("click", null, {movieId: extractedId}, confirmationPopupHandler)
    }
  }

  function confirmationPopupHandler(event) {
    popupOpened = false
    confirmationPopupOpened = true
    jQuery('#dialog').remove()
    jQuery('<div id="dialog-confirm"><div/>').appendTo('#reservationButton')
    jQuery('#dialog-confirm').html("<p>[FOR TEST: day:" + event.target.id + " movieid:" + event.data.movieId + "]<form><button id='confirmationButton' type='button'> CONFIRM </button></form>")

    jQuery('#dialog-confirm').dialog({
      title: "Confirm your movie reservation",
      create: function () {
        jQuery(this).closest('div.ui-dialog')
          .find('button.ui-dialog-titlebar-close')
          .click(function (e) {
            confirmationPopupOpened = false
            jQuery('#dialog-confirm').remove()
            e.preventDefault()
          });
      }
    })
  }
})
