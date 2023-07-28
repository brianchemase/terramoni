<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Brian Anikayi">
	<meta name="keywords" content="Sisdo Intranet System">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('dash/img/icons/icon-48x48.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>TerraMoni</title>

	<!-- <link href="css/app.css" rel="stylesheet"> -->
    <link href="{{asset('dash/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('dash/css/dash.css')}}" rel="stylesheet">
	<!-- BEGIN SETTINGS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />


	<!-- BEGIN SETTINGS -->
	<script src="{{asset('dash/js/settings.js')}}"></script>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

        <!-- side bar start -->
              @include('agents_portal.inc.sidebar')
         <!-- side bar end -->

		<div class="main">

            <!-- top bar link -->

            @include('agents.inc.header')
			
            <!-- end of top bar -->

            @yield('content')

			

            @include('agents.inc.footer')
            
		</div>
	</div>

	
    <script src="{{asset('dash/js/app.js')}}"></script>
	<script src="{{asset('dash/js/datatables.js')}}"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables with Buttons
			var datatablesButtons = $("#datatables-buttons").DataTable({
				responsive: true,
				lengthChange: !1,
				buttons: ["copy", "print"]
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
		});
	</script>
	<script>
		// DataTables with Column Search by Text Inputs
		document.addEventListener("DOMContentLoaded", function() {
			// Setup - add a text input to each footer cell
			$("#datatables-column-search-text-inputs tfoot th").each(function() {
				var title = $(this).text();
				$(this).html("<input type=\"text\" class=\"form-control\" placeholder=\"Search " + title + "\" />");
			});
			// DataTables
			var table = $("#datatables-column-search-text-inputs").DataTable();
			// Apply the search
			table.columns().every(function() {
				var that = this;
				$("input", this.footer()).on("keyup change clear", function() {
					if (that.search() !== this.value) {
						that
							.search(this.value)
							.draw();
					}
				});
			});
		});
		// DataTables with Column Search by Select Inputs
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-column-search-select-inputs").DataTable({
				initComplete: function() {
					this.api().columns().every(function() {
						var column = this;
						var select = $("<select class=\"form-control\"><option value=\"\"></option></select>")
							.appendTo($(column.footer()).empty())
							.on("change", function() {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
								column
									.search(val ? "^" + val + "$" : "", true, false)
									.draw();
							});
						column.data().unique().sort().each(function(d, j) {
							select.append("<option value=\"" + d + "\">" + d + "</option>")
						});
					});
				}
			});
		});
	</script>

<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});
		});
	</script>

	
	

</body>

</html>