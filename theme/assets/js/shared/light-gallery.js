(function($) {
  'use strict';

  if ($("#lightgallery").length) {
    $("#lightgallery").lightGallery();
  }
  if ($(".lightGallery-jump").length) {
    for (var i = 0; i < $(".lightGallery-jump").length; i++) {
      $(".lightGallery-jump").eq(i).lightGallery();
    }
  }

  if ($("#lightgallery-without-thumb").length) {
    $("#lightgallery-without-thumb").lightGallery({
      thumbnail: true,
      animateThumb: false,
      showThumbByDefault: false
    });
  }

  if ($("#video-gallery").length) {
    $("#video-gallery").lightGallery();
  }
})(jQuery);