
<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from salero.dexignzone.com/xhtml/page-error-403.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Apr 2024 17:57:03 GMT -->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Salero:Restaurant Admin Bootstrap 5 Template">
	<meta property="og:title" content="Salero:Restaurant Admin Bootstrap 5 Template">
	<meta property="og:description" content="Salero:Restaurant Admin Bootstrap 5 Template">
	<meta property="og:image" content="page-error-404.html">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Salero Restaurant Admin Bootstrap 5 Template</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
					<div class="error-page">
						<div class="error-inner text-center">
							<div class="dz-error" data-text="403">403</div>
							<h4 class="error-head"><i class="fa fa-times-circle text-danger"></i> Accès Interdit!</h4>
							<p class="error-head">Vous n'avez pas la permission pour voir cette ressource.</p>
							<div>
								<a href="#" class="btn btn-secondary" onclick="goBack()">Retour</a>

							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script>
    function goBack() {
        // Enregistrer l'URL actuelle dans le stockage local
        localStorage.setItem('previousPage', window.location.href);
        // Rediriger vers la page d'erreur 403
        window.location.href = "{{ route('errors.error-403') }}"; // Remplacez 'error.403' par le nom de votre route vers la page d'erreur 403
    }
</script>
<script>
    function goBack() {
        // Récupérer l'URL enregistrée dans le stockage local
        var previousPage = localStorage.getItem('previousPage');
        // Vérifier si une URL précédente a été enregistrée
        if (previousPage) {
            // Rediriger vers l'URL précédente
            window.location.href = previousPage;
        } else {
            // Si aucune URL précédente n'a été enregistrée, rediriger vers la page d'accueil par défaut
            window.location.href = "{{ route('admin.plats.index') }}"; // Remplacez 'home' par le nom de votre route vers la page d'accueil
        }
    }
</script>

<script src="vendor/global/global.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/deznav-init.js"></script>
</body>

<!-- Mirrored from salero.dexignzone.com/xhtml/page-error-403.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Apr 2024 17:57:03 GMT -->
</html>
