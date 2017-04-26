<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/classie.js"></script>
<script type="text/javascript" src="assets/js/selectFx.js"></script>
<script type="text/javascript" src="assets/js/fullscreenForm.js"></script>
<script type="text/javascript" src="assets/js/svgcheckbx.js"></script>
<script type="text/javascript" src="assets/js/new.js"></script>
<script type="text/javascript" src="assets/js/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="assets/js/contacto.js"></script>


<script type="text/javascript">
	(function($){
		$(".texto-login input").focus(function(){
			$(this).parent().parent().find(".icono-login").css("background-color","#1c4f8e");
		})

		$(".texto-login input").blur(function(){
			$(this).parent().parent().find(".icono-login").css("background-color","transparent");
		})
	})(jQuery)
</script>