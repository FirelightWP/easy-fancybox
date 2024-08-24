/**
 * FancyBox Classic - jQuery Plugin
 * Simple but fancy lightbox, based on the original FancyBox by Janis Skarnelis, modernized.
 *
 * Examples and original documentation at: http://fancybox.net
 *
 * Copyright (c) 2008 - 2010 Janis Skarnelis
 * That said, it is hardly a one-person project. Many people have submitted bugs, code, and offered their advice freely. Their support is greatly appreciated.
 *
 * Copyright (c) 2020 - RavanH
 * Version: 1.5 (2020/11/09)
 * Requires: jQuery v1.7+
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	var tmp, loading, overlay, wrap, outer, content, close, title, nav_prev, nav_next, resize_timeout, previousType, clone, final_pos,
	    selectedIndex = 0, selectedOpts = {}, selectedArray = [], currentIndex = 0, currentOpts = {}, currentArray = [], ajaxLoader = null,
	    imgPreloader = new Image(), imgRegExp = /\.(jpg|gif|png|bmp|jpeg|webp)(.*)?$/i, svgRegExp = /[^\.]\.(svg)\s*$/i,
	    pdfRegExp = /[^\.]\.(pdf)\s*$/i, titleHeight = 0, titleStr = '', busy = false, swipe_busy = false, move_startX, move_endX, pixel_ratio = window.devicePixelRatio || 1,
	    isTouch = 'ontouchstart' in window || window.DocumentTouch && document instanceof DocumentTouch || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;

	/*
	* Private methods
	*/

	_abort = function() {
		$.fancybox.hideActivity();

		imgPreloader.onerror = imgPreloader.onload = null;

		if (ajaxLoader) {
			ajaxLoader.abort();
		}

		tmp.empty();
	};

	_error = function(msg) {
		if (false === selectedOpts.onError(selectedArray, selectedIndex, selectedOpts)) {
			$.fancybox.hideActivity();
			busy = false;
			return;
		}

		if ( typeof msg === 'undefined' ) {
			msg = selectedOpts.txt.error.later;
		}

		selectedOpts.type = 'html';
		selectedOpts.enableSwipeNav = false;
		selectedOpts.titleShow = false;
		selectedOpts.width = 'auto';
		selectedOpts.height = 'auto';

		tmp.html('<p id="fancybox-error">' + selectedOpts.txt.error.content + '<br />' + msg + '</p>');

		_process_inline();
	};

	_start = function() {
		var obj = selectedArray[ selectedIndex ],
			href, type, title, ret;

		_abort();

		selectedOpts = $.extend({}, $.fn.fancybox.defaults, (typeof $(obj).data('fancybox') == 'undefined' ? selectedOpts : $(obj).data('fancybox')));

		$('html').addClass('fancybox-active');

		$(document).trigger('fancybox-start', [ selectedArray, selectedIndex, selectedOpts ] );

		ret = selectedOpts.onStart(selectedArray, selectedIndex, selectedOpts);

		if (ret === false) {
			busy = false;
			return;
		} else if (typeof ret == 'object') {
			selectedOpts = $.extend(selectedOpts, ret);
		}

		title = selectedOpts.title || (obj.nodeName ? $(obj).attr('title') : obj.title) || '';

		if (obj.nodeName && !selectedOpts.orig) {
			selectedOpts.orig = $(obj).find("img:first").length ? $(obj).find("img:first") : $(obj);
		}

		if (title === '' && selectedOpts.orig) {
			title = selectedOpts.orig.attr('title') || (selectedOpts.titleFromAlt ? selectedOpts.orig.attr('alt') : '');
		}

		href = selectedOpts.href || (obj.nodeName ? $(obj).attr('href') : obj.href) || null;

		if ((/^(?:javascript)/i).test(href) || href == '#') {
			href = null;
		}

		if (selectedOpts.type) {
			type = selectedOpts.type;
			if (!href) {
				href = selectedOpts.content;
			}
		} else if (selectedOpts.content) {
			type = 'html';
		} else if ( $(obj).hasClass('iframe') ) {
			type = 'iframe';
		} else if (href) {
			if (href.match(imgRegExp) || $(obj).hasClass("image")) {
				type = 'image';
			} else if (href.match(svgRegExp)) {
				type = 'svg';
			} else if (href.match(pdfRegExp)) {
				type = 'pdf';
			} else if (href.indexOf("#") === 0) {
				type = 'inline';
			} else {
				type = 'ajax';
			}
		}

		if (!type) {
			_error(selectedOpts.txt.error.type);
			return;
		}

		if ($(obj).hasClass('modal')) {
			selectedOpts.modal = true;
		}

		if (type == 'inline') {
			obj	= href.substr(href.indexOf("#"));
			type = $(obj).length > 0 ? 'inline' : 'ajax';
		}

		selectedOpts.type = type;
		selectedOpts.href = href;
		selectedOpts.title = title;

		if (selectedOpts.autoDimensions) {
			if (selectedOpts.type == 'html' || selectedOpts.type == 'inline' || selectedOpts.type == 'ajax') {
				selectedOpts.width = 'auto';
				selectedOpts.height = 'auto';
			} else {
				selectedOpts.autoDimensions = false;
			}
		}

		if (selectedOpts.modal) {
			selectedOpts.overlayShow = true;
			selectedOpts.hideOnOverlayClick = false;
			selectedOpts.hideOnContentClick = false;
			selectedOpts.enableEscapeButton = false;
			selectedOpts.showCloseButton = false;
		}

		selectedOpts.padding = parseInt(selectedOpts.padding, 10);
		selectedOpts.margin = parseInt(selectedOpts.margin, 10);

		tmp.css('padding', (selectedOpts.padding + selectedOpts.margin));

		if (selectedOpts.enableEscapeButton) {
			$(document).on('keydown.fb', function(e) {
				if (e.keyCode == 27) {
					e.preventDefault();
					$.fancybox.cancel();
					return false;
				}
			});
		}

		switch (type) {
			case 'html' :
				tmp.html( selectedOpts.content );
				selectedOpts.enableSwipeNav = false;

				_process_inline();
			break;

			case 'inline' :
				if ( $(obj).parent().is('#fancybox-content') === true) {
					busy = false;
					return;
				}

				selectedOpts.enableSwipeNav = false;

				$(obj).clone()
				      .attr('id', $(obj).attr('id')+'-tmp')
				      .insertBefore( $(obj) );

				$(document).on('fancybox-cleanup fancybox-change', function() {
					let theObj = content.children().children();
					$('#'+theObj.attr('id')+'-tmp').replaceWith(theObj);
				}).on('fancybox-cancel', function() {
					let theObj = tmp.children();
					if (!theObj.length) {
						theObj = content.children().children();
					}
					$('#'+theObj.attr('id')+'-tmp').replaceWith(theObj);
				});

				$(obj).appendTo(tmp);

				_process_inline();
			break;

			case 'image':
				selectedOpts.keepRatio = true;

				busy = false;

				imgPreloader = new Image();

				imgPreloader.onerror = function() {
					_error(selectedOpts.txt.error.image);
				};

				imgPreloader.onload = function() {
					busy = true;

					$.fancybox.hideActivity();

					imgPreloader.onerror = imgPreloader.onload = null;

					selectedOpts.width = imgPreloader.width;
					selectedOpts.height = imgPreloader.height;

					$("<img />").attr({
						'id' : 'fancybox-img',
						'src' : imgPreloader.src,
						'alt' : selectedOpts.title
					}).appendTo(tmp);

					_show();
				};

				imgPreloader.src = href;

				$.fancybox.showActivity();
			break;

			case 'svg':
				selectedOpts.scrolling = 'no';
				selectedOpts.keepRatio = true;

				var str = '<object type="image/svg+xml" width="' + selectedOpts.width + '" height="' + selectedOpts.height + '" data="' + href + '"></object>';

				tmp.html(str);

				_process_inline();
			break;

			case 'pdf':
				selectedOpts.scrolling = 'no';
				selectedOpts.enableSwipeNav = false;

				var str = '<object type="application/pdf" width="100%" height="100%" data="' + href + '"><a href="' + href + '" style="display:block;position:absolute;top:48%;width:100%;text-align:center">' + $(obj).html() + '</a></object>';

				tmp.html(str);

				_process_inline();
			break;

			case 'ajax':
				selectedOpts.enableKeyboardNav = false;
				selectedOpts.showNavArrows = false;
				selectedOpts.enableSwipeNav = false;

				busy = false;

				$.fancybox.showActivity();

				selectedOpts.ajax.win = selectedOpts.ajax.success;

				ajaxLoader = $.ajax($.extend({}, selectedOpts.ajax, {
					url	: href,
					data : selectedOpts.ajax.data || {},
					error : function() {
						if ( arguments[0].status > 0 ) { // XMLHttpRequest
							_error(arguments[2]); // errorThrown
						}
					},
					success : function(data, textStatus, XMLHttpRequest) {
						var o = typeof XMLHttpRequest == 'object' ? XMLHttpRequest : ajaxLoader;
						if (o.status == 200) {
							if ( typeof selectedOpts.ajax.win == 'function' ) {
								ret = selectedOpts.ajax.win(href, data, textStatus, XMLHttpRequest);

								if (ret === false) {
									$.fancybox.hideActivity();
									return;
								} else if (typeof ret == 'string' || typeof ret == 'object') {
									data = ret;
								}
							}

							if ( data.indexOf("<!DOCTYPE") > -1 || data.indexOf("<html") > -1 || data.indexOf("<body") > -1 ) {
								_error(selectedOpts.txt.error.unexpected);
							} else {
								tmp.html(data);
								_process_inline();
							}
						}
					}
				}));
			break;

			case 'iframe':
				selectedOpts.enableSwipeNav = false;

				$.fancybox.showActivity();

				_show();
			break;
		}
	};

	_process_inline = function() {
		var w = selectedOpts.width,
			h = selectedOpts.height;

		$.fancybox.hideActivity();

		if (w.toString().indexOf('%') > -1) {
			w = parseInt((window.innerWidth - (selectedOpts.margin * 2)) * parseFloat(w) / 100, 10) + 'px';
		} else {
			w = w == 'auto' ? 'auto' : w + 'px';
		}

		if (h.toString().indexOf('%') > -1) {
			h = parseInt((window.innerHeight - (selectedOpts.margin * 2)) * parseFloat(h) / 100, 10) + 'px';
		} else {
			h = h == 'auto' ? 'auto' : h + 'px';
		}

		tmp.wrapInner('<div style="width:' + w + ';height:' + h + ';overflow:hidden;position:relative;"></div>');

		selectedOpts.width = tmp.width();
		selectedOpts.height = tmp.height();

		_show();
	};

	_show = function() {
		busy = true;

		$(content.add( overlay )).off();

		$(window).off('resize.fb');

		previousType = currentOpts.type;

		currentArray = selectedArray;
		currentIndex = selectedIndex;
		currentOpts = selectedOpts;

		if (currentOpts.overlayShow) {
			overlay.css({
				'background-color' : currentOpts.overlayColor,
				'opacity' : currentOpts.overlayOpacity,
				'cursor' : currentOpts.hideOnOverlayClick ? 'pointer' : 'auto'
			});

			if (!overlay.is(':visible')) {
				overlay.fadeIn('fast');
			}
		} else {
			overlay.hide();
		}

		_process_title();

		final_pos = _get_zoom_to();

		if (wrap.is(':visible')) {
			$( close.add( nav_prev ).add( nav_next ) ).hide();

			// if both images
			if (previousType === 'image' && currentOpts.type === 'image') {
				// crossfade
				content.prepend( tmp.contents() );
				content
					.children()
					.first()
					.next().fadeOut(currentOpts.changeSpeed, function(){ $( this ).remove(); } );

				content.css('border-width', currentOpts.padding);

				wrap.animate(final_pos, {
					duration : currentOpts.changeSpeed,
					easing : currentOpts.easingChange,
					complete : _finish
				});
			} else {
				content.fadeTo(currentOpts.changeFade, 0.3, function() {

					content.css('border-width', currentOpts.padding);

					wrap.animate(final_pos, {
						duration : currentOpts.changeSpeed,
						easing : currentOpts.easingChange,
						complete : function() {
							content.html( tmp.contents() ).fadeTo(currentOpts.changeFade, 1, _finish);
						}
					});
				});
			}

			return;
		}

		wrap.removeAttr("style");

		content.css('border-width', currentOpts.padding);

		content.html( tmp.contents() );

		if (currentOpts.transitionIn == 'elastic') {
			wrap.css(_get_orig_pos()).show();

			final_pos.opacity = 1;

			wrap
				.attr('aria-hidden','false')
				.animate(final_pos, {
					duration : currentOpts.speedIn,
					easing : currentOpts.easingIn,
					complete : _finish
				});
		} else {
			wrap
				.css(final_pos)
				.attr('aria-hidden','false')
				.fadeIn( currentOpts.transitionIn == 'none' ? 0 : currentOpts.speedIn, _finish );
		}
	};

	_format_title = function(title) {
		if (title && title.length) {
			return '<div id="fancybox-title">' + title + '</div>';
		}

		return false;
	};

	_process_title = function() {
		titleStr = currentOpts.title || '';
		titleHeight = 0;

		title
			.empty()
			.removeAttr('style')
			.removeClass();

		if (currentOpts.titleShow === false) {
			title.hide();
			return;
		}

		titleStr = $.isFunction(currentOpts.titleFormat) ? currentOpts.titleFormat(titleStr, currentArray, currentIndex, currentOpts) : _format_title(titleStr);

		if (!titleStr || titleStr === '') {
			title.hide();
			return;
		}

		title
			.addClass('fancybox-title-' + currentOpts.titlePosition)
			.html( titleStr )
			.appendTo( 'body' )
			.show();

		switch (currentOpts.titlePosition) {
			case 'outside':
			case 'inside':
				titleHeight = title.outerHeight(true);
				title.appendTo( outer );
			break;

			case 'over':
				if (content.is(':visible')) {
					title.appendTo( content );
				} else {
					title.appendTo( tmp );
				}
			break;

			default:
				title
					.css({
						'paddingLeft' : currentOpts.padding,
						'paddingRight' : currentOpts.padding
					})
					.appendTo( wrap );
		}

		title.hide();
	};

	_swipe = function() {
		let dx = move_startX - move_endX;

		move_startX = move_endX = 0;

		if (Math.abs(dx) < currentOpts.swipeThreshold) return;

		if ( dx < 0 ) {
			$.fancybox.prev();
		} else {
			$.fancybox.next();
		}
	};

	_set_navigation = function() {
		if (currentArray.length === 1) return;

		if (currentOpts.enableSwipeNav) {
			wrap.css('cursor','move');

			wrap.on('mousedown.fb', function(e) {
				e.preventDefault();
				move_startX = move_endX = typeof e.clientX !== 'undefined' ? e.clientX : e.originalEvent.clientX;
				wrap.on('mousemove.fb', function(e) {
					move_endX = typeof e.clientX !== 'undefined' ? e.clientX : e.originalEvent.clientX;
				});
			});
			wrap.on('mouseup.fb', function() {
				wrap.off('mousemove.fb');
				_swipe();
			});
			if (isTouch) {
				wrap.on('touchstart.fb', function(e) {
					swipe_busy = e.touches.length === 1;
					move_startX = move_endX = typeof e.touches !== 'undefined' ? e.touches[0].clientX : e.originalEvent.touches[0].clientX;
					wrap.on('touchmove.fb', function(e) {
						if (e.touches.length === 1) {
							move_endX = typeof e.touches !== 'undefined' ? e.touches[0].clientX : e.originalEvent.touches[0].clientX;
						} else { // more than one touch, probably pinch or zoom
							swipe_busy = false;
							wrap.off('touchmove.fb');
						}
					});
				});
				wrap.on('touchend.fb', function() {
					wrap.off('touchmove.fb');
					if (swipe_busy) {
						swipe_busy = false;
						_swipe();
					}
				});
			}
		}

		if ($.fn.mousewheel) {
			wrap.on('mousewheel.fb', function(e, delta) {
				if (busy) {
					e.preventDefault();
				} else if ( currentOpts.type == 'image' && ( $(e.target).outerHeight() == 0 || $(e.target).prop('scrollHeight') === $(e.target).outerHeight() ) ) {
					e.preventDefault();
					$.fancybox[ delta > 0 ? 'prev' : 'next' ]();
				}
			});
		}

		$(document).off('keydown.fb');
		if (currentOpts.enableEscapeButton || currentOpts.enableKeyboardNav) {
			$(document).on('keydown.fb', function(e) {
				if (currentOpts.enableEscapeButton && e.keyCode == 27) {
					e.preventDefault();
					$.fancybox.close();
					return false;
				} else if (currentOpts.enableKeyboardNav && (e.keyCode == 37 || e.keyCode == 39) && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA' && e.target.tagName !== 'SELECT') {
					e.preventDefault();
					$.fancybox[ e.keyCode == 37 ? 'prev' : 'next']();
				} else if (currentOpts.enableKeyboardNav && (e.keyCode == 9) && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA' && e.target.tagName !== 'SELECT') {
					e.preventDefault();
					$.fancybox[ e.shiftKey ? 'prev' : 'next']();
				}
			});
		}

		if (currentOpts.showNavArrows) {
			if (currentOpts.cyclic || currentIndex !== 0) {
				nav_prev.attr('title',currentOpts.txt.prev).show();
			}

			if (currentOpts.cyclic || currentIndex != currentArray.length-1) {
				nav_next.attr('title',currentOpts.txt.next).show();
			}
		}
	};

	_finish = function () {
		if (titleStr && titleStr.length) {
			title.fadeIn();
		}

		if (currentOpts.showCloseButton) {
			close.attr('title',currentOpts.txt.close).show();
		}

		_set_navigation();

		if (currentOpts.hideOnContentClick)	{
			content.on('click', $.fancybox.close).css('cursor','pointer');;
		}

		if (currentOpts.hideOnOverlayClick)	{
			overlay.on('click', $.fancybox.close);
		}

		if (currentOpts.autoResize) {
			$(window).on("resize.fb", $.fancybox.resize);
		}

		if (currentOpts.type == 'iframe') {
			$('<iframe id="fancybox-frame" name="fancybox-frame' + new Date().getTime() + '"'
			+ ' style="border:0;margin:0;overflow:' + (currentOpts.scrolling == 'auto' ? 'auto' : (currentOpts.scrolling == 'yes' ? 'scroll' : 'hidden')) + '" src="'
			+ currentOpts.href + '"' + (false === currentOpts.allowfullscreen ? '' : ' allowfullscreen') + ' allow="autoplay; encrypted-media" tabindex="999"></iframe>')
			.appendTo(content).on('load',function() {
				$.fancybox.hideActivity();
			});
		}

		if (currentOpts.type == 'inline' || currentOpts.type == 'html') {
			$(content).children().css('overflow', currentOpts.scrolling == 'auto' ? 'auto' : (currentOpts.scrolling == 'yes' ? 'scroll' : 'hidden') );
		}

		wrap.show().focus();

		busy = false;

		$(document).trigger('fancybox-complete', [ currentArray, currentIndex, currentOpts ] );

		currentOpts.onComplete(currentArray, currentIndex, currentOpts);

		if (currentArray.length > 1) {
			_preload_next();
			_preload_prev();
		}
	};

	_preload_next = function() {
		var pos = typeof arguments[0] == 'number' ? arguments[0] : currentIndex + 1;

		if ( pos >= currentArray.length ) {
			if (currentOpts.cyclic) {
				pos = 0;
			} else {
				return;
			}
		}

		if ( pos == currentIndex ) {
			currentOpts.enableKeyboardNav = false;
			currentOpts.enableSwipeNav = false;
			wrap.off('mousewheel.fb touchstart.fb touchmove.fb touchend.fb mousedown.fb mousemove.fb mouseup.fb');
			nav_next.hide();
			return;
		}

		if ( _preload_image( pos ) ) {
			return;
		} else {
			_preload_next( pos + 1 );
		}
	};

	_preload_prev = function() {
		var pos = typeof arguments[0] == 'number' ? arguments[0] : currentIndex - 1;

		if ( pos < 0 ) {
			if (currentOpts.cyclic) {
				pos = currentArray.length - 1;
			} else {
				return;
			}
		}

		if ( pos == currentIndex ) {
			currentOpts.enableKeyboardNav = false;
			currentOpts.enableSwipeNav = false;
			wrap.off('mousewheel.fb touchstart.fb touchmove.fb touchend.fb mousedown.fb mousemove.fb mouseup.fb');
			nav_prev.hide();
			return;
		}

		if ( _preload_image( pos ) ) {
			return;
		} else {
			_preload_prev( pos - 1 );
		}
	};

	_preload_image = function(pos) {
		var objNext, obj = currentArray[ pos ];

		if ( typeof obj !== 'undefined' && typeof obj.href !== 'undefined' &&  obj.href !== currentOpts.href && (obj.href.match(imgRegExp) || $(obj).hasClass("image")) ) {
			objNext = new Image();
			objNext.src = obj.href;
			return true;
		} else {
			return false;
		}
	};

	_get_zoom_to = function () {
		var view = [
				window.innerWidth - (currentOpts.margin * 2),
				window.innerHeight - (currentOpts.margin * 2) - titleHeight,
				$(document).scrollLeft() + currentOpts.margin,
				$(document).scrollTop() + currentOpts.margin
			],
			to = {},
			ratio = currentOpts.keepRatio && currentOpts.height ? currentOpts.width / currentOpts.height : 1;

		if (currentOpts.width.toString().indexOf('%') > -1) {
			to.width = parseInt((view[0] * parseFloat(currentOpts.width)) / 100, 10);
		} else {
			to.width = currentOpts.width + (currentOpts.padding * 2);
		}

		if (currentOpts.height.toString().indexOf('%') > -1) {
			to.height = parseInt((view[1] * parseFloat(currentOpts.height)) / 100, 10);
		} else {
			to.height = currentOpts.height + (currentOpts.padding * 2);
		}

		// scale down to fit viewport, recalculate by ratio based on width and height without border and title
		if (to.width > view[0]) {
			if (currentOpts.autoScale) {
				to.width = view[0] - (currentOpts.padding * 2);
				to.height = parseInt(to.width / ratio, 10);
			} else {
				$('html').addClass('fancybox-allowscroll');
			}
		}
		if (currentOpts.autoScale && to.height > view[1]) {
			if (currentOpts.autoScale) {
				to.height = view[1] - (currentOpts.padding * 2);
				to.width = parseInt(to.height * ratio, 10);
			} else {
				$('html').addClass('fancybox-allowscroll');
			}
		}

		// calculate position
		to.left = parseInt(Math.max(view[2], view[2] + (view[0] - to.width ) / 2), 10);
		to.top  = parseInt(Math.max(view[3], view[3] + (view[1] - to.height) / 2), 10);

		return to;
	};

	_get_orig_pos = function() {
		if ( !selectedOpts.orig ) return false;

		var orig = $(selectedOpts.orig);

		if ( !orig.length ) return false;

		var pos = orig.offset();

		pos.top += parseInt( orig.css('paddingTop'), 10 ) || parseInt( orig.css('border-top-width'), 10 ) || 0;
		pos.left += parseInt( orig.css('paddingLeft'), 10 ) || parseInt( orig.css('border-left-width'), 10 ) || 0;

		return {
			width : orig.width() + (currentOpts.padding * 2),
			height : orig.height() + (currentOpts.padding * 2),
			top : pos.top - currentOpts.padding,
			left : pos.left - currentOpts.padding,
			opacity : 0
		};
	};

	_closed = function() {
		overlay.fadeOut('fast');

		$(document).trigger('fancybox-closed', [ currentArray, currentIndex, currentOpts ] );

		currentOpts.onClosed(currentArray, currentIndex, currentOpts);

		_cleanup();
	};

	_cleanup = function() {
		overlay.hide();

		title.empty().hide();
		wrap.hide().attr('aria-hidden','true');;

		content.empty();

		currentArray = selectedArray = [];
		currentIndex = selectedIndex = 0;
		currentOpts = selectedOpts	= {};

		$('html').css( { '--vertical-scrollbar' : '', '--horizontal-scrollbar' : '' } );
		$('html').removeClass('fancybox-active fancybox-allowscroll');

		$(document).off('fancybox-cancel fancybox-change fancybox-cleanup fancybox-closed');

		busy = false;
	};

	/*
	* Public methods
	*/

	$.fn.fancybox = function(options) {
		if (!$(this).length) {
			return this;
		}

		let objOpts = $.extend({}, options, ($.metadata ? $(this).metadata() : {}));

		if ( ! objOpts.minViewportWidth || document.documentElement.clientWidth >= objOpts.minViewportWidth ) {
			$(this)
			.data('fancybox', objOpts)
			.attr({'aria-controls':'fancybox-wrap','aria-haspopup':'dialog'})
			.off('click.fb')
			.on('click.fb', function(e) {
				e.preventDefault();

				if (busy) {
					return false;
				}

				busy = true;

				$(this).blur();

				selectedArray = [];
				selectedIndex = 0;

				var rel = $(this).attr('rel') || '';

				if (rel == '' || rel.replace(/alternate|external|help|license|nofollow|noreferrer|noopener|\s+/gi,'') == '') {
					selectedArray.push(this);
				} else {
					selectedArray = $('a[rel="' + rel + '"], area[rel="' + rel + '"]');
					selectedIndex = selectedArray.index( this );
				}

				$('html').css( { '--vertical-scrollbar' : window.innerWidth-$(window).width() + 'px', '--horizontal-scrollbar' : window.innerHeight-$(window).height() + 'px' } );

				_start();

				return false;
			});
		};

		return this;
	};

	$.fancybox = function(obj) {
		var opts;

		if (busy) {
			return;
		}

		busy = true;
		opts = typeof arguments[1] !== 'undefined' ? arguments[1] : {};

		selectedArray = [];
		selectedIndex = parseInt(opts.index, 10) || 0;

		if ( $.isArray(obj) ) {
			for (var i = 0, j = obj.length; i < j; i++) {
				if (typeof obj[i] == 'object') {
					$(obj[i]).data('fancybox', $.extend({}, opts, obj[i]));
				} else {
					obj[i] = $({}).data('fancybox', $.extend({content : obj[i]}, opts));
				}
			}

			selectedArray = jQuery.merge(selectedArray, obj);
		} else {
			if ( typeof obj == 'object' ) {
				$(obj).data('fancybox', $.extend({}, opts, obj));
			} else {
				obj = $({}).data('fancybox', $.extend({content : obj}, opts));
			}

			selectedArray.push(obj);
		}

		if (selectedIndex > selectedArray.length || selectedIndex < 0) {
			selectedIndex = 0;
		}

		$('html').css( { '--vertical-scrollbar' : window.innerWidth-$(window).width() + 'px', '--horizontal-scrollbar' : window.innerHeight-$(window).height() + 'px' } );

		_start();
	};

	$.fancybox.showActivity = function() {
		loading.attr('title',selectedOpts.txt.loading).show();
	};

	$.fancybox.hideActivity = function() {
		loading.hide();
	};

	$.fancybox.next = function() {
		var obj, pos = typeof arguments[0] == 'number' ? arguments[0] : currentIndex + 1;

		if (pos >= currentArray.length) {
			if (currentOpts.cyclic) {
				pos = 0;
			} else {
				return;
			}
		}

		obj = currentArray[pos];

		if ( pos != currentIndex && typeof obj !== 'undefined' && typeof obj.href !== 'undefined' && obj.href === currentOpts.href ) {
			$.fancybox.next( pos + 1 );
		} else {
			$.fancybox.pos( pos );
		}

		return;
	};

	$.fancybox.prev = function() {
		var obj, pos = typeof arguments[0] == 'number' ? arguments[0] : currentIndex - 1;

		if (pos < 0) {
			if (currentOpts.cyclic) {
				pos = currentArray.length - 1;
			} else {
				return;
			}
		}

		obj = currentArray[pos];

		if ( pos != currentIndex && typeof obj !== 'undefined' && typeof obj.href !== 'undefined' && obj.href === currentOpts.href ) {
			$.fancybox.prev( pos - 1 );
		} else {
			$.fancybox.pos( pos );
		}

		return;
	};

	$.fancybox.pos = function(pos) {
		if (busy) {
			return;
		}

		pos = parseInt(pos);

		if (currentArray.length > 1 && pos != currentIndex && pos > -1 && pos < currentArray.length) {
			$(document).trigger('fancybox-change');

			selectedArray = currentArray;
			selectedIndex = pos;

			wrap.off('mousewheel.fb touchstart.fb touchmove.fb touchend.fb mousedown.fb mousemove.fb mouseup.fb').css('cursor','initial');
			content.off('click');

			_start();
		}

		return;
	};

	$.fancybox.cancel = function() {
		busy = true;

		_abort();

		$(document).trigger('fancybox-cancel', [ selectedArray, selectedIndex, selectedOpts ] );

		if (selectedOpts && false === selectedOpts.onCancel(selectedArray, selectedIndex, selectedOpts) ) {
			busy = false;
			return;
		};

		$(selectedArray[ selectedIndex ]).focus();

		$(close.add( nav_prev ).add( nav_next )).hide();

		$(content.add( overlay )).off();

		$(window).off('resize.fb');
		$(wrap).off('mousewheel.fb touchstart.fb touchmove.fb touchend.fb mousedown.fb mousemove.fb mouseup.fb');
		$(document).off('keydown.fb');

		// This helps IE
		if (/MSIE|Trident/.test(window.navigator.userAgent)) {
			content.find('iframe#fancybox-frame').attr('src', '//about:blank');
		}

		wrap.stop();

		_cleanup();
	};

	// Note: within an iframe use - parent.$.fancybox.close();
	$.fancybox.close = function() {
		if (busy || wrap.is(':hidden')) {
			return;
		}

		busy = true;

		_abort();

		$(document).trigger('fancybox-cleanup', [ currentArray, currentIndex, currentOpts ] );

		if (currentOpts && false === currentOpts.onCleanup(currentArray, currentIndex, currentOpts)) {
			busy = false;
			return;
		}

		$(currentArray[ currentIndex ]).focus();

		$(close.add( nav_prev ).add( nav_next )).hide();

		$(content.add( overlay )).off();

		$(window).off('resize.fb');
		$(wrap).off('mousewheel.fb touchstart.fb touchmove.fb touchend.fb mousedown.fb mousemove.fb mouseup.fb');
		$(document).off('keydown.fb');

		// This helps IE
		if (/MSIE|Trident/.test(window.navigator.userAgent)) {
			content.find('iframe#fancybox-frame').attr('src', '//about:blank');
		}

		if (currentOpts.titlePosition !== 'inside') {
			title.empty();
		}

		wrap.stop();

		if (currentOpts.transitionOut == 'elastic') {
			title.empty().hide();

			wrap.animate(_get_orig_pos(), {
				duration : currentOpts.speedOut,
				easing : currentOpts.easingOut,
				complete : _closed
			});

		} else {
			wrap.fadeOut( currentOpts.transitionOut == 'none' ? 0 : currentOpts.speedOut, _closed);
		}
	};

	$.fancybox.resize = function() {
		clearTimeout( resize_timeout );

		resize_timeout = setTimeout( function() {
			var restore = [];

			busy = true;

			_process_title();

			final_pos = _get_zoom_to();

			close.is(':visible') && restore.push(close) && close.hide();
			nav_prev.is(':visible') && restore.push(nav_prev) && nav_prev.hide();
			nav_next.is(':visible') && restore.push(nav_next) && nav_next.hide();

			wrap.animate(final_pos, {
				duration : currentOpts.changeSpeed,
				easing : currentOpts.easingChange,
				complete : function() {
					if (titleStr && titleStr.length) {
						title.fadeIn();
					}
					restore.forEach( function(el){ el.show(); } );
					busy = false;
				}
			});
		}, 500 );
	};

	$.fancybox.init = function() {
		if ($("#fancybox-wrap").length) {
			return;
		}

		$('body').append(
			tmp     = $('<div id="fancybox-tmp"></div>'),
			loading = $('<div id="fancybox-loading" title="Cancel"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'),
			overlay = $('<div id="fancybox-overlay"></div>'),
			wrap    = $('<div id="fancybox-wrap" role="dialog" aria-hidden="true" aria-labelledby="fancybox-title" tabindex="-1"></div>')
		);

		wrap.append(
			outer = $('<div id="fancybox-outer"></div>')
		);

		outer.append(
			content  = $('<div id="fancybox-content"></div>'),
			close    = $('<a id="fancybox-close" href="javascript:;" title="Close" class="fancy-ico" tabindex="1"><span></span></a>'),
			nav_next = $('<a id="fancybox-next" href="javascript:;" title="Next" class="fancy-ico" tabindex="2"><span></span></a>'),
			nav_prev = $('<a id="fancybox-prev" href="javascript:;" title="Previous" class="fancy-ico" tabindex="3"><span></span></a>'),
			title    = $('<div id="fancybox-title-wrap"></div>')
		);

		close.on('click',$.fancybox.close);
		loading.on('click',$.fancybox.cancel);

		nav_prev.on('click',function(e) {
			e.preventDefault();
			$.fancybox.prev();
		});

		nav_next.on('click',function(e) {
			e.preventDefault();
			$.fancybox.next();
		});
	};

	$.fn.fancybox.defaults = {
		padding : 10,
		margin : 40,
		modal : false,
		cyclic : false,
		allowfullscreen : false,
		scrolling : 'auto',	// 'auto', 'yes' or 'no'

		width : 560,
		height : 340,

		autoScale : true,
		autoDimensions : true,
		autoResize : true,
		keepRatio : false,
		minViewportWidth : 0,

		swipeThreshold: 100,

		ajax : {},
		svg : { wmode: 'opaque' },

		hideOnOverlayClick : true,
		hideOnContentClick : false,

		overlayShow : true,
		overlayColor : '#000',
		overlayOpacity : 0.6,

		titleShow : true,
		titlePosition : 'float', // 'float', 'outside', 'inside' or 'over'
		titleFormat : null,
		titleFromAlt : true,

		transitionIn : 'fade', // 'elastic', 'fade' or 'none'
		transitionOut : 'fade', // 'elastic', 'fade' or 'none'

		speedIn : 400,
		speedOut : 400,

		changeSpeed : 200,
		changeFade : 200,

		easingIn : 'swing',
		easingOut : 'swing',

		showCloseButton	 : true,
		showNavArrows : true,
		enableEscapeButton : true,
		enableKeyboardNav : true,
		enableSwipeNav : true,

		txt: {
			error : {
				content    : 'The requested content cannot be loaded.',
				later      : 'Please try again later.',
				type       : 'No content type found.',
				image      : 'No image found.',
				unexpected : 'Unexpected response.'
			},
			loading : 'Cancel',
			close   : 'Close',
			next    : 'Next',
			prev    : 'Previous'
		},

		onStart : function(){},
		onCancel : function(){},
		onComplete : function(){},
		onCleanup : function(){},
		onClosed : function(){},
		onError : function(){}
	};

	$(document).ready(function() {
		$.fancybox.init();
	});

})(jQuery);
