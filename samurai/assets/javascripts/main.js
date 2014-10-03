/**
 * Main
 *
 * main.js
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://beaucharman.github.io/
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */


;(function ($) {



	_samurai = {



		/**
		 * vars
		 * @type {Object}
		 */
		vars : {

			resizeTimer: null,
			resizeTimerCount: 200,
			// $body: $('body')
		},



		/**
		 * init
		 * @return
		 */
		init: function () {

			var _this = this;
			
			/* Trigger that this is ready */
    			$(window).trigger('_samurai:namespace:isReady');

		},



		/**
		 * resize
		 * @return
		 */
		resize: function () { },



		/**
		 *
		 * Project Functions
		 *
		 */



	}; // end _samurai



	/**
	 * Document ready functions
	 */

	// $(document).ready(function () {

	// 	var _samurai = window._samurai;

	// 	_samurai.init();

	// 	$(window).trigger('resize');

	// });



	/**
	 * Window load functions
	 */
	// $(window).load(function () {

	// 	$(window).trigger('resize');

	// });



	/**
	 * Window resize functions
	 */
	// $(window).resize(function () {

	// 	clearTimeout(_samurai.vars.resizeTimer);
	// 	_samurai.vars.resizeTimer = setTimeout(_samurai.resize, _samurai.vars.resizeTimerCount);
	// });

})(); // pass jQuery here
