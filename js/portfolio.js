// $ -> alias for jQuery, allows us to access
//      functions declared in the library
// .ready function gets executed when the page fully loads
// - great place to put event listeners for buttons

$ ( document ).ready(function() {
  $('#gallery').justifiedGallery( {
    rowHeight: 200,
    lastRow: 'justify',
    margins: 5
  }).on('jg.complete', function() {
    $('#gallery a').swipebox({
      hideBarsDelay: false
    });
  });
});

// $('#gallery').justifiedGallery( {
//   rowHeight: 200,
//   lastRow: 'justify',
//   margins: 5
// });
