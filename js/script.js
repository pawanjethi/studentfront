function validator(field) {
  if (field.validity.valueMissing) {
    field.setCustomValidity('*Required');
    $(field).addClass('error');
    $("span[for='" + $(field).attr('id') + "']").text(field.validationMessage);
    return false;
  } else if (field.validity.typeMismatch || field.validity.patternMismatch) {
    field.setCustomValidity('*Invalid Format');
    $(field).addClass('error');
    $("span[for='" + $(field).attr('id') + "']").text(field.validationMessage);
    return false;
  } else {
    field.setCustomValidity('');
    $(field).removeClass('error');
    $("span[for='" + $(field).attr('id') + "']").text(field.validationMessage);
    return true;
  }
  return true;
}

$(function() {
    $.fn.andSelf = function() {
    return this.addBack.apply(this, arguments);
  };

  $("html").on("click", ".btn", function(evt) {
    var btn = $(evt.currentTarget);
    var x = evt.pageX - btn.offset().left;
    var y = evt.pageY - btn.offset().top;

    $("<span/>").appendTo(btn).css({
      left: x,
      top: y
    });
  });

  // Top Slider
  var length = $('.tab .nav-tabs .nav-item .nav-link').length,
  displacement = 100 / length;
  $('.tab .slider .bar, .tab .nav-tabs .nav-item').css('width', String(displacement) + '%');

  for (let i = 0; i < length; i++) {
      $($('.tab .nav-tabs.desktop .nav-item .nav-link')[i]).click(function() {
              $('.tab .slider .bar').css('margin-left', String(displacement * i) + '%');
      });
  }  
});

$(document).on("change",".uploadFile", function()
{
    var uploadFile = $(this);
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

    if (/^image/.test( files[0].type)){ // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function(){ // set image data as background of div
            //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
        }
    }

});