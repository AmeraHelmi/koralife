(function($) {
    'use strict';

	
    /*-------------------------------------------------------------------------------
      DATE & TIME
      -------------------------------------------------------------------------------*/
    var datetime = null,
        date = null;

    var update = function() {
        date = moment(new Date())
        datetime.html(date.format('dddd, Do MMMM YYYY, h:mm:ss a'));
    };

    $(document).ready(function() {
        datetime = $('#datetime');
        update();
        setInterval(update, 1000);

    });

 
    /*-------------------------------------------------------------------------------
      COUNTDOWN COUNTER
      -------------------------------------------------------------------------------*/

    $("#countdown").countdown({
        date: "8 September 2020 09:00:00", // Change this to your desired date to countdown to
        format: "on"
    });
    /*-------------------------------------------------------------------------------
      RECOGNIZE GESTURES MADE BY TOUCH - HAMMER JS
      -------------------------------------------------------------------------------*/

    $('#banner-carousel').carousel({
        interval: 4000,
        direction: 'right',
        pause: 'hover',

    });

    // handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function() {
        var id_selector = $(this).attr("id");
        var id = id_selector.substr(id_selector.length - 1);
        id = parseInt(id);
        $('#banner-carousel').carousel(id);
        $('[id^=carousel-selector-]').removeClass('selected');
        $(this).addClass('selected');
    });

    // when the carousel slides, auto update
    $('#banner-carousel').on('slide', function() {
        var id = $('.item.active').data('slide-number');
        id = parseInt(id);
        $('[id^=carousel-selector-]').removeClass('selected');
        $('[id=carousel-selector-' + id + ']').addClass('selected');
    });




  $('#videos-carousel').carousel({
        interval: 4000,
      
     

    });

    // handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function() {
        var id_selector = $(this).attr("id");
        var id = id_selector.substr(id_selector.length - 1);
        id = parseInt(id);
        $('#videos-carousel').carousel(id);
        $('[id^=carousel-selector-]').removeClass('selected');
        $(this).addClass('selected');
    });

    // when the carousel slides, auto update
    $('#videos-carousel').on('slide', function() {
        var id = $('.item.active').data('slide-number');
        id = parseInt(id);
        $('[id^=carousel-selector-]').removeClass('selected');
        $('[id=carousel-selector-' + id + ']').addClass('selected');
    });










  $("#owl-blog").owlCarousel({
         autoPlay: false, //Set AutoPlay to 3 seconds
		  rtl: true,
         navigation: true,
         pagination: true,
         items: 1,
         itemsDesktop: [1199,
             1
         ],
         itemsDesktopSmall: [
             979, 1
         ],
         itemsTablet: [768, 1],
         itemsMobile: [479, 1],
     });


 /*-------------------------------------------------------------------------------
          PHARMACY IMAGES SLIDER
          -------------------------------------------------------------------------------*/
        $("#pharmacy-imgs").owlCarousel({
			  rtl: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: true,
            navText: ['&#xeb54',
                '&#xeb55'
            ],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 8
                }
            }
        });
		
		 $("#from-blog").owlCarousel({
			  rtl: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: true,
            navText: ['&#xeb54',
                '&#xeb55'
            ],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
		/*-------------------------------------------------------------------------------
        IMAGE GALLERY POPUP
        -------------------------------------------------------------------------------*/
     $('.gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});


/*-------------------------------------------------------------------------------
        IMAGE GALLERY POPUP
        -------------------------------------------------------------------------------*/




$('.photo-gallery').magnificPopup({
	 delegate: 'a.popup-img', // the selector for gallery item
		type: 'image',
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
  
		image: {
			verticalFit: true,
			titleSrc: function(item) {
        
        var caption = item.el.attr('title');
        
        var pinItURL = "http://pinterest.com/pin/create/button/";
        
        // Refer to http://developers.pinterest.com/pin_it/
        pinItURL += '?url=' + 'http://dimsemenov.com/plugins/magnific-popup/';
        pinItURL += '&media=' + item.el.attr('href');
        pinItURL += '&description=' + caption;
        
        
        return caption + ' &middot; <a class="pin-it" href="'+pinItURL+'" target="_blank"><img src="http://assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>';
			}
		},
  
  
    gallery: {
      enabled: true 
    }, 
  
  
  
    callbacks: {
      open: function() {
        this.wrap.on('click.pinhandler', '.pin-it', function(e) {
          
          // This part of code doesn't work on CodePen, as it blocks window.open
          // Uncomment it on your production site, it opens a window via JavaScript, instead of new page
          /*window.open(e.currentTarget.href, "intent", "scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=550,height=420,left=" + (window.screen ? Math.round(screen.width / 2 - 275) : 50) + ",top=" + 100);

          
          return false;*/
        });
      },
      beforeClose: function() {
       //this.wrap.off('click.pinhandler');
      }
    }
  
	});






    /*-------------------------------------------------------------------------------
      MAIN NEWS SLIDER
      -------------------------------------------------------------------------------*/


    $('#matches-board').owlCarousel({
        rtl: true,
		animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        loop: true,
        nav: true,
		    navText: [
      "<i class='icofont icofont-caret-left'></i>",
      "<i class='icofont icofont-caret-right'></i>"
      ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

		 /* -------------------------------------------------------------------------*
      * NICE SCROLL
      * -------------------------------------------------------------------------*/
     $("html").niceScroll({
         mousescrollstep: 70,
         cursorcolor: "#ff7e20 ",
         cursorwidth: "5px",
         cursorborderradius: "10px",
         cursorborder: "none",
     });
	  
	 /* -------------------------------------------------------------------------*
      * VIDEO DETAILS
      * -------------------------------------------------------------------------*/
     $('#video-info').sliphover({
         backgroundColor: '#ff7e20'
     });
	 
	 
	 $('.ticker').ticker(); 
	 
	 google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawLineColors);

function drawLineColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Dogs');
      data.addColumn('number', 'Cats');

      data.addRows([
        [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
        [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
        [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
        [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
        [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
        [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
        [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
        [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
        [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
        [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
        [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
        [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
      ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        },
        colors: ['#ff7e20', '#27313b']
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
	 
    /*-------------------------------------------------------------------------------
      RECOGNIZE GESTURES MADE BY TOUCH - HAMMER JS
      -------------------------------------------------------------------------------*/

    var hammertime = new Hammer(myElement, myOptions);
    hammertime.on('pan', function(ev) {
        console.log(ev);
    });






})(jQuery);