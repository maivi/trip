


$(document).ready(function(){
	$(".submit1").click(function(e){

		e.preventDefault();

		console.log("CLICK");

		$(".login").css("display","none");

		$(".reg").css("display","block");

		$(".login").animate({left: "-250%"},5000);
	});




});
