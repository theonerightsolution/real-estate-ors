jQuery(document).ready(function ($) {
  var mediaUploader;

  $("#upload-header-image").click(function (e) {
    e.preventDefault();
    // If the uploader object already exists, reopen the dialog.
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object.
    mediaUploader = wp.media({
      title: "Upload Header Image",
      button: {
        text: "Use this image",
      },
      multiple: false, // Set to true to allow multiple files to be selected.
    });
    // When a file is selected, grab the URL and set it as the input value.
    mediaUploader.on("select", function () {
      var attachment = mediaUploader.state().get("selection").first().toJSON();
      $("#header-image-url").val(attachment.url); // Set the input value to the image URL
      $("#header-image-preview").attr("src", attachment.url).show(); // Show the image preview
    });
    // Open the uploader dialog
    mediaUploader.open();
  });
});
