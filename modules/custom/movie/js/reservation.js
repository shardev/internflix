jQuery(function () {
  jQuery("#searchButton").click(function () {
    let genre = jQuery('#movie-genre').val();

    jQuery.ajax({
      url: "/start-movie-reservation",
      type: "get",
      data: {"genre": genre},
      success: function (response) {
        document.open();
        document.write(response);
        document.close();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  })

  jQuery('[id^="movieitem-"]').click(function (event) {
    let clickedDiv = jQuery(this).closest('h5').prevObject
    if (clickedDiv.attr("class") == "inactive") {
      let alreadyActive = jQuery(".active");

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

    } else {
      clickedDiv.removeClass("active")
      clickedDiv.addClass("inactive")
      jQuery('#reservationButton').remove()
    }
  })
})
