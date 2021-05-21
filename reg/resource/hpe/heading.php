		<?php
			$heading_name = "Bodindecha (Sing Singhaseni) School"; $heading_domain = "บดินทรเดชา.th";
			$heading_title = ((isset($header_title))?$header_title." - ":"").$heading_name;
			$heading_desc = (isset($header_desc))?str_replace("\"","'",$header_desc):"โรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี)";
			$heading_cover = ((isset($header_cover))?$header_cover:"images/cover-1");
		?>
		<!-- Settings -->
		<meta charset="UTF-8" />
		<meta name="author" content="Tecillium (UFDT)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $heading_title;?></title>
		<meta name="description" content="<?php echo $heading_desc;?>">
		<link rel="icon" href="/favicon.ico" />
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php if ($_SERVER['REQUEST_URI'] != "/error/904") echo '<noscript><meta http-equiv="refresh" content="0; /error/904"></noscript>'; ?>
		<!-- Twitter card sharing prepare -->
		<meta name="twitter:card" content="summary_large_image">
		<!meta name="twitter:site" content="@tiantcl">
		<meta name="twitter:creator" content="@TianTcl">
		<meta name="twitter:title" content="<?php echo $heading_title;?>">
		<meta name="twitter:description" content="<?php echo $heading_desc;?>">
		<meta name="twitter:image" content="/reg/resource/<?php echo $heading_cover;?>.png">
		<meta name="twitter:app:country" content="th"/>
        <meta name="twitter:app:name:ipad" content="<?php echo $heading_name; ?>"/>
        <meta name="twitter:app:name:iphone" content="<?php echo $heading_name; ?>"/>
        <meta name="twitter:app:name:googleplay" content="<?php echo $heading_name; ?>"/>
		<!-- Link sharing prepare -->
		<meta property="og:title" content="<?php echo $heading_title;?>" />
		<meta property="og:description" content="<?php echo $heading_desc;?>" />
		<meta property="og:image" content="/reg/resource/<?php echo $heading_cover;?>.png" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:locale:alternate" content="th_th" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="//<?php echo $heading_domain; ?>/" />
		<meta property="og:site_name" content="<?php echo $heading_name; ?>" />
		<!meta property="article:publisher" content="//<?php echo $heading_domain; ?>" />
		<meta property="article:modified_time" content="2021-05-13T19:15:00+00:00" />
		<!-- Third parties app setup -->
		<!meta property="fb:app_id" content="132941421905432" />
		<!meta name="google-site-verification" content="gRW1HQaoV9CcViylNyqfgrm2nXztykHOtW4oakRFUXE" />
		<!-- Android standalone A2HS webapp prepare -->
		<!link rel="manifest" href="/reg/resource/appmanifest.webmanifest" crossorigin="use-credentials">
		<!link rel="manifest" href="/reg/resource/extn-manifest.json">
		<meta name="application-name" content="<?php echo $heading_name; ?>">
		<meta name="theme-color" content="#15499A" />
		<!-- iOS standalone A2HS webapp prepare -->
		<meta name="apple-mobile-web-app-title" content="<?php echo $heading_name; ?>">
		<link rel="apple-touch-startup-image" href="/favicon.ico">
		<meta name="apple-mobile-web-app-status-bar-style" content="#15499A">
		<link rel="apple-touch-icon" href="/reg/resource/images/cover-1.png">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="canonical" href="//<?php echo $heading_domain; ?>"/>
		<!-- Resources loading -->
		<link rel="stylesheet" href="/reg/resource/css/core/appstyle.css">
		<link rel="stylesheet" href="/reg/resource/css/core/stylevar.css">
		<link rel="stylesheet" href="/reg/resource/css/core/appobj.css">
		<link rel="stylesheet" href="/reg/resource/css/lib/prism.min.css">
		<script type="text/javascript" src="/reg/resource/js/lib/jquery.min.js"></script>
		<script type="text/javascript" src="/reg/resource/js/core/appscript.js"></script>
		<script type="text/javascript" src="/reg/resource/js/lib/smooth-scroll.min.js"></script>
		<script type="text/javascript" src="/reg/resource/js/core/scroll-control.js"></script>
		<script type="text/javascript" src="/reg/resource/js/lib/prism.min.js"></script>
		<!script type="text/javascript" src="/reg/resource/js/lib/addtohomescreen.min.js"><!/script>