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

var Samurai = window.Samurai || {};
Samurai.App = Samurai.App || {};

Samurai.App = {



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
	init: function (_this) {

		var _this = _this || Samurai.App;
		
		/* call functions... */
		
		
		
		/* Trigger that this is ready */
    		$(window).trigger('Samurai:App:isReady');

	},



	/**
	 * resize {function}
	 * @return
	 */
	resize: function () { },



	/**
	 * Project Functions
	 * 
	 * fn {object}
	 */
	fn: { }


}; // end Samurai.App



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



(function () {

	Samurai.App.init(Samurai.App);

})();
