jQuery.conversaaPixel = function conversaaPixel() {
  var title = document.title;
  var url = window.location.href;
  var ref = document.referrer;
  var userLang = navigator.language || navigator.userLanguage;
  var trackingPixel = conversaaUrl + "/mtracking.gif?url=" + encodeURIComponent(url) + "&title=" + encodeURIComponent(title)+ "&language=" + encodeURIComponent(userLang)+"&referrer="+ref;
  return trackingPixel;
}
jQuery(document).ready(function($) {
  var pixel = $.conversaaPixel();
  console.log(pixel);
  $('body').append("<img src='"+pixel+"' />");
});
