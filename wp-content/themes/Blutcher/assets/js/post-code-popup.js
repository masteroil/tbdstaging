(function ($) {
  ("use strict");
  $(document).ready(function () {
    var pincode_cookie = getCookie("valid_pincode");
    if (!getCookie("valid_pincode")) {
      console.log("no cookie");
      //showPinCodePopup();
    } else {
      $("#pincode_field_id").val(pincode_cookie);
    }
    setTimeout(showPinCodeAvailability, 300);

    $(".pc-popup-overlay").on("click", function () {
      $(this).parent().removeClass("open");
    });
  });

  function showPinCodePopup() {
    $(".pc-popup").addClass("open");
  }

  function showPinCodeAvailability() {
    if (pin_popup_object.pincode == "") {
      return false;
    }
    $("span#avlpin").show();
    $(".pin_div").hide();
    $("p#avat").html(
      $("span.pincode_static_text").text() + pin_popup_object.pincode
    );
  }

  
  var pincode_cookie = getCookie("valid_pincode");

  ///showing postcode checker in certain single product
  if (
    (window.location.href.indexOf(
      window.location.origin + "/product/combo-boxes"
    ) >= 0 ||
    window.location.href.indexOf(
      window.location.origin + "/product/raw-meals"
    ) >= 0) &&
    (!pincode_cookie || pincode_cookie.trim() === "")
  ) {
    showPinCodePopup();
  }




  function getCookie(name) {
    var cookieArr = document.cookie.split(";");

    for (var i = 0; i < cookieArr.length; i++) {
      var cookiePair = cookieArr[i].split("=");
      if (name == cookiePair[0].trim()) {
        return decodeURIComponent(cookiePair[1]);
      }
    }
    return null;
  }
})(jQuery);