jQuery(function () {
  jQuery("#searchButton").click(function () {
    var genre = document.getElementById('movie-genre').value;

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
      let alreadyActive = document.getElementsByClassName("active");

      // Deactivate another active divs if exist
      for (let i = 0; i < alreadyActive.length; i++) {
        if (typeof alreadyActive[i] !== "undefined" && alreadyActive[i].id != clickedDiv.id) {
          alreadyActive[i].className = "inactive"
          jQuery('#reservationButton').remove()
        }
      }

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
