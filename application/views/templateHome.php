<!DOCTYPE html>

<html lang="en">
<head>
	<link href='http://fonts.googleapis.com/css?family=Over+the+Rainbow|Open+Sans:300,400,400italic,600,700|Arimo|Oswald|Lato|Ubuntu' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/sideka.ico" type="image/x-icon" />
	<title>Sistem Informasi Desa dan Kawasan <?= $konten_logo->nama_desa ?></title>
	<?php
	$path_css = $konten_logo->path_css;
	?>
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut" href="images/favicon.ico" />

	<!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>

	<link rel="stylesheet" href="<?php echo base_url();?>assetku/css/old/style.css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assetku/fancybox/jquery.fancybox.css" media="screen" />

	<!-- REVOLUTION BANNER CSS SETTINGS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assetku/rs-plugin/css/settings.css" media="screen" />

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assetku/css/old/style.css" media="screen" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo site_url($path_css);?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/flexslider.css" type="text/css" media="screen">

	<link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetku/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetku/css/lightbox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetku/css/lightbox.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assetku/plugin/bxslider/jquery.bxslider.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assetku/plugin/owl-carousel/owl.carousel.css" rel="stylesheet">

	<!-- Alertify CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />

</head>
<body>

	<!-- - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - -->
	<nav class="navbar">
		<?php if ( isset($menu))
		{
			echo $menu;
		}
		else
		{
			echo "Content belum diset";
		}?>
	</nav><!--/ #navigation-->
	<!-- - - - - - - - - - - - end Navigation - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - Logo - - - - - - - - - - - - - - -->
	<div class="container">
		<?php if ( isset($logo))
		{
			echo $logo;
		}
		else
		{
			echo "Content belum diset";
		}?>
	</div><!--/ #logo-->
	<!-- - - - - - - - - - - - end Logo - - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - - - Slider - - - - - - - - - - - - - - - -->
	<div class="wrapper container">
		<?php if ( isset($slider))
		{
			echo $slider;
		}
		else
		{
			echo "";
		}?>
    </div>
	<!-- - - - - - - - - - - - - end Slider - - - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - - - - Main - - - - - - - - - - - - - - - - -->
		<div class="wrapper container">
		<div class="">
		<?php if ( isset($content))
				{
					echo $content;
				}
				else
				{
					echo "";
				}?>
		</div>
		</div>
		</div>
	<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

	<footer>
	<?php if ( isset($footer))
				{
					echo $footer;
				}
				else
				{
					echo "footer belum diset";
				}?>

	</footer>

	<!-- - - - - - - - - - - - - end Bottom Footer - - - - - - - - - - - - - -->


	<!-- HTML5 SHIV + DETECT TOUCH EVENTS -->
	<script type="text/javascript" src="<?php echo base_url();?>assetku/js/modernizr.custom.js"></script>

	<!-- JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap-hover-dropdown.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery.flexslider.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/scrolltopcontrol.js"></script>

	<script src="<?php echo base_url(); ?>assetku/plugin/bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/owl-carousel/owl.carousel.js"></script>


<script>
    // very simple to use!
    $(document).ready(function() {
      	$('.dropdownhover').dropdownHover().dropdown();
				$('.footer-content').css('display', 'none');
				$('.footer-content').fadeIn(1500);
    });
</script>

<script>
	//JS for owl-carousel
		if ($('.owl-carousel').length>0) {
			$(".owl-carousel.carousel").owlCarousel({
				items: 3,
				autoPlay: 5000,
				interval: 5000,
				pagination: false,
				navigation: true,
				navigationText: false
			});
			$(".owl-carousel.carousel-autoplay").owlCarousel({
				items: 3,
				autoPlay: 5000,
				pagination: false,
				navigation: true,
				navigationText: false
			});
			$(".owl-carousel.clients").owlCarousel({
				items: 3,
				autoPlay: true,
				pagination: false,
				itemsDesktopSmall: [992,5],
				itemsTablet: [768,4],
				itemsMobile: [479,3]
			});
			$(".owl-carousel.content-slider").owlCarousel({
				singleItem: true,
				autoPlay: 5000,
				navigation: false,
				navigationText: false,
				pagination: false
			});
			$(".owl-carousel.content-slider-with-controls").owlCarousel({
				singleItem: true,
				autoPlay: false,
				navigation: true,
				navigationText: false,
				pagination: true
			});
			$(".owl-carousel.content-slider-with-controls-autoplay").owlCarousel({
				singleItem: true,
				autoPlay: 5000,
				navigation: true,
				navigationText: false,
				pagination: true
			});
			$(".owl-carousel.content-slider-with-controls-bottom").owlCarousel({
				singleItem: true,
				autoPlay: false,
				navigation: true,
				navigationText: false,
				pagination: true
			});
		};
</script>

  <script type="text/javascript">
	$('#navbar-search > a').on('click', function() {
		$('#navbar-search > a > i').toggleClass('fa-search fa-times');
		$("#navbar-search-box").toggleClass('show hidden animated fadeInUp');
		return false;
	});
  </script>


<script>
		var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

	    function checkCookies() {
			if(datacookie != ''){
				var jdata = Base64.decode(datacookie);
				var arr = JSON.parse(jdata);
				var klikid = Base64.decode(arr.klikID);
				var name = Base64.decode(arr.fullname);
				var email = Base64.decode(arr.email);
				//alert('Data cookie: ' + datacookie + '\n\nDecode cookie: ' + jdata + '\n\nKlik-ID: ' + klikid + ' ' + name + ' ' + email );
				document.getElementById("sso").innerHTML = "<i class='fa fa-user fa-fw'></i> "+ name +" | LOGOUT";
				document.getElementById("nama").value =  name;
				document.getElementById("email").value =  email;
				document.getElementById("kirim").style.display = 'inline';
				document.getElementById("kirimLogin").style.display = 'none';
				document.getElementById("kirimJurnal").style.display = 'inline';
				document.getElementById("infoJurnal").style.display = 'none';
			}else{
				console.log('You are not login!');
			}
		}
</script>

</body>
</html>
