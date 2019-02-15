/* =================================
------------------------------------
	ProDent - Dentist Template
	Version: 1.0
 ------------------------------------
 ====================================*/


'use strict';


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {
	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$(this).toggleClass('active');
		$('.nav-warp').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});


	/*------------------
		Progress Bar
	--------------------*/
	$('.progress-bar-style').each(function() {
		var progress = $(this).data("progress");
		var bgcolor = $(this).data("bgcolor");
		var prog_width = progress + '%';
		if (progress <= 100) {
			$(this).append('<div class="bar-inner" style="width:' + prog_width + '; background: '+ bgcolor +';"><span>' + prog_width + '</span></div>');
		}
		else {
			$(this).append('<div class="bar-inner" style="width:100%; background: '+ bgcolor +';"><span>100%</span></div>');
		}
	});

	/*
	confererence tab
	 */

    /**
     *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables
     *   but will likely encounter performance issues on larger tables.
     *
     *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
     *		$(input-element).filterTable()
     *
     *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
     */
    (function(){
        'use strict';
        var $ = jQuery;
        $.fn.extend({
            filterTable: function(){
                return this.each(function(){
                    $(this).on('keyup', function(e){
                        $('.filterTable_no_results').remove();
                        var $this = $(this),
                            search = $this.val().toLowerCase(),
                            target = $this.attr('data-filters'),
                            $target = $(target),
                            $rows = $target.find('tbody tr');

                        if(search == '') {
                            $rows.show();
                        } else {
                            $rows.each(function(){
                                var $this = $(this);
                                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                            })
                            if($target.find('tbody tr:visible').size() === 0) {
                                var col_count = $target.find('tr').first().find('td').size();
                                var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                                $target.find('tbody').append(no_results);
                            }
                        }
                    });
                });
            }
        });
        $('[data-action="filter"]').filterTable();
    })(jQuery);

    $(function(){
        // attach table filter plugin to inputs
        $('[data-action="filter"]').filterTable();

        $('.container').on('click', '.panel-heading span.filter', function(e){
            var $this = $(this),
                $panel = $this.parents('.panel');

            $panel.find('.panel-body').slideToggle();
            if($this.css('display') != 'none') {
                $panel.find('.panel-body input').focus();
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    })



	/*------------------
		Testimonials
	--------------------*/
	$('.testimonials-slider').owlCarousel({
		loop: true,
		nav: false,
		dots: true,
		margin: 128,
		center:true,
		items: 1,
		mouseDrag: false,
		animateOut: 'fadeOutRight',
		animateIn: 'fadeInLeft',
		autoplay:true
	});


	/*------------------
		Brands Slider
	--------------------*/
	$('.brands-slider').owlCarousel({
		loop: true,
		nav: false,
		dots: false,
		margin : 40,
		autoplay: true,
		responsive : {
			0 : {
				items: 1,
			},
			480 : {
				items: 2,
			},
			768 : {
				items: 4,
			},
			1200 : {
				items: 5,
			}
		}
	});



	/*------------------
		Popular Services
	--------------------*/
	$('.popular-services-slider').owlCarousel({
		loop: true,
		dots: false,
		margin : 40,
		autoplay: true,
		nav:true,
		navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive : {
			0 : {
				items: 1,
			},
			768 : {
				items: 2,
			},
			991: {
				items: 3
			}
		}
	});


	/*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});


	/*------------------
		Circle progress
	--------------------*/
	$('.circle-progress').each(function() {
		var cpvalue = $(this).data("cpvalue");
		var cpcolor = $(this).data("cpcolor");
		var cptitle = $(this).data("cptitle");
		var cpid 	= $(this).data("cpid");

		$(this).append('<div class="'+ cpid +' loader-circle"></div><div class="progress-info"><h2>'+ cpvalue +'%</h2><p>'+ cptitle +'</p></div>');

		if (cpvalue < 100) {

			$('.' + cpid).circleProgress({
				value: '0.' + cpvalue,
				size: 110,
				thickness: 7,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		} else {
			$('.' + cpid).circleProgress({
				value: 1,
				size: 110,
				thickness: 7,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		}

	});

    /*------------------
        SearchBar
    --------------------*/
    $(document).ready(function () {
        'use strict';
        $('#form_titre').autocompleter({
            url_list: '/search-article',
            url_get: '/?term='
        });


        $("#ui-id-1").click(function(){
            var id = $("#form_titre").val();

            if(id.toString().length > 0){
                $(location).attr('href', '/article/'+id.toString());
            }
        })

    });


})(jQuery);
