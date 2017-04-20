<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>


<script type="text/javascript">
	(function($){
		$(".texto-login input").focus(function(){
			$(this).parent().parent().find(".icono-login").css("background-color","#34495e");
		})

		$(".texto-login input").blur(function(){
			$(this).parent().parent().find(".icono-login").css("background-color","transparent");
		})

		$(".send").click(function(){
			var login = $(this).parent().parent();
			login.animate({
				left: "-250%"
			});
			$(".contenedor-header").animate({
				right: "0px"
			})
			$(".icono-header").animate({
				left: "0px"
			})
		})
	})(jQuery)
</script>