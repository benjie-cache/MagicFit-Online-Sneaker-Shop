// utils.js
export const quantityRanger= function() {
  $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
  $('.pro-qty').append('<span class="inc qtybtn">+</span>');
  $('.qtybtn').on('click', function() {
      var $button = $(this);
      var oldValue = $button.parent().find('input').val();
      if ($button.hasClass('inc')) {
          var newVal = parseFloat(oldValue) + 1;
      } else {
          // Don't allow decrementing below zero
          if (oldValue > 0) {
              var newVal = parseFloat(oldValue) - 1;
          } else {
              newVal = 0;
          }
      }
      $button.parent().find('input').val(newVal);
  });
};

export const sideOffcanvasToggle = (selectbtn, openElement) => {

  $('body').on('click', selectbtn, function(e) {
      e.preventDefault();

      var $this = $(this),
          wrapp = $this.parents('body'),
          wrapMask = $('<div / >').addClass('closeMask'),
          cartDropdown = $(openElement);

      if (!(cartDropdown).hasClass('open')) {
          wrapp.addClass('open');
          cartDropdown.addClass('open');
          cartDropdown.parent().append(wrapMask);
          wrapp.css({
              'overflow': 'hidden'

          });

      } else {
          removeSideMenu();
      }

      function removeSideMenu() {
          wrapp.removeAttr('style');
          wrapp.removeClass('open').find('.closeMask').remove();
          cartDropdown.removeClass('open');
      }

      $('.sidebar-close, .closeMask').on('click', function() {
          removeSideMenu();
      });

  });
};