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

var CountdownDigit = function(spriteCache, width, height) {
	
	/**
	 * CONSTANTS
	 *
	 */
	
	
	/**
	 * VARIABLES
	 *
	 */
	this.container = new Container(); // Container
	var spriteCache = spriteCache; // BitmapSequence
	var width = width; // Number
	var height = height; // Number
	var currentValue; // Number
	var dirty = false; // Boolean
	var topBitmap = null, underTopBitmap = null, bottomBitmap = null, overBottomBitmap = null; // Bitmap
	
	var topDarkGraphics = new Graphics(); // Graphics
	topDarkGraphics.beginFill(Graphics.getRGB(0, 0, 0, 1));
	topDarkGraphics.drawRoundRectComplex(0, 0, width, height / 2, 10, 10, 0, 0); //x, y, w, h, radiusTL, radiusTR, radiusBR, radiusBL
	topDarkGraphics.endFill();
	var topDarkShape = new Shape(topDarkGraphics); // Shape
	var topContainer = new Container(); // Container
	
	/**
	 * PUBLIC METHODS
	 *
	 */
	this.setValue = function(value) { // void
		if (value == currentValue) {
			return;
		}
		
		currentValue = currentValue || 0;
		
		this.container.removeAllChildren();
		
		underTopBitmap = spriteCache.top[value].clone();
		this.container.addChild(underTopBitmap);
		
		topBitmap = spriteCache.top[currentValue].clone();
		topDarkShape.alpha = 0;
		topContainer.removeAllChildren();
		topContainer.addChild(topBitmap);
		topContainer.addChild(topDarkShape);
		// topBitmap.y = height / 2;
		// topBitmap.regY = height / 2;
		// this.container.addChild(topBitmap);
		topContainer.y = height / 2;
		topContainer.regY = height / 2;
		topContainer.visible = true;
		this.container.addChild(topContainer);
		
		bottomBitmap = spriteCache.bottom[currentValue].clone();
		bottomBitmap.y = height / 2;
		this.container.addChild(bottomBitmap);
		
		overBottomBitmap = spriteCache.bottom[value].clone();
		overBottomBitmap.y = height / 2;
		overBottomBitmap.visible = false;
		this.container.addChild(overBottomBitmap);
		
		currentValue = value;
		
		dirty = true;
	};
	
	this.render = function(progress) { // void
		if (!dirty) {
			return;
		}
		if (progress < 0.5) {
			topDarkShape.alpha = progress * 2;
			topContainer.scaleY = 1 - progress * 2;
			// topBitmap.scaleY = 1 - progress * 2;
		} else if (topContainer.visible && progress >= 0.5) {
			//switch
			topContainer.visible = false;
			topContainer.scaleY = 1;
			// topBitmap.visible = false;
			// topBitmap.scaleY = 1;
			overBottomBitmap.visible = true;
			overBottomBitmap.scaleY = 0;	
		} else if (progress > 0.5 && progress < 1) {
			overBottomBitmap.scaleY = (progress - 0.5) * 2;
		} else {
			overBottomBitmap.scaleY = 1;
			dirty = false;
		}
	};
	
	/**
	 * PRIVATE METHODS
	 *
	 */
	
	
	/**
	 * EVENT HANDLERS
	 *
	 */
	
};