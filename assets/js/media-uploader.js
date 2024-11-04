jQuery(document).ready(function ($) {
  console.log("media loaded!");
  /* For Logo Upload */
  $("#upload-header-image").click(function (e) {
    e.preventDefault();
    // Create the media uploader for the header logo image
    const headerMediaUploader = wp.media({
      title: "Upload Header Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    // When a file is selected, grab the URL and set it as the input value.
    headerMediaUploader.on("select", function () {
      const attachment = headerMediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#header-image-url").val(attachment.url);
      $("#header-image-preview").attr("src", attachment.url).show();
      console.log("Header image selected: ", attachment.url);
    });

    // Open the uploader dialog
    headerMediaUploader.open();
  });

  /* For Banner Image Upload 1. */
  $("#upload-banner-image-1").click(function (e) {
    e.preventDefault();
    // Create the media uploader for the banner image
    const bannerMediaUploader = wp.media({
      title: "Upload Banner Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    // When a file is selected, grab the URL and set it as the input value.
    bannerMediaUploader.on("select", function () {
      const attachment = bannerMediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#banner-image-url-1").val(attachment.url);
      $("#upload-banner-image-preview-1").attr("src", attachment.url).show();
      console.log("Banner image selected: ", attachment.url);
    });

    // Open the uploader dialog
    bannerMediaUploader.open();
  });
  /* For Banner Image Upload 2. */
  $("#upload-banner-image-2").click(function (e) {
    e.preventDefault();
    // Create the media uploader for the banner image
    const bannerMediaUploader = wp.media({
      title: "Upload Banner Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    // When a file is selected, grab the URL and set it as the input value.
    bannerMediaUploader.on("select", function () {
      const attachment = bannerMediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#banner-image-url-2").val(attachment.url);
      $("#upload-banner-image-preview-2").attr("src", attachment.url).show();
      console.log("Banner image selected: ", attachment.url);
    });

    // Open the uploader dialog
    bannerMediaUploader.open();
  });
  /* For Banner Image Upload 3. */
  $("#upload-banner-image-3").click(function (e) {
    e.preventDefault();
    // Create the media uploader for the banner image
    const bannerMediaUploader = wp.media({
      title: "Upload Banner Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    // When a file is selected, grab the URL and set it as the input value.
    bannerMediaUploader.on("select", function () {
      const attachment = bannerMediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#banner-image-url-3").val(attachment.url);
      $("#upload-banner-image-preview-3").attr("src", attachment.url).show();
      console.log("Banner image selected: ", attachment.url);
    });

    // Open the uploader dialog
    bannerMediaUploader.open();
  });
});
