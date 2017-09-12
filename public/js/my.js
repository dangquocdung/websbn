// hide #back-top first
$("#back-top").hide();

// fade in #back-top
$(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#back-top').fadeIn();
    } else {
      $('#back-top').fadeOut();
    }
  });

  // scroll body to 0px on click
  $('#back-top .fi-arrow-up').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
});



function goBack() {
    window.history.back();
}

function readURL(input){
  if (input.files && input.files[0]){
    var reader = new FileReader();

    reader.onload = function(e){
      $("#showimages").attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#inputimages").change(function(){
  readURL(this);
})

CKEDITOR.replace('noidung');
