$(document).ready(function(){
	// TODO: get missing Parameters from blueprints.yaml via DOM (slickslider.html.twig)
	var verbose = true;
	var slidesToShow = $('#slidesToShow').text();
	if (slidesToShow < 1)
		slidesToShow = 1;
	if (verbose)	console.log("slidesToShow:", slidesToShow);
	var fade = $("#fade").text();
	if (fade < 1)	
		fade = false;	
	else
		fade = true;
	if (verbose)	console.log("fade:", fade);
	var autoplaySpeed = $("#autoplaySpeed").text();
	if (autoplaySpeed < 1)	
		autoplaySpeed = 4000;	
	if (verbose)	console.log("autoplaySpeed:", autoplaySpeed);
	var speed = $("#speed").text();
	if (speed < 1)	
		speed = 2000;	
	if (verbose)	console.log("speed:", speed);
	$(".slider").slick({"slidesToShow": slidesToShow, "slidesToScroll": 1, "autoplay": true, "autoplaySpeed": autoplaySpeed, "arrows": false, "fade": fade, "speed": speed, "pauseOnFocus": false,"pauseOnHover": false});
});
