(function($) {

	"use strict";


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

  var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });


  var counter = function() {
		
		$('#section-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();

	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();

	$('.appointment_date').datepicker({
	  'format': 'm/d/yyyy',
	  'autoclose': true
	});

	$('.appointment_time').timepicker();

})(jQuery);

/**
* Template Name: NiceAdmin
* Updated: Sep 18 2023 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
	"use strict";
  
	/**
	 * Easy selector helper function
	 */
	const select = (el, all = false) => {
	  el = el.trim()
	  if (all) {
		return [...document.querySelectorAll(el)]
	  } else {
		return document.querySelector(el)
	  }
	}
  
	/**
	 * Easy event listener function
	 */
	const on = (type, el, listener, all = false) => {
	  if (all) {
		select(el, all).forEach(e => e.addEventListener(type, listener))
	  } else {
		select(el, all).addEventListener(type, listener)
	  }
	}
  
	/**
	 * Easy on scroll event listener 
	 */
	const onscroll = (el, listener) => {
	  el.addEventListener('scroll', listener)
	}
  
	/**
	 * Sidebar toggle
	 */
	if (select('.toggle-sidebar-btn')) {
	  on('click', '.toggle-sidebar-btn', function(e) {
		select('body').classList.toggle('toggle-sidebar')
	  })
	}
  
	/**
	 * Search bar toggle
	 */
	if (select('.search-bar-toggle')) {
	  on('click', '.search-bar-toggle', function(e) {
		select('.search-bar').classList.toggle('search-bar-show')
	  })
	}
  
	/**
	 * Navbar links active state on scroll
	 */
	let navbarlinks = select('#navbar .scrollto', true)
	const navbarlinksActive = () => {
	  let position = window.scrollY + 200
	  navbarlinks.forEach(navbarlink => {
		if (!navbarlink.hash) return
		let section = select(navbarlink.hash)
		if (!section) return
		if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
		  navbarlink.classList.add('active')
		} else {
		  navbarlink.classList.remove('active')
		}
	  })
	}
	window.addEventListener('load', navbarlinksActive)
	onscroll(document, navbarlinksActive)
  
	/**
	 * Toggle .header-scrolled class to #header when page is scrolled
	 */
	let selectHeader = select('#header')
	if (selectHeader) {
	  const headerScrolled = () => {
		if (window.scrollY > 100) {
		  selectHeader.classList.add('header-scrolled')
		} else {
		  selectHeader.classList.remove('header-scrolled')
		}
	  }
	  window.addEventListener('load', headerScrolled)
	  onscroll(document, headerScrolled)
	}
  
	/**
	 * Back to top button
	 */
	let backtotop = select('.back-to-top')
	if (backtotop) {
	  const toggleBacktotop = () => {
		if (window.scrollY > 100) {
		  backtotop.classList.add('active')
		} else {
		  backtotop.classList.remove('active')
		}
	  }
	  window.addEventListener('load', toggleBacktotop)
	  onscroll(document, toggleBacktotop)
	}
  
	/**
	 * Initiate tooltips
	 */
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	})
  
	/**
	 * Initiate quill editors
	 */
	if (select('.quill-editor-default')) {
	  new Quill('.quill-editor-default', {
		theme: 'snow'
	  });
	}
  
	if (select('.quill-editor-bubble')) {
	  new Quill('.quill-editor-bubble', {
		theme: 'bubble'
	  });
	}
  
	if (select('.quill-editor-full')) {
	  new Quill(".quill-editor-full", {
		modules: {
		  toolbar: [
			[{
			  font: []
			}, {
			  size: []
			}],
			["bold", "italic", "underline", "strike"],
			[{
				color: []
			  },
			  {
				background: []
			  }
			],
			[{
				script: "super"
			  },
			  {
				script: "sub"
			  }
			],
			[{
				list: "ordered"
			  },
			  {
				list: "bullet"
			  },
			  {
				indent: "-1"
			  },
			  {
				indent: "+1"
			  }
			],
			["direction", {
			  align: []
			}],
			["link", "image", "video"],
			["clean"]
		  ]
		},
		theme: "snow"
	  });
	}
  
	/**
	 * Initiate TinyMCE Editor
	 */
	const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
	const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
  
	tinymce.init({
	  selector: 'textarea.tinymce-editor',
	  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
	  editimage_cors_hosts: ['picsum.photos'],
	  menubar: 'file edit view insert format tools table help',
	  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
	  toolbar_sticky: true,
	  toolbar_sticky_offset: isSmallScreen ? 102 : 108,
	  autosave_ask_before_unload: true,
	  autosave_interval: '30s',
	  autosave_prefix: '{path}{query}-{id}-',
	  autosave_restore_when_empty: false,
	  autosave_retention: '2m',
	  image_advtab: true,
	  link_list: [{
		  title: 'My page 1',
		  value: 'https://www.tiny.cloud'
		},
		{
		  title: 'My page 2',
		  value: 'http://www.moxiecode.com'
		}
	  ],
	  image_list: [{
		  title: 'My page 1',
		  value: 'https://www.tiny.cloud'
		},
		{
		  title: 'My page 2',
		  value: 'http://www.moxiecode.com'
		}
	  ],
	  image_class_list: [{
		  title: 'None',
		  value: ''
		},
		{
		  title: 'Some class',
		  value: 'class-name'
		}
	  ],
	  importcss_append: true,
	  file_picker_callback: (callback, value, meta) => {
		/* Provide file and text for the link dialog */
		if (meta.filetype === 'file') {
		  callback('https://www.google.com/logos/google.jpg', {
			text: 'My text'
		  });
		}
  
		/* Provide image and alt text for the image dialog */
		if (meta.filetype === 'image') {
		  callback('https://www.google.com/logos/google.jpg', {
			alt: 'My alt text'
		  });
		}
  
		/* Provide alternative source and posted for the media dialog */
		if (meta.filetype === 'media') {
		  callback('movie.mp4', {
			source2: 'alt.ogg',
			poster: 'https://www.google.com/logos/google.jpg'
		  });
		}
	  },
	  templates: [{
		  title: 'New Table',
		  description: 'creates a new table',
		  content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
		},
		{
		  title: 'Starting my story',
		  description: 'A cure for writers block',
		  content: 'Once upon a time...'
		},
		{
		  title: 'New list with dates',
		  description: 'New List with dates',
		  content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
		}
	  ],
	  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
	  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
	  height: 600,
	  image_caption: true,
	  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
	  noneditable_class: 'mceNonEditable',
	  toolbar_mode: 'sliding',
	  contextmenu: 'link image table',
	  skin: useDarkMode ? 'oxide-dark' : 'oxide',
	  content_css: useDarkMode ? 'dark' : 'default',
	  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
	});
  
	/**
	 * Initiate Bootstrap validation check
	 */
	var needsValidation = document.querySelectorAll('.needs-validation')
  
	Array.prototype.slice.call(needsValidation)
	  .forEach(function(form) {
		form.addEventListener('submit', function(event) {
		  if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		  }
  
		  form.classList.add('was-validated')
		}, false)
	  })
  
	/**
	 * Initiate Datatables
	 */
	const datatables = select('.datatable', true)
	datatables.forEach(datatable => {
	  new simpleDatatables.DataTable(datatable);
	})
  
	/**
	 * Autoresize echart charts
	 */
	const mainContainer = select('#main');
	if (mainContainer) {
	  setTimeout(() => {
		new ResizeObserver(function() {
		  select('.echart', true).forEach(getEchart => {
			echarts.getInstanceByDom(getEchart).resize();
		  })
		}).observe(mainContainer);
	  }, 200);
	}
  
  })();