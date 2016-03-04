jQuery.conversaaPixel = function conversaaPixel(urlTracking) {
  var title = escape(document.title);
  var url = window.location.href;
  var ref = document.referrer;
  var userLang = navigator.language || navigator.userLanguage;
  var trackingPixel = urlTracking + "/mtracking.gif?url=" + encodeURIComponent(url) + "&title=" + encodeURIComponent(title)+ "&language=" + encodeURIComponent(userLang)+"&referrer="+ref;
  return trackingPixel;
}
jQuery(document).ready(function($) {
  var pixel = $.conversaaPixel(conversaaUrl);
  $('body').append("<img src='"+pixel+"' />");
});
