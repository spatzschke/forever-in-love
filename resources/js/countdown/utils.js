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

function getRemainingTime() { // Object
	var now = new Date();
	// 17 february
	// 30 march, 29 to fix February 28-day-month 
	var future = new Date(2011, 12-1, 19, 16, 55, 0);
	return getDateDifference(now, future);
}

function getTotalTime(y, m, d) { // Object
	// 13 june
	y = y || 2014;
	m = m || 6;
	d = d || 12;
	var now = new Date();
	var past = new Date(y, m, d, 8, 0, 0); //yr_num, mo_num(0-11), day_num(1-31) [hr_num, min_num, sec_num]
	return getDateDifference(past, now);
}

function getDateDifference(date1, date2) { // Object
	var diff = (Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate(), date2.getHours(), date2.getMinutes(), date2.getSeconds()) - Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate(), date1.getHours(), date1.getMinutes(), date1.getSeconds())) / 1000; // in seconds
	diff = Math.abs(diff);
	var days = Math.floor(diff/(24 * 60 * 60));
	diff -= days * (24 * 60 * 60);
	var hours = Math.floor(diff/(60 * 60));
	diff -= hours * (60 * 60);
	var minutes = Math.floor(diff/60);
	diff -= minutes * 60;
	var seconds = Math.floor(diff);
	return {d:days, h:hours, m:minutes, s:seconds};
}

function formatNumber(number) { // String
	return (number < 10 ? '0' : '') + number;
}


function formatNumberHundret(number) {
		number = (number < 10 ? '00' : '') + number;
		number = (number < 100 ? '0' : '') + number;

	
	
	
	return number;
}