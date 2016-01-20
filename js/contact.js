$ ( document ).ready(function() {
  $ ( 'form' ).submit(function(e) {
      e.preventDefault();

      $.ajax({
          url: "http://formspree.io/joshua.archer@students.makeschool.com",
          method: "POST",
          data: {
              email: $('.email').val(),
              message: $('.message').val()
          },
          dataType: "json"
      }).error(function(x, status, error) {
          alert('Wa ohhhh, something went wrong... Please try again :)');
      }).success(function(data, status) {
          alert('You\'re awesome! I\'ll get back too you as soon as I can!');
          $('form').find('.email, .message').val('');
      });
  });
});

// $.ajax({
//        url: "http://formspree.io/kitty@makeschool.com", 
//        method: "POST",
//        data: {
//            email: $('.email').val(),
//            message: $('.message').val()
//        },
//        dataType: "json"
//    });
