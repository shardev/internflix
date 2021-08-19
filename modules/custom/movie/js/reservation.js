jQuery(function () {
  let availableDaysForMovie = []

  jQuery("#searchButton").click(function () {
    var genre = document.getElementById('movie-genre').value;

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
    let extractedId = event.data.divID.slice(10, 11)
    let availableDaysForSelectedMovie = jQuery('#available-days-' + extractedId)
    let dayDivs = availableDaysForSelectedMovie.children();

    availableDaysForMovie[extractedId] = [];
    [...dayDivs].forEach((day, i) => {
      availableDaysForMovie[extractedId].push(day.dataset.day)
    })

    // Make popup
    jQuery('<div id="dialog"><div/>').appendTo('#reservationButton')
    let htmlForButton = ''
    availableDaysForMovie[extractedId].forEach((day, i) => {
      htmlForButton += "<button class='dayButton' value='" + day + "' id='" + day +"' >" + day + "</button><br><br>"
    })
    jQuery('#dialog').dialog({title: "Choose one of available days:"})
    jQuery('#dialog').html(htmlForButton)
    jQuery(".dayButton").on("click", null, {movieId: extractedId }, confirmationPopupHandler)
  }

  function confirmationPopupHandler(event){
    jQuery('#dialog').remove()
    jQuery('<div id="dialog-confirm"><div/>').appendTo('#reservationButton')
    jQuery('#dialog-confirm').html("<p>Confirm your movie reservation:[FOR TEST: dayid:"+ event.target.id + " movieid:" + event.data.movieId  + "<form><button id='confirmationButton' type='button'> CONFIRM </button></form>")
    jQuery('#dialog-confirm').dialog()
  }
})
