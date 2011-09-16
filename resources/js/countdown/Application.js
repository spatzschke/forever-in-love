/**
 * Author: Melvyn Hills (@melvynhills)
 * Date: 11.01.2011
 * 
 *             DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE 
 *                     Version 2, December 2004 
 * 
 *  Copyright (C) 2011 Melvyn Hills
 * 
 *  Everyone is permitted to copy and distribute verbatim or modified 
 *  copies of this license document, and changing it is allowed as long 
 *  as the name is changed. 
 * 
 *             DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE 
 *    TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION 
 * 
 *   0. You just DO WHAT THE FUCK YOU WANT TO. 
 *
 */

var Application = function() {
	
	/**
	 * CONSTANTS
	 *
	 */
	var CANVAS_ID = 'scene'; // String
	var SPRITE_IMG_LOCATION = 'resources/images/countdown/numbers2.png'; // String
	var DIGIT_WIDTH = 69; // Number
	var DIGIT_HEIGHT = 110; // Number
	var DIGIT_POSITION = [50, 124, 198, 282, 356, 440, 514, 598, 673];
	
	
	/**
	 * VARIABLES
	 *
	 */
	var imagesToLoad = 1; // Number
	var animProgress = 0; // Number
	var spriteImage = null; //Image
	var spriteSheet = null; //SpriteSheet
	var spriteCache = {top:[], bottom:[]}; // Object
	var canvas = null; // DOM Canvas
	var stage = null; // Stage
	var timerIntervalID = 0; // Number
	var digits = [];
	
	/**
	 * PUBLIC METHODS
	 *
	 */
	this.init = function() { // void
		//console.log('Application::init');
		spriteImage = new Image();
		spriteImage.addEventListener('load', imageLoadHandler, false);
		spriteImage.src = SPRITE_IMG_LOCATION;
	};
	
	
	/**
	 * PRIVATE METHODS
	 *
	 */
	var start = function() { // void
		//console.log('Application::start');
	
		canvas = document.getElementById(CANVAS_ID);
		stage = new Stage(canvas);
		
		var totalDigits = Math.floor(spriteImage.width / DIGIT_WIDTH);
		//console.log('totalDigits', totalDigits);
		spriteSheet = new SpriteSheet(spriteImage, DIGIT_WIDTH, DIGIT_HEIGHT/2);
		
		var bmp;
		for (var i = 0; i < totalDigits; i++) {
			// top
			bmp = new BitmapSequence(spriteSheet);
			bmp.gotoAndStop(i);
			spriteCache.top.push(bmp);
			// bottom
			bmp = new BitmapSequence(spriteSheet);
			bmp.gotoAndStop(i+totalDigits);
			spriteCache.bottom.push(bmp);
		}
		
		var digit;
		for (var i = 0; i < DIGIT_POSITION.length; i++) {
			digit = new CountdownDigit(spriteCache, DIGIT_WIDTH, DIGIT_HEIGHT);
			digit.container.x = DIGIT_POSITION[i];
			digit.container.y = 30;
			stage.addChild(digit.container);
			digits.push(digit);
		}
		
		setTime();
		renderDigits(0.5);
		renderDigits(1);
		stage.tick();
		
		Tick.setInterval(40);
		Tick.addListener(renderTickHandler, true);
		Tick.setPaused(true);
		
		timerIntervalID = window.setInterval(timerHandler, 1000);
	};
	
	var setTime = function() {
		var time = getRemainingTime();
		//console.log(formatNumber(time.d), formatNumber(time.h), formatNumber(time.m), formatNumber(time.s));
		
		var timeStr = formatNumberHundret(time.d) + formatNumber(time.h) + formatNumber(time.m) + formatNumber(time.s);
		
		for (var i = 0; i < DIGIT_POSITION.length; i++) {
			digits[i].setValue(timeStr.charAt(i));
		}
	};
	
	var renderDigits = function(progress) {
		for (var i = 0; i < DIGIT_POSITION.length; i++) {
			digits[i].render(progress);
		}
	};
	
	
	/**
	 * EVENT HANDLERS
	 *
	 */
	var timerHandler = function() { // void
		//console.log('Application::timerHandler');
		setTime();
		Tick.setPaused(false); // start render
	};

	var renderTickHandler = function() { //void
		//console.log('Application::renderTickHandler');
		animProgress += 0.125;//0.0625;//
		renderDigits(animProgress);
		if (animProgress >= 1) {
			animProgress = 0;
			Tick.setPaused(true);
		}
		stage.tick();
	};

	var imageLoadHandler = function() { // void
		imagesToLoad--;
		//console.log('Application::imageLoadHandler', imagesToLoad);
		if (imagesToLoad==0) {
			start();
		}
	};
	
	
	/**
	 * UTILITIES
	 *
	 */
	
	
};