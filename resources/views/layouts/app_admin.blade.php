<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from salero.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Apr 2024 17:53:11 GMT -->
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

	<link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css') }}" type="text/css" media="all" />
<link href="{{ asset('assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

<!-- Style css -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">


</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
		<div class="loader-wrapper">
			<div class="loader-box">
				<div class="icon">
				  <i class="fas fa-utensils"></i>
				</div>
			</div>
		</div>
	</div>	 -->
	<div id="preloader">
		<div class="loader-wrapper">
			<div class="loader-box">
				<div class="icon">
				  <i class="fas fa-utensils"></i>
				</div>
			</div>
		</div>
	</div>

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
				<svg class="logo-abbr" width="50" height="57" viewBox="0 0 50 57" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 7C0 3.13401 3.13401 0 7 0H43C46.866 0 50 3.13401 50 7V43C50 46.866 46.866 50 43 50H7C3.13401 50 0 46.866 0 43V7Z" fill="#0C14FE"/>
					<path d="M27.8958 8.32118L49.6278 26.9793V56.2579L18.9467 34.8688L28.9669 22.5963L27.8958 8.32118Z" fill="#0E15DF"/>
					<path d="M25.248 19.0703C22.7192 19.0703 20.6618 21.126 20.6587 23.6539H29.8373C29.8341 21.126 27.7766 19.0703 25.248 19.0703Z" fill="white"/>
					<path d="M25.248 9.95406C18.36 9.95406 12.7562 15.5579 12.7562 22.4458C12.7562 25.1845 13.6262 27.7844 15.2721 29.9646C16.7937 31.98 18.9285 33.511 21.3126 34.3037L24.4914 39.617C24.6506 39.8831 24.9379 40.046 25.248 40.046C25.558 40.046 25.8453 39.8831 26.0045 39.617L29.1834 34.3037C31.5674 33.511 33.7022 31.98 35.2238 29.9646C36.8697 27.7844 37.7397 25.1845 37.7397 22.4458C37.7397 15.5579 32.1359 9.95406 25.248 9.95406ZM31.9818 25.4172H18.5141C18.0272 25.4172 17.6325 25.0225 17.6325 24.5356C17.6325 24.0487 18.0272 23.654 18.5141 23.654H18.8954C18.8983 20.4528 21.2812 17.7989 24.3664 17.3686V17.2599C24.3664 16.773 24.7611 16.3783 25.248 16.3783C25.7349 16.3783 26.1296 16.773 26.1296 17.2599V17.3686C29.2148 17.7988 31.5977 20.4528 31.6006 23.654H31.982C32.4688 23.654 32.8636 24.0487 32.8636 24.5356C32.8636 25.0225 32.4687 25.4172 31.9818 25.4172Z" fill="white"/>
				</svg>
				<svg class="brand-title" width="108" height="47" viewBox="0 0 108 47" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M16.2728 15.4619C16.2728 8.61908 6.16869 10.2206 6.16869 6.66814C6.16869 5.38693 7.07136 4.77544 8.26522 4.80456C9.60467 4.83368 10.5365 5.61987 10.6238 6.93021H16.0107C15.8069 3.02832 12.8077 0.815319 8.35258 0.815319C4.07215 0.815319 0.898233 2.97009 0.898233 6.84285C0.839996 14.0934 11.0606 12.0551 11.0606 15.8405C11.0606 17.0343 10.1288 17.7623 8.67288 17.7623C7.27519 17.7623 6.28516 17.0052 6.13957 15.4328H0.839996C0.985589 19.5676 4.42158 21.7515 8.81847 21.7515C13.5939 21.7515 16.2728 18.8979 16.2728 15.4619ZM18.3402 13.3945C18.3402 18.5194 21.5142 21.7807 25.4743 21.7807C27.8911 21.7807 29.6091 20.6742 30.5118 19.2473V21.5477H35.491V5.29957H30.5118V7.59993C29.6382 6.17313 27.9202 5.06662 25.5034 5.06662C21.5142 5.06662 18.3402 8.26966 18.3402 13.3945ZM30.5118 13.4236C30.5118 16.0152 28.852 17.442 26.9593 17.442C25.0957 17.442 23.4069 15.9861 23.4069 13.3945C23.4069 10.803 25.0957 9.40528 26.9593 9.40528C28.852 9.40528 30.5118 10.8321 30.5118 13.4236ZM39.1017 21.5477H44.081V0H39.1017V21.5477ZM54.8549 9.05586C56.5146 9.05586 57.9123 10.075 57.9123 11.8512H51.681C51.9721 10.0459 53.2242 9.05586 54.8549 9.05586ZM62.6295 16.1608H57.3299C56.9223 17.0343 56.1361 17.7332 54.7384 17.7332C53.1369 17.7332 51.8265 16.7432 51.6518 14.6175H62.9207C62.9789 14.1225 63.0081 13.6275 63.0081 13.1616C63.0081 8.21142 59.6594 5.06662 54.9131 5.06662C50.0794 5.06662 46.7017 8.26966 46.7017 13.4236C46.7017 18.5776 50.1377 21.7807 54.9131 21.7807C58.9606 21.7807 61.8433 19.3347 62.6295 16.1608ZM70.608 14.006C70.608 11.2106 71.9766 10.3953 74.3352 10.3953H75.7037V5.12486C73.5198 5.12486 71.7436 6.2896 70.608 8.00759V5.29957H65.6287V21.5477H70.608V14.006ZM93.9902 13.4236C93.9902 8.26966 90.3212 5.06662 85.5458 5.06662C80.7995 5.06662 77.1014 8.26966 77.1014 13.4236C77.1014 18.5776 80.7121 21.7807 85.4876 21.7807C90.263 21.7807 93.9902 18.5776 93.9902 13.4236ZM82.168 13.4236C82.168 10.6574 83.7404 9.37617 85.5458 9.37617C87.2929 9.37617 88.9235 10.6574 88.9235 13.4236C88.9235 16.1608 87.2638 17.4711 85.4876 17.4711C83.6822 17.4711 82.168 16.1608 82.168 13.4236Z" fill="#222222"/>
				<path d="M6.424 42L4.348 38.496H2.8V42H1.96V33.612H4.48C5.416 33.612 6.124 33.836 6.604 34.284C7.092 34.732 7.336 35.32 7.336 36.048C7.336 36.656 7.16 37.176 6.808 37.608C6.464 38.032 5.952 38.308 5.272 38.436L7.432 42H6.424ZM2.8 37.812H4.492C5.148 37.812 5.64 37.652 5.968 37.332C6.304 37.012 6.472 36.584 6.472 36.048C6.472 35.496 6.312 35.072 5.992 34.776C5.672 34.472 5.168 34.32 4.48 34.32H2.8V37.812ZM14.931 38.388C14.931 38.676 14.923 38.896 14.907 39.048H9.47097C9.49497 39.544 9.61497 39.968 9.83097 40.32C10.047 40.672 10.331 40.94 10.683 41.124C11.035 41.3 11.419 41.388 11.835 41.388C12.379 41.388 12.835 41.256 13.203 40.992C13.579 40.728 13.827 40.372 13.947 39.924H14.835C14.675 40.564 14.331 41.088 13.803 41.496C13.283 41.896 12.627 42.096 11.835 42.096C11.219 42.096 10.667 41.96 10.179 41.688C9.69097 41.408 9.30697 41.016 9.02697 40.512C8.75497 40 8.61897 39.404 8.61897 38.724C8.61897 38.044 8.75497 37.448 9.02697 36.936C9.29897 36.424 9.67897 36.032 10.167 35.76C10.655 35.488 11.211 35.352 11.835 35.352C12.459 35.352 13.003 35.488 13.467 35.76C13.939 36.032 14.299 36.4 14.547 36.864C14.803 37.32 14.931 37.828 14.931 38.388ZM14.079 38.364C14.087 37.876 13.987 37.46 13.779 37.116C13.579 36.772 13.303 36.512 12.951 36.336C12.599 36.16 12.215 36.072 11.799 36.072C11.175 36.072 10.643 36.272 10.203 36.672C9.76297 37.072 9.51897 37.636 9.47097 38.364H14.079ZM18.7238 42.096C17.9718 42.096 17.3558 41.924 16.8758 41.58C16.4038 41.228 16.1398 40.752 16.0838 40.152H16.9478C16.9878 40.52 17.1598 40.82 17.4638 41.052C17.7758 41.276 18.1918 41.388 18.7118 41.388C19.1678 41.388 19.5238 41.28 19.7798 41.064C20.0438 40.848 20.1758 40.58 20.1758 40.26C20.1758 40.036 20.1038 39.852 19.9598 39.708C19.8158 39.564 19.6318 39.452 19.4078 39.372C19.1918 39.284 18.8958 39.192 18.5198 39.096C18.0318 38.968 17.6358 38.84 17.3318 38.712C17.0278 38.584 16.7678 38.396 16.5518 38.148C16.3438 37.892 16.2398 37.552 16.2398 37.128C16.2398 36.808 16.3358 36.512 16.5278 36.24C16.7198 35.968 16.9918 35.752 17.3438 35.592C17.6958 35.432 18.0958 35.352 18.5438 35.352C19.2478 35.352 19.8158 35.532 20.2478 35.892C20.6798 36.244 20.9118 36.732 20.9438 37.356H20.1038C20.0798 36.972 19.9278 36.664 19.6478 36.432C19.3758 36.192 18.9998 36.072 18.5198 36.072C18.0958 36.072 17.7518 36.172 17.4878 36.372C17.2238 36.572 17.0918 36.82 17.0918 37.116C17.0918 37.372 17.1678 37.584 17.3198 37.752C17.4798 37.912 17.6758 38.04 17.9078 38.136C18.1398 38.224 18.4518 38.324 18.8438 38.436C19.3158 38.564 19.6918 38.688 19.9718 38.808C20.2518 38.928 20.4918 39.104 20.6918 39.336C20.8918 39.568 20.9958 39.876 21.0038 40.26C21.0038 40.612 20.9078 40.928 20.7158 41.208C20.5238 41.48 20.2558 41.696 19.9118 41.856C19.5678 42.016 19.1718 42.096 18.7238 42.096ZM23.677 36.156V40.224C23.677 40.624 23.753 40.9 23.905 41.052C24.057 41.204 24.325 41.28 24.709 41.28H25.477V42H24.577C23.985 42 23.545 41.864 23.257 41.592C22.969 41.312 22.825 40.856 22.825 40.224V36.156H21.913V35.448H22.825V33.804H23.677V35.448H25.477V36.156H23.677ZM26.4783 38.712C26.4783 38.04 26.6103 37.452 26.8743 36.948C27.1463 36.436 27.5183 36.044 27.9903 35.772C28.4703 35.492 29.0103 35.352 29.6103 35.352C30.2343 35.352 30.7703 35.496 31.2183 35.784C31.6743 36.072 32.0023 36.44 32.2023 36.888V35.448H33.0423V42H32.2023V40.548C31.9943 40.996 31.6623 41.368 31.2063 41.664C30.7583 41.952 30.2223 42.096 29.5983 42.096C29.0063 42.096 28.4703 41.956 27.9903 41.676C27.5183 41.396 27.1463 41 26.8743 40.488C26.6103 39.976 26.4783 39.384 26.4783 38.712ZM32.2023 38.724C32.2023 38.196 32.0943 37.732 31.8783 37.332C31.6623 36.932 31.3663 36.624 30.9903 36.408C30.6223 36.192 30.2143 36.084 29.7663 36.084C29.3023 36.084 28.8863 36.188 28.5183 36.396C28.1503 36.604 27.8583 36.908 27.6423 37.308C27.4343 37.7 27.3303 38.168 27.3303 38.712C27.3303 39.248 27.4343 39.72 27.6423 40.128C27.8583 40.528 28.1503 40.836 28.5183 41.052C28.8863 41.26 29.3023 41.364 29.7663 41.364C30.2143 41.364 30.6223 41.256 30.9903 41.04C31.3663 40.824 31.6623 40.516 31.8783 40.116C32.0943 39.716 32.2023 39.252 32.2023 38.724ZM40.636 35.448V42H39.796V40.848C39.604 41.256 39.308 41.568 38.908 41.784C38.508 42 38.06 42.108 37.564 42.108C36.78 42.108 36.14 41.868 35.644 41.388C35.148 40.9 34.9 40.196 34.9 39.276V35.448H35.728V39.18C35.728 39.892 35.904 40.436 36.256 40.812C36.616 41.188 37.104 41.376 37.72 41.376C38.352 41.376 38.856 41.176 39.232 40.776C39.608 40.376 39.796 39.788 39.796 39.012V35.448H40.636ZM43.3938 36.612C43.5778 36.204 43.8578 35.888 44.2338 35.664C44.6178 35.44 45.0858 35.328 45.6378 35.328V36.204H45.4098C44.8018 36.204 44.3138 36.368 43.9458 36.696C43.5778 37.024 43.3938 37.572 43.3938 38.34V42H42.5538V35.448H43.3938V36.612ZM46.5174 38.712C46.5174 38.04 46.6494 37.452 46.9134 36.948C47.1854 36.436 47.5574 36.044 48.0294 35.772C48.5094 35.492 49.0494 35.352 49.6494 35.352C50.2734 35.352 50.8094 35.496 51.2574 35.784C51.7134 36.072 52.0414 36.44 52.2414 36.888V35.448H53.0814V42H52.2414V40.548C52.0334 40.996 51.7014 41.368 51.2454 41.664C50.7974 41.952 50.2614 42.096 49.6374 42.096C49.0454 42.096 48.5094 41.956 48.0294 41.676C47.5574 41.396 47.1854 41 46.9134 40.488C46.6494 39.976 46.5174 39.384 46.5174 38.712ZM52.2414 38.724C52.2414 38.196 52.1334 37.732 51.9174 37.332C51.7014 36.932 51.4054 36.624 51.0294 36.408C50.6614 36.192 50.2534 36.084 49.8054 36.084C49.3414 36.084 48.9254 36.188 48.5574 36.396C48.1894 36.604 47.8974 36.908 47.6814 37.308C47.4734 37.7 47.3694 38.168 47.3694 38.712C47.3694 39.248 47.4734 39.72 47.6814 40.128C47.8974 40.528 48.1894 40.836 48.5574 41.052C48.9254 41.26 49.3414 41.364 49.8054 41.364C50.2534 41.364 50.6614 41.256 51.0294 41.04C51.4054 40.824 51.7014 40.516 51.9174 40.116C52.1334 39.716 52.2414 39.252 52.2414 38.724ZM58.0711 35.328C58.8551 35.328 59.4951 35.572 59.9911 36.06C60.4871 36.54 60.7351 37.24 60.7351 38.16V42H59.9071V38.256C59.9071 37.544 59.7271 37 59.3671 36.624C59.0151 36.248 58.5311 36.06 57.9151 36.06C57.2831 36.06 56.7791 36.26 56.4031 36.66C56.0271 37.06 55.8391 37.648 55.8391 38.424V42H54.9991V35.448H55.8391V36.564C56.0471 36.164 56.3471 35.86 56.7391 35.652C57.1311 35.436 57.5751 35.328 58.0711 35.328ZM63.6848 36.156V40.224C63.6848 40.624 63.7608 40.9 63.9128 41.052C64.0648 41.204 64.3328 41.28 64.7168 41.28H65.4848V42H64.5848C63.9928 42 63.5528 41.864 63.2648 41.592C62.9768 41.312 62.8328 40.856 62.8328 40.224V36.156H61.9208V35.448H62.8328V33.804H63.6848V35.448H65.4848V36.156H63.6848ZM75.0231 40.008H71.2071L70.4751 42H69.5871L72.6471 33.72H73.5951L76.6431 42H75.7551L75.0231 40.008ZM74.7711 39.312L73.1151 34.776L71.4591 39.312H74.7711ZM77.6073 38.712C77.6073 38.04 77.7433 37.452 78.0153 36.948C78.2873 36.436 78.6593 36.044 79.1313 35.772C79.6113 35.492 80.1513 35.352 80.7513 35.352C81.3273 35.352 81.8473 35.492 82.3113 35.772C82.7753 36.052 83.1153 36.416 83.3313 36.864V33.12H84.1713V42H83.3313V40.536C83.1313 40.992 82.8033 41.368 82.3473 41.664C81.8913 41.952 81.3553 42.096 80.7393 42.096C80.1393 42.096 79.5993 41.956 79.1193 41.676C78.6473 41.396 78.2753 41 78.0033 40.488C77.7393 39.976 77.6073 39.384 77.6073 38.712ZM83.3313 38.724C83.3313 38.196 83.2233 37.732 83.0073 37.332C82.7913 36.932 82.4953 36.624 82.1193 36.408C81.7513 36.192 81.3433 36.084 80.8953 36.084C80.4313 36.084 80.0153 36.188 79.6473 36.396C79.2793 36.604 78.9873 36.908 78.7713 37.308C78.5633 37.7 78.4593 38.168 78.4593 38.712C78.4593 39.248 78.5633 39.72 78.7713 40.128C78.9873 40.528 79.2793 40.836 79.6473 41.052C80.0153 41.26 80.4313 41.364 80.8953 41.364C81.3433 41.364 81.7513 41.256 82.1193 41.04C82.4953 40.824 82.7913 40.516 83.0073 40.116C83.2233 39.716 83.3313 39.252 83.3313 38.724ZM93.8889 35.328C94.6569 35.328 95.2809 35.572 95.7609 36.06C96.2489 36.54 96.4929 37.24 96.4929 38.16V42H95.6649V38.256C95.6649 37.544 95.4929 37 95.1489 36.624C94.8049 36.248 94.3369 36.06 93.7449 36.06C93.1289 36.06 92.6369 36.264 92.2689 36.672C91.9009 37.08 91.7169 37.672 91.7169 38.448V42H90.8889V38.256C90.8889 37.544 90.7169 37 90.3729 36.624C90.0289 36.248 89.5569 36.06 88.9569 36.06C88.3409 36.06 87.8489 36.264 87.4809 36.672C87.1129 37.08 86.9289 37.672 86.9289 38.448V42H86.0889V35.448H86.9289V36.576C87.1369 36.168 87.4329 35.86 87.8169 35.652C88.2009 35.436 88.6289 35.328 89.1009 35.328C89.6689 35.328 90.1649 35.464 90.5889 35.736C91.0209 36.008 91.3329 36.408 91.5249 36.936C91.7009 36.416 92.0009 36.02 92.4249 35.748C92.8569 35.468 93.3449 35.328 93.8889 35.328ZM98.7784 34.212C98.6104 34.212 98.4664 34.152 98.3464 34.032C98.2264 33.912 98.1664 33.764 98.1664 33.588C98.1664 33.412 98.2264 33.268 98.3464 33.156C98.4664 33.036 98.6104 32.976 98.7784 32.976C98.9464 32.976 99.0904 33.036 99.2104 33.156C99.3304 33.268 99.3904 33.412 99.3904 33.588C99.3904 33.764 99.3304 33.912 99.2104 34.032C99.0904 34.152 98.9464 34.212 98.7784 34.212ZM99.1984 35.448V42H98.3584V35.448H99.1984ZM104.173 35.328C104.957 35.328 105.597 35.572 106.093 36.06C106.589 36.54 106.837 37.24 106.837 38.16V42H106.009V38.256C106.009 37.544 105.829 37 105.469 36.624C105.117 36.248 104.633 36.06 104.017 36.06C103.385 36.06 102.881 36.26 102.505 36.66C102.129 37.06 101.941 37.648 101.941 38.424V42H101.101V35.448H101.941V36.564C102.149 36.164 102.449 35.86 102.841 35.652C103.233 35.436 103.677 35.328 104.173 35.328Z" fill="#666666"/>
				</svg>


            </a>
            <div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->
		<div class="chatbox">
			<div class="chatbox-close"></div>
			<div class="custom-tab-1">

				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat">
						<div class="card mb-sm-3 mb-md-0 contacts_card dz-chat-user-box">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/><rect fill="#000000" opacity="1.0" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g></svg></a>
								<div>
									<h6 class="mb-1">Chat List</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll  " id="DZ_W_Contacts_Body">
								<ul class="contacts">
									<li class="name-first-letter">A</li>
									<li class="active dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Archie Parker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Alfie Mason</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">B</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Bashid Samim</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz- -user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Breddie Ronan</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Ceorge Carson</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">D</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Darry Parker</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Denry Hunter</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">J</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Jack Ronan</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Jacob Tucker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>James Logan</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Joshua Weston</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">O</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oliver Acker</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oscar Weston</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="card chat dz-chat-history-box d-none">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);" class="dz-chat-history-back">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1"/><path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/></g></svg>
								</a>
								<div>
									<h6 class="mb-1">Chat with Khelesh</h6>
									<p class="mb-0 text-success">Online</p>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg></a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
										<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to btn-close friends</li>
										<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
										<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
									</ul>
								</div>
							</div>
							<div class="card-body msg_card_body dz-scroll" id="DZ_W_Contacts_Body3">
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
								<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
								<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
								<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
								<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
							</div>
							<div class="card-footer type_msg">
								<div class="input-group">
									<textarea class="form-control" placeholder="Type your message..."></textarea>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="alerts">
						<div class="card mb-sm-3 mb-md-0 contacts_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg></a>
								<div>
									<h6 class="mb-1">Notications</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="1"/><path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/></g></svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body1">
								<ul class="contacts">
									<li class="name-first-letter">SEVER STATUS</li>
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">KK</div>
											<div class="user_info">
												<span>David Nester Birthday</span>
												<p class="text-primary">Today</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SOCIAL</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont success">RU</div>
											<div class="user_info">
												<span>Perfection Simplified</span>
												<p>Jame Smith commented on your status</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SEVER STATUS</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">AU</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont info">MO</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="card-footer"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="notes">
						<div class="card mb-sm-3 mb-md-0 note_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/><rect fill="#000000" opacity="1.0" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g></svg></a>
								<div>
									<h6 class="mb-1">Notes</h6>
									<p class="mb-0">Add New Nots</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="1"/><path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/></g></svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body2">
								<ul class="contacts">
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>New order placed..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Youtube, a video-sharing website..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>john just buy your product..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar">
                                Dashboard
                            </div>
						</div>
                        <div class="header-right d-flex align-items-center">
							<div class="input-group search-area">
								<input type="text" class="form-control" placeholder="Search here...">
								<span class="input-group-text"><a href="javascript:void(0)">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_1_450)">
										<path opacity="0.3" d="M14.2929 16.7071C13.9024 16.3166 13.9024 15.6834 14.2929 15.2929C14.6834 14.9024 15.3166 14.9024 15.7071 15.2929L19.7071 19.2929C20.0976 19.6834 20.0976 20.3166 19.7071 20.7071C19.3166 21.0976 18.6834 21.0976 18.2929 20.7071L14.2929 16.7071Z" fill="#452B90"/>
										<path d="M11 16C13.7614 16 16 13.7614 16 11C16 8.23859 13.7614 6.00002 11 6.00002C8.23858 6.00002 6 8.23859 6 11C6 13.7614 8.23858 16 11 16ZM11 18C7.13401 18 4 14.866 4 11C4 7.13402 7.13401 4.00002 11 4.00002C14.866 4.00002 18 7.13402 18 11C18 14.866 14.866 18 11 18Z" fill="#452B90"/>
										</g>
										<defs>
										<clipPath id="clip0_1_450">
										<rect width="24" height="24" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</a></span>
							</div>
							<ul class="navbar-nav">
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
										<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 12H19C19.8284 12 20.5 12.6716 20.5 13.5C20.5 14.3284 19.8284 15 19 15H6C5.17157 15 4.5 14.3284 4.5 13.5C4.5 12.6716 5.17157 12 6 12H7.5L8.05827 6.97553C8.30975 4.71226 10.2228 3 12.5 3C14.7772 3 16.6903 4.71226 16.9417 6.97553L17.5 12Z" fill="#222B40"/>
											<path opacity="0.3" d="M14.5 18C14.5 16.8954 13.6046 16 12.5 16C11.3954 16 10.5 16.8954 10.5 18C10.5 19.1046 11.3954 20 12.5 20C13.6046 20 14.5 19.1046 14.5 18Z" fill="#222B40"/>
										</svg>
										<span class="badge light text-white bg-primary rounded-circle">18</span>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<div id="DZ_W_Notification1" class="widget-media dz-scroll p-2" style="height:380px;">
											<ul class="timeline">
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-info">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-success">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												 <li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-danger">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-primary">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-info">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-success">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												 <li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-danger">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-primary">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<a class="all-notification" href="javascript:void(0);">See all notifications <i class="ti-arrow-end"></i></a>
									</div>
								</li>
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link bell-link" href="javascript:void(0);">
									<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_1_463)">
										<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M6.5 2H18.5C19.0523 2 19.5 2.44772 19.5 3V13C19.5 13.5523 19.0523 14 18.5 14H6.5C5.94772 14 5.5 13.5523 5.5 13V3C5.5 2.44772 5.94772 2 6.5 2ZM14.3 4C13.6562 4 12.9033 4.72985 12.5 5.2C12.0967 4.72985 11.3438 4 10.7 4C9.5604 4 8.9 4.88887 8.9 6.02016C8.9 7.27339 10.1 8.6 12.5 10C14.9 8.6 16.1 7.3 16.1 6.1C16.1 4.96871 15.4396 4 14.3 4Z" fill="#222B40"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M4.29275 6.57254L12.5 12.5L20.7073 6.57254C20.9311 6.41086 21.2437 6.46127 21.4053 6.68514C21.4669 6.77034 21.5 6.87278 21.5 6.97788V17C21.5 18.1046 20.6046 19 19.5 19H5.5C4.39543 19 3.5 18.1046 3.5 17V6.97788C3.5 6.70174 3.72386 6.47788 4 6.47788C4.10511 6.47788 4.20754 6.511 4.29275 6.57254Z" fill="#222B40"/>
										</g>
										<defs>
										<clipPath id="clip0_1_463">
										<rect width="24" height="24" fill="white" transform="translate(0.5)"/>
										</clipPath>
										</defs>
									</svg>
									<span class="badge light text-white bg-secondary rounded-circle">01</span>
									</a>
								</li>
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link " href="javascript:void(0);" data-bs-toggle="dropdown">
									<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 16.87V9.257H21.5V16.931C21.5 20.07 19.5241 22 16.3628 22H8.62733C5.49561 22 3.5 20.03 3.5 16.87ZM8.45938 14.41C8.00494 14.431 7.62953 14.07 7.60977 13.611C7.60977 13.151 7.96542 12.771 8.41987 12.75C8.86443 12.75 9.22997 13.101 9.23985 13.55C9.2596 14.011 8.90395 14.391 8.45938 14.41ZM12.5198 14.41C12.0653 14.431 11.6899 14.07 11.6701 13.611C11.6701 13.151 12.0258 12.771 12.4802 12.75C12.9248 12.75 13.2903 13.101 13.3002 13.55C13.32 14.011 12.9643 14.391 12.5198 14.41ZM16.5505 18.09C16.096 18.08 15.7305 17.7 15.7305 17.24C15.7206 16.78 16.0862 16.401 16.5406 16.391H16.5505C17.0148 16.391 17.3902 16.771 17.3902 17.24C17.3902 17.71 17.0148 18.09 16.5505 18.09ZM11.6701 17.24C11.6899 17.7 12.0653 18.061 12.5198 18.04C12.9643 18.021 13.32 17.641 13.3002 17.181C13.2903 16.731 12.9248 16.38 12.4802 16.38C12.0258 16.401 11.6701 16.78 11.6701 17.24ZM7.59989 17.24C7.61965 17.7 7.99506 18.061 8.44951 18.04C8.89407 18.021 9.24973 17.641 9.22997 17.181C9.22009 16.731 8.85456 16.38 8.40999 16.38C7.95554 16.401 7.59989 16.78 7.59989 17.24ZM15.7404 13.601C15.7404 13.141 16.096 12.771 16.5505 12.761C16.9951 12.761 17.3507 13.12 17.3705 13.561C17.3804 14.021 17.0247 14.401 16.5801 14.41C16.1257 14.42 15.7503 14.07 15.7404 13.611V13.601Z" fill="#222B40"/>
										<path opacity="0.4" d="M3.50336 9.2569C3.5162 8.6699 3.5656 7.5049 3.65846 7.1299C4.13267 5.0209 5.74298 3.6809 8.04485 3.4899H16.9559C19.238 3.6909 20.8681 5.0399 21.3423 7.1299C21.4342 7.4949 21.4836 8.6689 21.4964 9.2569H3.50336Z" fill="#222B40"/>
										<path d="M8.80489 6.59C9.23958 6.59 9.56559 6.261 9.56559 5.82V2.771C9.56559 2.33 9.23958 2 8.80489 2C8.3702 2 8.04419 2.33 8.04419 2.771V5.82C8.04419 6.261 8.3702 6.59 8.80489 6.59Z" fill="#222B40"/>
										<path d="M16.195 6.59C16.6198 6.59 16.9557 6.261 16.9557 5.82V2.771C16.9557 2.33 16.6198 2 16.195 2C15.7603 2 15.4343 2.33 15.4343 2.771V5.82C15.4343 6.261 15.7603 6.59 16.195 6.59Z" fill="#222B40"/>
									</svg>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<div id="DZ_W_TimeLine02" class="widget-timeline dz-scroll style-1 p-3 height370">
											<ul class="timeline">
												<li>
													<div class="timeline-badge primary"></div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>10 minutes ago</span>
														<h6 class="mb-0">Youtube, a video-sharing website, goes live <strong class="text-primary">$500</strong>.</h6>
													</a>
												</li>
												<li>
													<div class="timeline-badge info">
													</div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>20 minutes ago</span>
														<h6 class="mb-0">New order placed <strong class="text-info">#XF-2356.</strong></h6>
														<p class="mb-0">Quisque a consequat ante Sit amet magna at volutapt...</p>
													</a>
												</li>
												<li>
													<div class="timeline-badge danger">
													</div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>30 minutes ago</span>
														<h6 class="mb-0">john just buy your product <strong class="text-warning">Sell $250</strong></h6>
													</a>
												</li>
												<li>
													<div class="timeline-badge success">
													</div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>15 minutes ago</span>
														<h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>
													</a>
												</li>
												<li>
													<div class="timeline-badge warning">
													</div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>20 minutes ago</span>
														<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
													</a>
												</li>
												<li>
													<div class="timeline-badge dark">
													</div>
													<a class="timeline-panel text-muted" href="javascript:void(0);">
														<span>20 minutes ago</span>
														<h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li class="nav-item ps-3">
									<div class="dropdown header-profile2">
										<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<div class="header-info2 d-flex align-items-center">
												<div class="header-media">
													<img src="{{asset('assets/images/user.jpg')}}" alt="">
												</div>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-end" style="">
											<div class="card border-0 mb-0">
												<div class="card-header py-2">
													<div class="products">
														<img src="{{asset('assets/images/user.jpg')}}" class="avatar avatar-md" alt="">
														<div>
															<h6>{{ Auth::user()->name }}</h6>

															{{-- <span>Web Designer</span> --}}
														</div>
													</div>
												</div>
												<div class="card-body px-0 py-2">
													<a href="page-error-404.html" class="dropdown-item ai-icon ">
														<svg  width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 15.3462C8.11714 15.3462 4.81429 15.931 4.81429 18.2729C4.81429 20.6148 8.09619 21.2205 11.9848 21.2205C15.8524 21.2205 19.1543 20.6348 19.1543 18.2938C19.1543 15.9529 15.8733 15.3462 11.9848 15.3462Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 12.0059C14.5229 12.0059 16.58 9.94779 16.58 7.40969C16.58 4.8716 14.5229 2.81445 11.9848 2.81445C9.44667 2.81445 7.38857 4.8716 7.38857 7.40969C7.38 9.93922 9.42381 11.9973 11.9524 12.0059H11.9848Z" stroke="var(--primary)" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>

														<span class="ms-2">Profile </span>
													</a>
													<a href="page-error-404.html" class="dropdown-item ai-icon ">
														<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>

														<span class="ms-2">My Project</span><span class="badge badge-sm badge-primary rounded-circle text-white ms-2">4</span>
													</a>
													<a href="javascript:void(0);" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M17.9026 8.85114L13.4593 12.4642C12.6198 13.1302 11.4387 13.1302 10.5992 12.4642L6.11844 8.85114" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>

														<span class="ms-2">Message </span>
													</a>
													<a href="email-inbox.html" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M14.3888 20.8572C13.0247 22.372 10.8967 22.3899 9.51947 20.8572" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>

														<span class="ms-2">Notification </span>
													</a>
												</div>
												<div class="card-footer px-0 py-2">
													<a href="javascript:void(0);" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															<circle cx="12.175" cy="11.889" r="2.63616" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>

														<span class="ms-2">Settings </span>
													</a>
													<a href="{{ route('logout') }}" class="dropdown-item ai-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                                        </svg>
                                                        <span class="ms-2">Logout </span>
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>

												</div>
											</div>

										</div>
									</div>
								</li>
							</ul>
						</div>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
		<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li class="menu-title">YOUR COMPANY</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z" fill="#90959F"/>
							</svg>
						</div>
						<span class="nav-text">Dashboard</span>
						</a>
						<ul aria-expanded="false">

							<li><a href="index.html">Dashboard Light</a></li>
							<li><a href="index-2.html">Dashboard Dark</a></li>
							<li><a href="order-list.html">Order List</a></li>
							<li><a href="order-details.html">Order Details</a></li>
							<li><a href="analytics.html">Analytics</a></li>
							<li><a href="customers.html">Customers</a></li>
							<li><a href="reviews.html">Reviews</a></li>
							<li><a href="blog.html">Blog</a></li>
						</ul>
					</li>
					<li class="menu-title">OUR FEATURES</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">

                            <g opacity="0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bookmark-star-fill" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5M8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.18.18 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.18.18 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.18.18 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.18.18 0 0 1-.134-.098z"/>
                              </svg>
                            </g>

						</div>
						<span class="nav-text">Catégories</span>
						</a>
						<ul aria-expanded="false">


							<li><a href="{{route('admin.categories.index')}}">Liste des catégories</a></li>
							<li><a href="{{route('admin.categories.create')}}">Créer une catégorie</a></li>
						</ul>
					</li>


					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 24 24">
                                <g opacity="0.5">
                                <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z"/>
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                            </g>
                            </svg>
						</div>
							<span class="nav-text">Menus</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('admin.menus.index')}}">Liste des Menus</a></li>
							<li><a href="{{route('admin.menus.create')}}">Créer le Menu du jour</a></li>
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<div class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-vinyl-fill" viewBox="0 0 24 24">
                                <g opacity="0.5">
                                <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4m0 3a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0"/>
                            </g>
                            </svg>


						</div>
							<span class="nav-text">Plats</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('admin.plats.index')}}">Liste des Plats</a></li>
							<li><a href="{{route('admin.plats.create')}}">Créer un Plat</a></li>

						</ul>
					</li>


				</ul>
				<div class="plus-box">
					<div class="media">
						<span>
							<svg width="24" height="40" viewBox="0 0 24 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="2" cy="2" r="2" fill="#568AFF"/>
								<circle cx="12" cy="2" r="2" fill="#568AFF"/>
								<circle cx="22" cy="2" r="2" fill="#568AFF"/>
								<circle cx="2" cy="14" r="2" fill="#568AFF"/>
								<circle cx="12" cy="14" r="2" fill="#568AFF"/>
								<circle cx="22" cy="14" r="2" fill="#568AFF"/>
								<circle cx="2" cy="26" r="2" fill="#568AFF"/>
								<circle cx="12" cy="26" r="2" fill="#568AFF"/>
								<circle cx="22" cy="26" r="2" fill="#568AFF"/>
								<circle cx="2" cy="38" r="2" fill="#568AFF"/>
								<circle cx="12" cy="38" r="2" fill="#568AFF"/>
								<circle cx="22" cy="38" r="2" fill="#568AFF"/>
							</svg>
						</span>
					</div>
					<div class="info">
						<svg width="25" height="15" viewBox="0 0 25 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.4431 6.56885L5.76863 2.24329L10.0942 6.56885L14.4197 2.24329L18.7452 6.56885L23.0707 2.24329" stroke="white" stroke-width="2" stroke-linecap="round"/>
							<path d="M1.4431 13.2441L5.76863 8.91858L10.0942 13.2441L14.4197 8.91858L18.7452 13.2441L23.0707 8.91858" stroke="white" stroke-width="2" stroke-linecap="round"/>
						</svg>
						<h6>Generate annualy report by Salero</h6>
						<span>Lorem ipsum dolor sit amet</span>
					</div>
				</div>
				<div class="copyright">
					<p class="fs-14"><strong>Salero Restaurant Admin</strong> © 2023 All Rights Reserved</p>
					<p class="fs-14">Made with <span class="heart"></span> by  DexignZone</p>
				</div>
			</div>
        </div>

        <!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex justify-content-between">
								<div class="card-menu">
									<span>Total Resto</span>
									<h2 class="mb-0">683</h2>
								</div>
								<div class="icon-box icon-box-lg bg-primary-light">
									<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 8.7773C0.00165391 10.5563 1.44323 11.9981 3.2222 12H8.7778C10.5568 11.9981 11.9983 10.5563 12 8.7773V3.2227C11.9983 1.44373 10.5568 0.00192952 8.7778 0H3.2222C1.44323 0.00192952 0.00165319 1.44373 0 3.2227V8.7773ZM2 3.2227C2.00072 2.54791 2.54741 2.00099 3.2222 2L8.7778 2C9.45259 2.00099 9.99928 2.54791 10 3.2227V8.7773C9.99929 9.45209 9.45259 9.99901 8.7778 10L3.2222 10C2.54741 9.99901 2.00072 9.45209 2 8.7773V3.2227Z" fill="var(--primary)"/>
										<path d="M0 22.7773C0.00165272 24.5563 1.44323 25.9981 3.2222 26L8.7778 26C10.5568 25.9981 11.9983 24.5563 12 22.7773V17.2227C11.9983 15.4437 10.5568 14.0019 8.7778 14L3.2222 14C1.44323 14.0019 0.00165391 15.4437 0 17.2227V22.7773ZM2 17.2227C2.00072 16.5479 2.54741 16.001 3.2222 16H8.7778C9.45259 16.001 9.99928 16.5479 10 17.2227V22.7773C9.99929 23.4521 9.45259 23.999 8.7778 24L3.2222 24C2.54741 23.999 2.00071 23.4521 2 22.7773V17.2227Z" fill="var(--primary)"/>
										<path d="M20 0C16.6863 0 14 2.68629 14 6C14 9.31371 16.6863 12 20 12C23.3137 12 26 9.31371 26 6C25.9964 2.6878 23.3122 0.00363779 20 0ZM20 10C17.7909 10 16 8.20914 16 6C16 3.79086 17.7909 2 20 2C22.2091 2 24 3.79086 24 6C23.9977 8.20818 22.2082 9.99769 20 10Z" fill="var(--primary)"/>
										<path d="M17.2222 14C15.4432 14.0019 14.0017 15.4437 14 17.2227L14 22.7773C14.0017 24.5563 15.4432 25.9981 17.2222 26L22.7778 26C24.5568 25.9981 25.9984 24.5563 26 22.7773L26 17.2227C25.9983 15.4437 24.5568 14.0019 22.7778 14L17.2222 14ZM24 17.2227V22.7773C23.9993 23.4521 23.4526 23.999 22.7778 24L17.2222 24C16.5474 23.999 16.0007 23.4521 16 22.7773V17.2227C16.0007 16.5479 16.5474 16.001 17.2222 16H22.7778C23.4526 16.001 23.9993 16.5479 24 17.2227Z" fill="var(--primary)"/>
									</svg>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex justify-content-between">
								<div class="card-menu">
									<span>Total Revenue</span>
									<h2 class="mb-0">$56,234</h2>
								</div>
								<div class="icon-box icon-box-lg bg-primary-light">
									<svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.45 29.3C10.0102 29.3093 11.5568 29.0088 13 28.416C14.4417 29.0138 15.9893 29.3145 17.55 29.3C22.2885 29.3 26 26.7715 26 23.5422V18.1577C26 14.9284 22.2885 12.4 17.55 12.4C17.3303 12.4 17.1145 12.4104 16.9 12.4221V6.33285C16.9 3.16995 13.1885 0.699951 8.45 0.699951C3.7115 0.699951 0 3.16995 0 6.33285V23.6671C0 26.83 3.7115 29.3 8.45 29.3ZM23.4 23.5422C23.4 25.0359 20.9976 26.7 17.55 26.7C14.1024 26.7 11.7 25.0359 11.7 23.5422V22.3398C13.4605 23.4105 15.4899 23.9566 17.55 23.9141C19.6101 23.9566 21.6395 23.4105 23.4 22.3398V23.5422ZM17.55 15C20.9976 15 23.4 16.664 23.4 18.1577C23.4 19.6514 20.9976 21.3141 17.55 21.3141C14.1024 21.3141 11.7 19.6501 11.7 18.1577C11.7 16.6653 14.1024 15 17.55 15ZM8.45 3.29995C11.8976 3.29995 14.3 4.89895 14.3 6.33285C14.3 7.76675 11.8976 9.36705 8.45 9.36705C5.0024 9.36705 2.6 7.76805 2.6 6.33285C2.6 4.89765 5.0024 3.29995 8.45 3.29995ZM2.6 10.4266C4.36783 11.4764 6.39439 12.0101 8.45 11.967C10.5056 12.0101 12.5322 11.4764 14.3 10.4266L14.3 12.8289C12.8832 13.186 11.5839 13.9061 10.53 14.918C9.84648 15.066 9.14934 15.1418 8.45 15.1443C5.0024 15.1443 2.6 13.5453 2.6 12.1114V10.4266ZM2.6 16.2051C4.3682 17.2539 6.39459 17.787 8.45 17.7443C8.6814 17.7443 8.905 17.7157 9.1325 17.704C9.11313 17.8545 9.10228 18.0059 9.1 18.1576V20.8682C8.8816 20.8812 8.671 20.9228 8.45 20.9228C5.0024 20.9228 2.6 19.3238 2.6 17.8886V16.2051ZM2.6 21.9823C4.36783 23.0321 6.39439 23.5658 8.45 23.5228C8.6684 23.5228 8.8829 23.5058 9.1 23.4955V23.5422C9.1186 24.6489 9.54387 25.71 10.2947 26.5232C9.68645 26.638 9.06899 26.6972 8.45 26.7C5.0024 26.7 2.6 25.101 2.6 23.6671V21.9823Z" fill="var(--primary)"/>
									</svg>

								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex justify-content-between">
								<div class="card-menu">
									<span>Total Orders</span>
									<h2 class="mb-0">4,98</h2>
								</div>
								<div class="icon-box icon-box-lg bg-primary-light">
									<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M3.5 24.5001H4.5V27.5001C4.5 27.8384 4.67123 28.1539 4.95504 28.3384C5.23903 28.5229 5.5969 28.5512 5.9062 28.4137L14.7118 24.5001H21.5C23.1561 24.4983 24.4982 23.1562 24.5 21.5001L24.5 13.5001C24.5 12.9478 24.0523 12.5001 23.5 12.5001C22.9477 12.5001 22.5 12.9478 22.5 13.5001V21.5001C22.4995 22.0522 22.0521 22.4996 21.5 22.5001L14.5 22.5001L14.4916 22.5018C14.4266 22.5083 14.3625 22.5212 14.3 22.5401C14.2324 22.5482 14.1658 22.5631 14.1012 22.5845L14.0934 22.5862L6.5 25.9615V23.5001C6.5 22.9478 6.05228 22.5001 5.5 22.5001H3.5C2.94792 22.4996 2.50049 22.0522 2.5 21.5001V7.50012C2.5005 6.94804 2.94792 6.50062 3.5 6.50012L15.42 6.50012C15.9723 6.50012 16.42 6.05241 16.42 5.50012C16.42 4.94784 15.9723 4.50012 15.42 4.50012H3.5C1.8439 4.50194 0.501819 5.84402 0.5 7.50012L0.5 21.5001C0.50182 23.1562 1.8439 24.4983 3.5 24.5001Z" fill="var(--primary)"/>
										<path d="M23.5 10.5001C26.2614 10.5001 28.5 8.26155 28.5 5.50012C28.5 2.7387 26.2614 0.500122 23.5 0.500122C20.7386 0.500122 18.5 2.7387 18.5 5.50012C18.5033 8.2602 20.7399 10.4969 23.5 10.5001ZM23.5 2.50012C25.1569 2.50012 26.5 3.84327 26.5 5.50012C26.5 7.15698 25.1569 8.50012 23.5 8.50012C21.8431 8.50012 20.5 7.15698 20.5 5.50012C20.5018 3.84402 21.8439 2.50194 23.5 2.50012Z" fill="var(--primary)"/>
										<path d="M5.5 10.5001H10.5C11.0523 10.5001 11.5 10.0524 11.5 9.50012C11.5 8.94784 11.0523 8.50012 10.5 8.50012H5.5C4.94772 8.50012 4.5 8.94784 4.5 9.50012C4.5 10.0524 4.94772 10.5001 5.5 10.5001Z" fill="var(--primary)"/>
										<path d="M5.5 14.5001H14.5C15.0523 14.5001 15.5 14.0524 15.5 13.5001C15.5 12.9478 15.0523 12.5001 14.5 12.5001H5.5C4.94772 12.5001 4.5 12.9478 4.5 13.5001C4.5 14.0524 4.94772 14.5001 5.5 14.5001Z" fill="var(--primary)"/>
									</svg>


								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex justify-content-between">
								<div class="card-menu">
									<span>Total Customer</span>
									<h2 class="mb-0">12,094</h2>
								</div>
								<div class="icon-box icon-box-lg bg-primary-light">
									<svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.8413 15C14.0504 15 15.8413 13.2091 15.8413 11C15.8413 8.79086 14.0504 7 11.8413 7C9.63217 7 7.84131 8.79086 7.84131 11C7.84346 13.2082 9.63306 14.9979 11.8413 15ZM11.8413 9C12.9459 9 13.8413 9.89543 13.8413 11C13.8413 12.1046 12.9459 13 11.8413 13C10.7367 13 9.84131 12.1046 9.84131 11C9.8428 9.89605 10.7374 9.00149 11.8413 9Z" fill="#1921FA"/>
										<path d="M27.4653 17.57C28.1349 16.6731 28.3336 15.5094 27.9995 14.4411L27.3647 12.3757C26.7526 10.3642 24.8938 8.99215 22.7913 9L18.3042 9C17.7519 9 17.3042 9.44772 17.3042 10C17.3042 10.5523 17.7519 11 18.3042 11H22.7913C24.0147 10.9958 25.0962 11.7943 25.4524 12.9648L26.0872 15.0293C26.2292 15.4911 26.1437 15.9929 25.8568 16.3816C25.5698 16.7703 25.1154 16.9998 24.6323 17L15.4634 17C15.4351 17 15.4114 17.0137 15.3834 17.0161C15.3162 17.0135 15.2513 17 15.1831 17H8.91306C6.63117 16.9917 4.61413 18.4815 3.95116 20.665L3.20456 23.09C2.85091 24.2408 3.0643 25.4912 3.77961 26.4597C4.49492 27.4281 5.6273 27.9997 6.83126 28H17.2642C18.4675 28 19.6001 27.4287 20.3157 26.4604C21.0315 25.4914 21.2449 24.2409 20.8913 23.09L20.1452 20.6652C19.9562 20.0614 19.6586 19.4971 19.2671 19H24.6323C25.7513 19.0052 26.8048 18.4733 27.4653 17.57ZM18.7075 25.2712C18.371 25.7315 17.8343 26.0025 17.2642 26L6.83126 26C6.26201 26 5.72636 25.7297 5.38805 25.2717C5.04968 24.8134 4.94894 24.222 5.11646 23.6777L5.86256 21.2529C6.2696 19.9104 7.50972 18.9944 8.91256 19H15.1826C16.5854 18.9944 17.8255 19.9104 18.2326 21.2529L18.9787 23.6777C19.1493 24.2217 19.0484 24.8143 18.7075 25.2712Z" fill="#1921FA"/>
										<path d="M20.3413 7C22.2743 7 23.8413 5.433 23.8413 3.5C23.8413 1.567 22.2743 0 20.3413 0C18.4083 0 16.8413 1.567 16.8413 3.5C16.8436 5.43204 18.4093 6.99768 20.3413 7ZM20.3413 2C21.1697 2 21.8413 2.67157 21.8413 3.5C21.8413 4.32843 21.1697 5 20.3413 5C19.5129 5 18.8413 4.32843 18.8413 3.5C18.8422 2.67196 19.5133 2.00094 20.3413 2Z" fill="#1921FA"/>
										<path d="M0.841309 4C0.841309 4.55228 1.28902 5 1.84131 5H3.84131V7C3.84131 7.55229 4.28902 8 4.84131 8C5.39359 8 5.84131 7.55228 5.84131 7V5H7.84131C8.39359 5 8.84131 4.55228 8.84131 4C8.84131 3.44772 8.39359 3 7.84131 3H5.84131V1C5.84131 0.447715 5.39359 0 4.84131 0C4.28902 0 3.84131 0.447715 3.84131 1V3H1.84131C1.28902 3 0.841308 3.44772 0.841309 4Z" fill="#1921FA"/>
									</svg>
								</div>
							</div>

						</div>

					</div>



				</div>
                @yield('content')
			</div>

		</div>



        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
               <p>Copyright © Developed by <a href="https://dexignzone.com/" target="_blank">DexignZone</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @yield('scripts')
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

<!-- JS for dotted map -->
<script src="{{ asset('assets/vendor/dotted-map/js/contrib/jquery.smallipop-0.3.0.min.js') }}"></script>
<script src="{{ asset('assets/vendor/dotted-map/js/contrib/suntimes.js') }}"></script>
<script src="{{ asset('assets/vendor/dotted-map/js/contrib/color-0.4.1.js') }}"></script>
<script src="{{ asset('assets/vendor/dotted-map/js/world.js') }}"></script>
<script src="{{ asset('assets/vendor/dotted-map/js/smallimap.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/dotted-map-init.js') }}"></script>

<!-- Vectormap -->
<script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
<script src="{{ asset ('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{ asset ('assets/js/plugins-init/sweetalert.init.js')}}"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 5,
        //spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            416: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            1788: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },
    });
</script>




</body>

<!-- Mirrored from salero.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Apr 2024 17:53:39 GMT -->
</html>
