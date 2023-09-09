<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Brian Anikayi">
	<meta name="keywords" content="TerraMoni System">
	<meta name="csrf-token" content="{{ csrf_token() }}">

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
	<!-- <script src="{{asset('dash/js/settings.js')}}"></script> -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body data-theme="light">

	<div class="wrapper">

		<!-- side bar start -->
		@include('agents.inc.sidebar')
		<!-- side bar end -->

		<div class="main">

			<!-- top bar link -->

			@include('agents.inc.header')

			<!-- end of top bar -->

			@yield('content')



			@include('agents.inc.footer')

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{asset('dash/js/app.js')}}"></script>
	<script src="{{asset('dash/js/datatables.js')}}"></script>
	<script src="{{asset('registration/js/lga.min.js')}}"></script>
	<script type="text/javascript" src="auth/js/vanilla-tilt.js"></script>


	<script>
		$(document).ready(function() {
			$('.delete-role').on('click', function(e) {
			
				e.preventDefault();

				const resourceId = $(this).data('id');

				if (confirm('Are you sure you want to delete this role?')) {
					$.ajax({
						type: 'POST',
						url: `/admins/delete-role/${resourceId}`,
						data: {
							_token: '{{ csrf_token() }}',
						},
						success: function(response) {
							// Handle success (e.g., remove the deleted item from the view)
							// Reload the current page
							location.reload();
						},
						error: function(error) {
							// Handle error (e.g., show an error message)
							console.error('Error:', error);
						},
					});
				}
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#validationDefault04').on('change', function() {
				var selectedValue = $(this).val();
				//alert('Selected value: ' + selectedValue);

				// Get the CSRF token value from the meta tag
				var csrfToken = $('meta[name="csrf-token"]').attr('content');

				// Set the CSRF token in the default AJAX headers
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': csrfToken
					}
				});

				var url = '/admins/get-permissions-role/' + selectedValue;

				$.ajax({
					url: url,
					method: 'POST',
					dataType: 'JSON',
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {
						console.log(response);
						$('#checkboxContainer').empty();
						// Assuming the response is an array of selected values
						var selectedValues = response.selectedValues;

						// Create checkboxes dynamically based on the selected values
						var checkboxContainer = $('#checkboxContainer');

						$.each(response.Permissions, function(index, option) {
							var isChecked = $.inArray(option.id, selectedValues) !== -1;
							var checkbox = '<div- class="form-group col-sm-4">';
							checkbox += '<input class="form-check-input" type="checkbox" name="permissions[]" value="' + option.name + '" ' + (isChecked ? 'checked' : '') + '>';
							checkbox += '<label class="form-check-label">' + option.name + '</label>';
							checkbox += '</div>';
							$('#checkboxContainer').append(checkbox);
						});

						// $("#update-user-form").trigger("reset");
						// $("error").hide();
						// $("#success").empty();
						// errorsHtml = '<div>' + response.message + '</div>'
						// $(errorsHtml).appendTo('#success');
						// $("#success").show();
					},
					error: function(response) {
						console.log(response);
						if (response.status === 422) {
							//process validation errors here.
							var errors = response.responseJSON.errors;
							// $("#error").empty();
							// errorsHtml = '<ul>';
							// $.each(errors, function(key, value) {
							// 	errorsHtml += '<li>' + value[0] + '</li>';
							// });
							// errorsHtml += '</ul>';
							// $(errorsHtml).appendTo('#error');
							// $("#success").hide();
							// $("#error").show();
						}
					}
				});
			});
		});
	</script>

	<script>
		document.querySelectorAll('.menu-drop').forEach(item => {
			item.addEventListener('click', function(event) {
				event.stopPropagation(); // Prevent dropdown from closing
			});
		});
	</script>


	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Choices.js
			new Choices(document.querySelector(".choices-single"));
			new Choices(document.querySelector(".choices-multiple"));
			// Flatpickr
			flatpickr(".flatpickr-minimum");
			flatpickr(".flatpickr-datetime", {
				enableTime: true,
				dateFormat: "Y-m-d H:i",
			});
			flatpickr(".flatpickr-human", {
				altInput: true,
				altFormat: "F j, Y",
				dateFormat: "Y-m-d",
			});
			flatpickr(".flatpickr-multiple", {
				mode: "multiple",
				dateFormat: "Y-m-d"
			});
			flatpickr(".flatpickr-range", {
				mode: "range",
				dateFormat: "Y-m-d"
			});
			flatpickr(".flatpickr-time", {
				enableTime: true,
				noCalendar: true,
				dateFormat: "H:i",
			});
		});
	</script>

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

	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {},
			Tawk_LoadStart = new Date();
		(function() {
			var s1 = document.createElement("script"),
				s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/64e712fe94cf5d49dc6c38e7/1h8ja4d62';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->




</body>

</html>