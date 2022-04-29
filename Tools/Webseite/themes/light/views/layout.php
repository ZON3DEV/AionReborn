<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "UTF-8">
	<title><?php echo @Power::title($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo @Power::url('images/favicon.png'); ?>" type="image/x-icon" />
	
	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo @Power::theme('css/style.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo @Power::theme('css/widget.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo @Power::theme('css/modules.css'); ?>" type="text/css" />
	
	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo @Power::url('js/jquery-2.0.2.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo @Power::url('js/datatables-1.9.4/jquery.dataTables.min.js'); ?>"></script>

	<!-- PowerWeb JS -->
	<script type="text/javascript" src="<?php echo @Power::url('js/modules.js'); ?>"></script>
	<script type="text/javascript" src="http://aiona.net/js/tooltip.js"></script>
</head>

<body>
	<!-- Background -->
	<div class="background"></div>
	<!-- End Background -->

	<!-- Navbar -->
	<div id="navbar" class="wrapper">
		<ul class="navbar">
			<li><a href="<?php echo @Power::url(); ?>">Home</a></li>
			<li><a href="<?php echo @Power::url('top/online'); ?>">Player Online</a></li>
			<li><a href="<?php echo @Power::url('top/players'); ?>">Top Player</a></li>
			<li><a href="<?php echo @Power::url('top/legions'); ?>">Top Legion</a></li>
			<li><a href="<?php echo @Power::url('siege'); ?>">Fortress</a></li>
			<li><a href="<?php echo @Power::url('stats'); ?>">Statistic</a></li>
			<li><a href="/forum/">Forum</a></li>
		</ul>
	</div>
	<!-- End Navbar -->

	<!-- Logo -->
	<div id="logo"></div>
	<!-- End Logo -->

	<!-- Wrapper -->
	<div class="wrapper">
		<!-- Content -->
		<div id="content">
			<?php //$this->widget('application.components.widgetTop', array('onlyMain'=>true, 'limit'=>10, 'order'=>'daily_kill DESC, weekly_kill DESC')); ?>
			<?php echo $content; ?>
		</div>
		<!-- End Content -->

		<!-- Sidebar -->
		<div id="sidebar">
<!--		
<center>
			<div class="play">
				<div class="play-button">
					<div class="play-text">
						<a href="#">Download client</a>
					</div>
					<div class="play-text-small">
						<a href="#">Download launcher</a>
					</div>
				</div>
			</div>
   </center>
<!-- Рестарт -->
             <div class="menu">
				<div class="menu-title">Account</div>
				<div class="menu-body">
					<?php if (@Power::isGuest()): ?>
						<ul class="list">
							<li><a href="<?php echo @Power::url('user/login'); ?>">Log in to your account</a></li>
							<li><a href="<?php echo @Power::url('user/registration'); ?>">Register an account</a></li>
							<li><a href="<?php echo @Power::url('user/resetpassword'); ?>">Restore password</a></li>
							<li><a href="<?php echo @Power::url('user/activation'); ?>">Reactivate Account</a></li>
						</ul>
					<?php else: ?>
						<ul class="list">
						<?php if (@Power::isAdmin()): ?><li><a href="<?php echo @Power::url('admin'); ?>">Administrator</a></li><?php endif; ?>
							<li><a href="<?php echo @Power::url('user'); ?>">Profile (<b><?php echo @Power::userName(); ?></b>)</a></li>
							<li><a href="<?php echo @Power::url('account'); ?>">Game Accounts</a></li>
							<li><a href="<?php echo @Power::url('balance'); ?>">Balance management</a></li>
							<li><a href="<?php echo @Power::url('webshop'); ?>">Market Place</a></li>
							<li><a href="<?php echo @Power::url('vote'); ?>">Bonuses for voting</a></li>
							<li><a href="<?php echo @Power::url('referrals'); ?>">Referral Bonuses</a></li>
							<li><a href="<?php echo @Power::url('userbar'); ?>">Userbar generator</a></li>
							<li><a href="<?php echo @Power::url('logs'); ?>">View reports</a></li>
							<li><a href="<?php echo @Power::url('user/settings'); ?>">Settings</a></li>
							<li><a href="<?php echo @Power::url('user/logout'); ?>">Logout</a></li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			<div class="menu">
				<div class="menu-title">Menu</div>
				<div class="menu-body">
					<ul class="list">
						<li><a href="<?php echo @Power::url(); ?>">Main</a></li>
						<li><a href="<?php echo @Power::url('top/online'); ?>">Player Online</a></li>
						<li><a href="<?php echo @Power::url('top/players'); ?>">Top Player</a></li>
						<li><a href="<?php echo @Power::url('top/legions'); ?>">Top Legions</a></li>
						<li><a href="<?php echo @Power::url('siege'); ?>">Fortress</a></li>
						<li><a href="<?php echo @Power::url('player/search'); ?>">Player Search</a></li>
						<li><a href="<?php echo @Power::url('droplist'); ?>">Droplist</a></li>
						<li><a href="<?php echo @Power::url('broker'); ?>">Broker</a></li>
						<li><a href="<?php echo @Power::url('stats'); ?>">Statistic</a></li>
					</ul>
				</div>
			</div>
			<div class="menu">
				<div class="menu-title">Online</div>
				<div class="menu-body">
					<ul class="list">
						<li><?php $this->widget('application.components.widgetServerStatus'); ?></li>
						<li>Total Online: <b><?php echo @Status::online('all'); ?></b></li>
						<li>Asmodian Online: <b><?php echo @Status::online('asmo'); ?></b></li>
						<li>Elyos Online: <b><?php echo @Status::online('ely'); ?></b></li>
					</ul>
				</div>
			</div>

			<?php $this->widget('application.components.widgetGm'); ?>

			<?php //$this->widget('application.components.WidgetForum', array('onlymain'=>true, 'topics'=>5)); ?>

			<div class="menu">
				<div class="menu-title">Voting</div>
				<div class="menu-body">
					<div class="voting-banner">
						<a href="#"><img src="<?php echo @Power::url('images/banner_mmotop.png'); ?>" /></a>
						<div class="clear"></div>
					</div>
					<div class="voting-info">When voting, please indicate <b>game account login</b></div>
				</div>
			</div>

		</div>
		<!-- End Sidebar -->

		<div class="clear"></div>
	</div>
	<!-- End Wrapper -->

	<!-- Footer -->
	<div id="footer" class="wrapper">
		<div class="footer-body">
			<?php echo @Power::profile(); ?><br />
			<div class="mt10"><?php echo @Power::copyright(); ?></div>
		</div>
	</div>
	<!-- End Footer -->

</body>
</html>