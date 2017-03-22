;
( function( $, window, undefined ) {
	'use strict';
	var Modernizr = window.Modernizr;
	$.CBPQTRotator = function( options, element ) {
		this.paused = false;
		this.$el = $( element );
		this._init( options );
	};
	$.CBPQTRotator.defaults = {
		speed: 700,
		easing: 'ease',
		interval: 8000
	};
	$.CBPQTRotator.prototype = {
		_init: function( options ) {
			this.options = $.extend( true, {}, $.CBPQTRotator.defaults, options );
			this._config();
			this.$items.eq( this.current ).addClass( 'cbp-qtcurrent' );
			if ( this.support ) {
				this._setTransition();
			}
			this._startRotator();
			this.$items.hover( function() {
				console.log( "Paused" );
				this.paused = true;
			}, function() {
				console.log( "Resumed" );
				this.paused = false;
			} );
			$( 'a.quote-next' ).on( 'click', function() {
				this._next();
			} );
			$( 'a.quote-prev' ).on( 'click', function() {
				this._prev();
			} );
		},
		_config: function() {
			this.$items = this.$el.children( 'div.cbp-qtcontent' );
			this.itemsCount = this.$items.length;
			this.current = 0;
			this.support = Modernizr.csstransitions;
			if ( this.support ) {
				this.$progress = $( '<span class="cbp-qtprogress"></span>' ).appendTo( this.$el );
			}
		},
		_setTransition: function() {
			setTimeout( $.proxy( function() {
				this.$items.css( 'transition', 'opacity ' + this.options.speed + 'ms ' + this.options.easing );
			}, this ), 25 );
		},
		_startRotator: function() {
			if ( this.support ) {
				this._startProgress();
			}
			setTimeout( $.proxy( function() {
				if ( this.support ) {
					this._resetProgress();
				}
				if ( !this.paused ) {
					this._next();
				}
				this._startRotator();
			}, this ), this.options.interval );
		},
		_next: function() {
			this.$items.eq( this.current ).removeClass( 'cbp-qtcurrent' );
			this.current = this.current < this.itemsCount - 1 ? this.current + 1 : 0;
			this.$items.eq( this.current ).addClass( 'cbp-qtcurrent' );
		},
		_prev: function() {
			this.$items.eq( this.current ).removeClass( 'cbp-qtcurrent' );
			this.current = this.current < this.itemsCount + 1 ? this.current - 1 : 0;
			this.$items.eq( this.current ).addClass( 'cbp-qtcurrent' );
		},
		_startProgress: function() {
			setTimeout( $.proxy( function() {
				this.$progress.css( {
					transition: 'width ' + this.options.interval + 'ms linear',
					width: '100%'
				} );
			}, this ), 25 );
		},
		_resetProgress: function() {
			this.$progress.css( {
				transition: 'none',
				width: '0%'
			} );
		},
		destroy: function() {
			if ( this.support ) {
				this.$items.css( 'transition', 'none' );
				this.$progress.remove();
			}
			this.$items.removeClass( 'cbp-qtcurrent' ).css( {
				'position': 'relative',
				'z-index': 100,
				'pointer-events': 'auto',
				'opacity': 1
			} );
		}
	};
	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};
	$.fn.cbpQTRotator = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each( function() {
				var instance = $.data( this, 'cbpQTRotator' );
				if ( !instance ) {
					logError( "cannot call methods on cbpQTRotator prior to initialization; " + "attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[ options ] ) || options.charAt( 0 ) === "_" ) {
					logError( "no such method '" + options + "' for cbpQTRotator instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			} );
		} else {
			this.each( function() {
				var instance = $.data( this, 'cbpQTRotator' );
				if ( instance ) {
					instance._init();
				} else {
					instance = $.data( this, 'cbpQTRotator', new $.CBPQTRotator( options, this ) );
				}
			} );
		}
		return this;
	};
} )( jQuery, window );