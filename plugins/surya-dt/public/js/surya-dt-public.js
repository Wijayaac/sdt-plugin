(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  // TODO: refactor code and remove unused code
  var geoXml = null;
  var map = null;
  var geocoder = null;
  var marker = null;

  function initialize() {
    const mapElement = document.querySelector("#map_canvas");
    const dataLatitude = mapElement.dataset.latitude || -37.81230754760852;
    const dataLongitude = mapElement.dataset.longitude || 144.9624813912677;
    const dataKml = mapElement.dataset.kml || "https://raw.githubusercontent.com/Wijayaac/testing-kml-with-maps/master/Test%20Zone%20Layer.kml";

    geocoder = new google.maps.Geocoder();

    var myOptions = {
      zoom: 12,
      center: new google.maps.LatLng(dataLatitude, dataLongitude),
      mapTypeControl: true,
      mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
      navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map = new google.maps.Map(mapElement, myOptions);
    geoXml = new geoXML3.parser({ map: map });

    geoXml.parse(dataKml);

    // Handle address submission
    handleSubmit();
  }

  function handleSubmit() {
    const submitButton = document.querySelector("#sdt-submit-btn");

    submitButton.addEventListener("click", function (e) {
      e.preventDefault();
      console.log("submit button clicked");
      const address = document.querySelector("#sdt-address").value;
      showAddress(address);
    });
  }

  function showAddress(address) {
    geocoder.geocode({ address: address }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var point = results[0].geometry.location;

        map.setCenter(point);
        if (marker && marker.setMap) marker.setMap(null);

        marker = new google.maps.Marker({
          map: map,
          position: point,
        });

        // check if the address within the polygon
        for (var i = 0; i < geoXml.docs[0].gpolygons.length; i++) {
          if (geoXml.docs[0].gpolygons[i].Contains(point)) {
            i = 999; // Jump out of loop early
            handleRedirection(false);
          } else {
            handleRedirection(true);
          }
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

  function handleRedirection(isOutside) {
    var outsideCta = document.querySelector("#outside-cta");
    var insideCta = document.querySelector("#inside-cta");
    var statusMessage = document.querySelector("#status-message");

    setTimeout(() => {
      if (isOutside) {
        outsideCta.click();
      } else {
        insideCta.click();
      }
    }, 3000);

    statusMessage.innerHTML = `Your location ${isOutside ? "outside" : "inside"} the area, and will be redirected to our partner. (if you are not redirected automatically, please click the link below)`;
  }

  $(window).load(function () {
    initialize();
  });
})(jQuery);
