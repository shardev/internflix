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
      jQuery("#reservationButton").click({divID : clickedDiv.attr('id')}, function (event) {
        // Handle popup
        let extractedId = event.data.divID.slice(10, 11)
        let availableDaysForSelectedMovie = jQuery('#available-days-' + extractedId)
        let dayDivs = availableDaysForSelectedMovie.children();

        availableDaysForMovie[extractedId] = [];
        [...dayDivs].forEach((day,i) => {
          availableDaysForMovie[extractedId].push(day.dataset.day)
        })
      })


    } else {
      clickedDiv.removeClass("active")
      clickedDiv.addClass("inactive")
      jQuery('#reservationButton').remove()
    }
  })
})
