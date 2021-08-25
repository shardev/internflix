jQuery(function () {
  let availableDaysForMovies = []
  let popupOpened = false
  let confirmationPopupOpened = false
  let extractedId = -1
  let selectedDay = ''

  jQuery("#searchButton").click(function () {
    const genre = document.getElementById('movie-genre').value;

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
    extractedId = event.data.divID.slice(10, 11) // pattern: movieitem-id
    availableDaysForMovies[extractedId] = [];
    [...jQuery('#available-days-' + extractedId).children()].forEach((day, i) => {
      availableDaysForMovies[extractedId].push(day.dataset.day)
    })

    // Make popup
    if (!popupOpened && !confirmationPopupOpened) {
      popupOpened = true
      jQuery('<div id="dialog"><div/>').appendTo('#reservationButton')

      let htmlForButton = ''
      if (!availableDaysForMovies[extractedId].length) {
        htmlForButton = 'Currently there are not available days for this movie.'
      } else {
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
    selectedDay = event.target.id
    jQuery('#dialog-confirm').html("<p>Day: " + selectedDay + ", movieid:" + event.data.movieId + "<form><button id='confirmationButton' type='button'> CONFIRM </button></form>")

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

  jQuery(document).on("click", '#confirmationButton' ,function (event){
    // customerName validation
    let name = jQuery('#customerName').val()
    if (name.length === 0) {
      alert("Name must not be empty.")
    } else if (name.length > 10) {
      alert("Name must not be longer than 10 chars.")
    } else if (/\d/.test(name)) {
      alert("Name must not have numbers.")
    } else if (name.charAt(0) !== name.charAt(0).toUpperCase()) {
      alert("Name must have first capital letter.")
    } else {
      // Can make reservation
      alert("Making reservation for customer: " + name + " for movie: " + extractedId + " at day: " + selectedDay)
    }
  })
})
