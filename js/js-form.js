(function ($, Drupal) {
  $.fn.testing = function () {
    alert("submitted");
    $("#custom-form-get-user-details").submit();
  };
})(jQuery, Drupal);

(function ($) {
  $(document).ready(function () {
    var $permanentAdd = $("#same-as-permanent");
    var $tempAdd = $(".form-item-temporary-address");
    //on load
    if ($permanentAdd.is(":checked")) {
      $tempAdd.hide();
    }

    $permanentAdd.on("change", function () {
      if ($(this).is(":checked")) {
        $tempAdd.hide();
      } else {
        $tempAdd.show();
      }
    });
  });
})(jQuery);

(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.MyModuleBehavior = {
    attach: function (context, settings) {
      var testing = drupalSettings.sujit_module.testing;
      console.log(testing);
      $("body").css("background", testing);
    },
  };
  // Drupal.behaviors.MyModuleBehavior.attach(document, Drupal.settings);
})(jQuery, Drupal, drupalSettings);
