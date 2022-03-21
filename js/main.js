$(function(){

  $('.cart-dropdown-toggle').on('click', function () {
    $('.cart-dropdown').toggleClass("open");
  });

  $('.add-address').on('click', function () {
    $('.popup-add-address').addClass("show");
  });

  $('.btn-close').on('click', function () {
    $('.popup-add-address').removeClass("show");
  });

  $('.products-slick').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow:'<i class="fas fa-angle-left left-arrow"></i>',
    nextArrow:'<i class="fas fa-angle-right right-arrow"></i>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  
  $('.products-widget-slick').slick({
    infinite:true,
    autoplay:true,
    speed:300,
    dots:false,
    arrows:true,
    prevArrow:'<i class="fas fa-angle-left left-arrow-product-widget"></i>',
    nextArrow:'<i class="fas fa-angle-right right-arrow-product-widget">',
  });

  // Input number
  $('.input-number').each(function() {
    var $this = $(this),
        $input = $this.find('input[type="number"]'),
        up = $this.find('.qty-up'),
        down = $this.find('.qty-down');
  
    down.on('click', function() {
        var value = parseInt($input.val()) - 1;
        value = value < 1 ? 1 : value;
        $input.val(value);
        $input.change();
        updatePriceSlider($this, value)
    })
  
    up.on('click', function() {
        var value = parseInt($input.val()) + 1;
        $input.val(value);
        $input.change();
        updatePriceSlider($this, value)
    })
  });
})