<?php
	date_default_timezone_set("Europe/Berlin");		
	
	$amreiCity = "Bangkok";
	$stanCity = "Leipzig";
	
	$amreiPio = getTimes(getCoords($amreiCity));
	$stanPio = getTimes(getCoords($stanCity));
	
	$amreiWeather = getWeather($amreiCity, "/wetter-icons/");
	$stanWeather = getWeather($stanCity, "/wetter-icons/");
	
	$date = new DateTime($amreiPio['time']);
	$amreiTime = $date->format('H:i');
	$date = new DateTime($stanPio['time']);
	$stanTime = $date->format('H:i');
	
	$amreiPio["daylight"] = daylight($amreiPio);
	$stanPio["daylight"] = daylight($stanPio);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>New Web Project</title>
        
        <link media="all" type="text/css" href="resources/css/jquery-ui-1.8.11.custom.css" rel="stylesheet">
        <link media="all" type="text/css" href="resources/css/daynight.css" rel="stylesheet">
        <link media="all" type="text/css" href="resources/css/style.css" rel="stylesheet">
        
        <link href='http://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
        
		<script type="text/javascript" src="resources/js/jquery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="resources/js/jquery/jquery-ui-1.8.11.custom.min.js"></script>
		<script type="text/javascript" src="resources/js/jquery/jquery.progressbar.min.js"></script>

		<script type="text/javascript" src="resources/js/countdown/utils.js?v=4"></script>
		<script type="text/javascript" src="resources/js/countdown/easel.js"></script>
		<script type="text/javascript" src="resources/js/countdown/Countdown.js?v=4"></script>
		<script type="text/javascript" src="resources/js/countdown/Application.js?v=4"></script>
		
		
		<script type="text/javascript" src="resources/js/font/typeface-0.15.js"></script>
		<script type="text/javascript" src="resources/js/font/sf_movie_poster_bold.typeface.js"></script>
		<script type="text/javascript" src="resources/js/font/helvetiker_regular.typeface.js"></script>
		
		<script type="text/javascript">
	
			
			$(document).ready(function() {
				
				
				
				var now = Date.parse(new Date());
				var start = Date.parse(new Date(2011,9-1,3,16,00,00));
				var meeting = Date.parse(new Date(2011,12-1,19,16,55,00));
				
				setCheck(now);
				
				var percent = (meeting - now) / (meeting-start);
				
				scaleHeart(percent);
				if(now >= start) {
					
					
					var timelineWidth = parseInt(percent * 700);
					var timeLinePast = (700) * percent;
					
					if(timelineWidth < 150) {
						$('#status').css('width', 300);
						$('#together').show();
						$('#amrei').hide();
						$('#stan').hide();
						
						var arrowWidth = (timeLinePast / 2);
						
						$('#together .arrow-left').css('left', 137 - arrowWidth );
						$('#together .arrow-right').css('left', 60 - 75 + arrowWidth);
						
					} else {
						$('#status').css('width', timelineWidth);	
					}
					
					if(((700 - timeLinePast) / 2) > 1) {
						var right = ((700 - timeLinePast) / 2) -1;
					} else {
						var right = ((700 - timeLinePast) / 2);	
					}
					
					$('#timeline .left').css('width', ( 700 - timeLinePast)/ 2);
					$('#timeline .right').css('width', right);
					$('#timeline .middle').css('width', timeLinePast);
					
				} else {
					$('#status').css('width', 680);	
					$('#timeline .left').css('width', 0);
					$('#timeline .right').css('width', 0);
					$('#timeline .middle').css('width', 700);
				}
				
				$('#amrei').click(function() {showWeather(this)});
				$('#stan').click(function() {showWeather(this)});
				$('#together #amrei').click(function() {showWeather(this)});
				$('#together #stan').click(function() {showWeather(this)});
				
				
				
			});
			
			function showWeather(thisEl) {
	
				if($(thisEl).find('.weather').is(":visible")) {
						$(thisEl).find('.weather').slideUp('slow');
					} else {
						$(thisEl).find('.weather').slideDown('slow');
					}
			}
			
			function setCheck(now) {
				var monthTimeOne = Date.parse(new Date(2011,11-1,19,16,00,00));
				var monthTimeTwo = Date.parse(new Date(2011,10-1,19,16,00,00));
				var monthTimeThree = Date.parse(new Date(2011,9-1,19,16,00,00));
	
				if(now > monthTimeThree) {
					$('.timeline-content div.l3').find('img').hide();
					$('.timeline-content div.r3').find('img').hide();
					$('.timeline-content div.l3').find('img.check').show();
					$('.timeline-content div.r3').find('img.check').show();
					$('.timeline-content div.l3').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
					$('.timeline-content div.r3').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
					
				}
				
				if(now > monthTimeTwo) {
					$('.timeline-content div.l2').find('img').hide();
					$('.timeline-content div.r2').find('img').hide();
					$('.timeline-content div.l2').find('img.check').show();
					$('.timeline-content div.r2').find('img.check').show();
					$('.timeline-content div.l2').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
					$('.timeline-content div.r2').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
				}
				
				if(now > monthTimeOne) {
					$('.timeline-content div.l1').find('img').hide();
					$('.timeline-content div.r1').find('img').hide();
					$('.timeline-content div.l1').find('img.check').show();
					$('.timeline-content div.r1').find('img.check').show();
					$('.timeline-content div.l1').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
					$('.timeline-content div.r1').css('backgroundImage','url("resources/img/timelinedot_ready.png")');
				}
			}
			
			function scaleHeart(prcnt) {
			
				var p =100 - 100 * prcnt;
				//$(".timeline-content div.h img").effect("scale", { percent: p, from: {heigth: 0, width: 0}, origin: ['middle','center']}, 1000);
			}
			
  			 $(window).resize(function(){
     		  	$('#wallLeft').css('width',$(document).width()/2).css('height',$(document).height());
				$('#wallRight').css('width',$(document).width()/2).css('height',$(document).height()).css('left',$(document).width()/2);			
				$('#progressbar').css('top',$(document).height()-50).css('left',$(document).width()/2-250);
				$('#comingSoon').css('top',$(document).height()-50).css('left',$(document).width()/2-250);
				
				
   			});
			
			$(function(){
				if (!('console' in window) || !('log' in window.console)) {
					window.console = {log:function(){}};
				}
		
				var belgiumTime = getTotalTime();
	
				var app = new Application();
				app.init();
					
				$(window).load(function(){
				$('h2').show();
			});
			
			
			});	
			
		</script>
        
		
    </head>
    <body>
		
    	
        <div id="wrapper">
            
                <div id="background" style="width: 100%; height: 400px;">
                
                    <div class="left-background height <?php echo $amreiPio["daylight"];?>"></div>
                    <div class="middle-background height <?php echo $amreiPio["daylight"];?>-<?php echo $stanPio["daylight"];?>"></div>
                    <div class="right-background height <?php echo $stanPio["daylight"];?>"></div>
                    
                </div>	
                <div id="container">
                    <div id="countdownWrapper">
                        <div id="countdown">
                            <canvas height='200' width='740' id="scene"></canvas>		
                            <div id="staticscene">
                                <div id="digit_1"></div>
                                <div id="digit_2"></div>
                                <div id="digit_3"></div>
                                <div id="digit_4"></div>
                                <div id="digit_5"></div>
                                <div id="digit_6"></div>
                                <div id="digit_7"></div>
                                <div id="digit_8"></div>
                            </div>
                            <dic class="description">
                            	<div class="d">Tage</div>
                                <div class="h">Stunden</div>	
                                <div class="m">Minuten</div>	
                                <div class="s">Sekunden</div>				
                        </div>
                    </div>
                    <div id="leipzig" class="schilder"><img src="resources/img/leipzig.png"></div>
                    <div id="bangkok" class="schilder"><img src="resources/img/bangkok.png"></div>
                    <div id="status">
                    
                        <div id="amrei">
                        	<div class="clock"><?php echo $amreiTime;?> Uhr</div>
                            <div class="weather" style="display: none">
                            	<img src="http://www.google.com<?php echo $amreiWeather['icon']; ?>"></img>
								
                                <div class="temp"><?php	echo $amreiWeather['temperatur']?>°C</div>
                                <div class="title"><?php	echo $amreiWeather['zustand']?></div>
                                <div class="stat">
									<?php	echo $amreiWeather['wind']?>
                                    <?php	echo $amreiWeather['luftfeuchtigkeit']?> 
                                </div>
                                <div class="sunrise">
									<?php
										$date = new DateTime($amreiPio['sunrise']);
										echo "Aufgang: ".$date->format('H:i')." Uhr";	
									?>
                                    
                                </div>
                                <div class="sunset">
									<?php	
										$date = new DateTime($amreiPio['sunset']);
										echo "Untergang: ". $date->format('H:i')." Uhr";
									?>
                                </div>
                            </div>
                            <div class="cl"></div>
  							<div class="arrow"></div>
                        </div>
                       
                        <div id="stan">
                     		<div class="clock"><?php echo $stanTime;?> Uhr</div>
                            <div class="weather" style="display: none">
                            	<img src="http://www.google.com<?php echo $stanWeather['icon']; ?>"></img>
								
                                <div class="temp"><?php	echo $stanWeather['temperatur']?>°C</div>
                                <div class="title"><?php	echo $stanWeather['zustand']?></div>
                                <div class="stat">
									<?php	echo $stanWeather['wind']?>
                                    <?php	echo $stanWeather['luftfeuchtigkeit']?> 
                                </div>
                                <div class="sunrise">
									<?php
										$date = new DateTime($stanPio['sunrise']);
										echo "Aufgang: ".$date->format('H:i')." Uhr";	
									?>
                                    
                                </div>
                                <div class="sunset">
									<?php	
										$date = new DateTime($stanPio['sunset']);
										echo "Untergang: ". $date->format('H:i')." Uhr";
									?>
                                </div>
                            </div>
                            <div class="cr"></div>
  							<div class="arrow"></div>
                        </div>
                        
                        <div id="together" style="display: none">
                        	 <div id="amrei" class="twin">
                                <div class="clock"><?php echo $amreiTime;?> Uhr</div>
                                <div class="weather" style="display: none">
                                    <img src="http://www.google.com<?php echo $amreiWeather['icon']; ?>"></img>
                                    
                                    <div class="temp"><?php	echo $amreiWeather['temperatur']?>°C</div>
                                    <div class="title"><?php	echo $amreiWeather['zustand']?></div>
                                    <div class="stat">
                                        <?php	echo $amreiWeather['wind']?>
                                        <?php	echo $amreiWeather['luftfeuchtigkeit']?> 
                                    </div>
                                    <div class="sunrise">
                                        <?php
                                            $date = new DateTime($amreiPio['sunrise']);
                                            echo "Aufgang: ".$date->format('H:i')." Uhr";	
                                        ?>
                                        
                                    </div>
                                    <div class="sunset">
                                        <?php	
                                            $date = new DateTime($amreiPio['sunset']);
                                            echo "Untergang: ". $date->format('H:i')." Uhr";
                                        ?>
                                    </div>
                                </div>
                                <div class="cl"></div>
                                <div class="arrow arrow-left"></div>
                            </div>
                             <div id="stan" class="twin">
                                <div class="clock"><?php echo $stanTime;?> Uhr</div>
                                <div class="weather" style="display: none">
                                    <img src="http://www.google.com<?php echo $stanWeather['icon']; ?>"></img>
                                    
                                    <div class="temp"><?php	echo $stanWeather['temperatur']?>°C</div>
                                    <div class="title"><?php	echo $stanWeather['zustand']?></div>
                                    <div class="stat">
                                        <?php	echo $stanWeather['wind']?>
                                        <?php	echo $stanWeather['luftfeuchtigkeit']?> 
                                    </div>
                                    <div class="sunrise">
                                        <?php
                                            $date = new DateTime($stanPio['sunrise']);
                                            echo "Aufgang: ".$date->format('H:i')." Uhr";	
                                        ?>
                                        
                                    </div>
                                    <div class="sunset">
                                        <?php	
                                            $date = new DateTime($stanPio['sunset']);
                                            echo "Untergang: ". $date->format('H:i')." Uhr";
                                        ?>
                                    </div>
                                </div>
                                <div class="cr"></div>
                                <div class="arrow arrow-right"></div>
                            </div>
                            
                        </div>
                    </div>
                    
                     <div id="timeline">
                        <div class="left"></div>
                        <div class="middle"></div>
                        <div class="right"></div>
                    </div>
                        
                    <div  class="timeline-content">
                    	<!--<div class="anika">
                       		<img src="resources/img/anika.png">
                       </div>-->
                    
                       <div class="l3">
                       		<img src="resources/img/m3.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       	</div>
                       <div class="l2">
                       		<img src="resources/img/m2.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       	</div>
                       <div class="l1">
                       		<img src="resources/img/m1.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       	</div>
                       <div class="h"><img src="resources/img/heart.png"></div>
                       <div class="r1">
                       		<img src="resources/img/m1.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       </div>
                       <div class="r2">
                       		<img src="resources/img/m2.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       </div>
                       <div class="r3">
                       		<img src="resources/img/m3.png">
                       		<img src="resources/img/check.png" style="display:none;" class="check">
                       </div>
                       
                    </div>
                    
                    <?php 
                    
                        
                        
                    ?>
                    </div>
                
                <div id="landscape"></div>
           </div>
    	</div>
    	<script type="text/javascript">
    	
    	  var _gaq = _gaq || [];
    	  _gaq.push(['_setAccount', 'UA-23555366-2']);
    	  _gaq.push(['_trackPageview']);
    	
    	  (function() {
    	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    	  })();
    	
    	</script>
    </body>
</html>

<?php

	function getCoords($place_name) {

		$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
		$yql_query = "select * from geo.places where text='" .$place_name. "'";  
	  	$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query) . "&format=xml";
	
		 $phpObj = simplexml_load_file($yql_query_url);
		 	
		if(!is_null($phpObj->results)){  
	 		foreach($phpObj->results->place as $place){ 
			 
				$pio["lat"] = "".$place->centroid->latitude;
				$pio["lng"]	= "".$place->centroid->longitude;
				$pio["country"]	= "".$place->country;
				$pio["name"]	= "".$place->name;
				$pio["woeid"]	= "".$place->woeid;

				return $pio;
			}   	
		}
		else {
			getCoords($place_name);
			
		}	
	}
	
	function  getWeather($ort="", $icons_src="/", $sprache="de")
	{
		$icons_google = "/ig/images/weather/";
		
		
		$api = simplexml_load_string(utf8_encode(file_get_contents("http://www.google.com/ig/api?weather=".$ort."&hl=".$sprache)));
		
		$wetter = array();
		
		if(!is_null($wetter)) {
			// Allgemeine Informationen
			$wetter['stadt'] = $api->weather->forecast_information->city->attributes()->data;
			$wetter['datum'] = $api->weather->forecast_information->forecast_date->attributes()->data;
			$wetter['zeit'] = $api->weather->forecast_information->current_date_time->attributes()->data;
			
			// Aktuelles Wetter
			$wetter['zustand'] = $api->weather->current_conditions->condition->attributes()->data;
			$wetter['temperatur'] = $api->weather->current_conditions->temp_c->attributes()->data;
			$wetter['luftfeuchtigkeit'] = $api->weather->current_conditions->humidity->attributes()->data;
			$wetter['wind'] = $api->weather->current_conditions->wind_condition->attributes()->data;
			$wetter['icon'] = $api->weather->current_conditions->icon->attributes()->data;
		} else {
			getWeather($ort, $icons_src, $sprache);	
		}
		

		return $wetter;
	}
	
	function getTimes($pio) {
		
		$ws_geonmaes_query_url = "http://ws.geonames.org/timezone?lat=".$pio['lat']."&lng=".$pio['lng'];
		
		$phpObj = simplexml_load_file($ws_geonmaes_query_url);

		 	
		if(!is_null($phpObj->timezone)){  
	 		foreach($phpObj->timezone as $time){ 
			 	$pio["timezoneId"] = "".$time->timezoneId;
				$pio["time"] = "".$time->time;
			}
			 	
		}
		else {
			getTimes($pio);
			

		}
		
		
		
		//set systemtimezone
		date_default_timezone_set($pio["timezoneId"]);
		
		$date = new DateTime($pio['time']);
		$day = $date->format('d');
		
		$date = new DateTime($pio['time']);
		$month = $date->format('m');
		
		//doc : http://www.earthtools.org/webservices.htm
		$et_query_url = "http://www.earthtools.org/sun/" . $pio['lat'] . "/" . $pio['lng'] . "/" . $day . "/" . $month . "/99/0";
		
		$phpObj = simplexml_load_file($et_query_url);
		 	
		if(!is_null($phpObj)){  
	 		foreach($phpObj->morning as $time){ 
			 	$pio["sunrise"] = "".$time->sunrise;
			}  
			foreach($phpObj->evening as $time){ 
				$pio["sunset"] = "".$time->sunset;
			}  	
		}
		else {
			getTimes($pio);
			
		}	
		
		return $pio;
		
	}

	function daylight($pio) {

		
		//set systemtimezone
		date_default_timezone_set($pio["timezoneId"]);

		$time = strtotime($pio["time"]);
		$sunrise = strtotime($pio["sunrise"]);
		$sunset = strtotime($pio["sunset"]);
	
		if ( $sunrise < $sunset && $time > $sunset ){
			$sunrise = $sunrise + 24 * 60 * 60;	
		}
		
		if($time > ($sunrise - 30 * 60)  && $time <  $sunrise) {
			return "sunrise";
			
			
			
		}
		if($time > $sunrise && $time <  ($sunset - 30 * 60)) {
			return "day";
			
			
		}
		if($time > ($sunset - 30 * 60) && $time <  $sunset) {
			return "sunset";
			
			
		}
		if($time > $sunset && $time <  ($sunrise - 30 * 60)) {
			return "night";
			
			
		}
		
		return "night";
		
	}
?>

