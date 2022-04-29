<?php $this->setPageTitle('Error '.$error['code']); ?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "UTF-8">
	<title><?php echo @Power::title($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo @Power::theme('images/favicon.png'); ?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo @Power::theme('css/error.css'); ?>" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="note">
			<div class="note-ico"></div>
			<div class="note-title">Error <?php echo $error['code']; ?></div>
			<div class="note-body"><?php echo $error['message']; ?></div>
			<div class="note-link"><a href="javascript:history.go(-1)">come back</a> or at <a href="<?php echo @Power::url(); ?>">home page</a></div>
		</div>
	</div>
</body>
</html>