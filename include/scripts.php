<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/new.js"></script>
<script type="text/javascript" src="assets/js/classie.js"></script>
<script type="text/javascript" src="assets/js/selectFx.js"></script>
<script type="text/javascript" src="assets/js/fullscreenForm.js"></script>
<script type="text/javascript" src="assets/js/svgcheckbx.js"></script>
<script type="text/javascript" src="assets/js/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="assets/js/Chart.js"></script>



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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-98257563-1', 'auto');
  ga('send', 'pageview');
</script>

<script>
		var doughnutData = [
				{
					value: 30,
					color:"#F7464A"
				},
				{
					value : 50,
					color : "#46BFBD"
				},
				{
					value : 100,
					color : "#FDB45C"
				},
				{
					value : 40,
					color : "#949FB1"
				},

				{
					value : 10,
					color : "#2ecc71"
				},

				{
					value : 12,
					color : "#3498db"
				},

				{
					value : 35,
					color : "#9b59b6"
				},

				{
					value : 28,
					color : "#34495e"
				},

				{
					value : 2,
					color : "#f1c40f"
				},

				{
					value : 8,
					color : "#e67e22"
				},

				{
					value : 4,
					color : "#e74c3c"
				},

				{
					value : 50,
					color : "#ecf0f1"
				},

				{
					value : 20,
					color : "#95a5a6"
				},

				{
					value : 78,
					color : "#f39c12"
				},

				{
					value : 400,
					color : "#d35400"
				},

				{
					value : 40,
					color : "#c0392b"
				},


				{
					value : 120,
					color : "#4D5360"
				}
			
			];

	var myDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(doughnutData);
	
</script>