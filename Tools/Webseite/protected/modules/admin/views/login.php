<?php

	echo '<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "UTF-8">
	<title>Administrator</title>
	<link rel="shortcut icon" href="';
	echo @Power::url( 'images/favicon.png' );
	echo '" type="image/x-icon" />
	<link rel="stylesheet" href="';
	echo @Power::url( 'themes/admin/login.css' );
	echo '" type="text/css" />
</head>
<body>
	';
	echo '<s';
	echo 'ection id="loginBox">
		';

	$form = $this->beginWidget( 'CActiveForm' );
	echo '		<div class="field">
			';
	echo $form->textField( $post, 'username', array( 'placeholder' => 'Username' ) );
	echo '			';
	echo $form->error( $post, 'username', array( 'class' => 'errorPopup' ) );
	echo '		</div>
		<div class="field">
			';
	echo $form->passwordField( $post, 'password', array( 'placeholder' => 'Password' ) );
	echo '			';
	echo $form->error( $post, 'password', array( 'class' => 'errorPopup' ) );
	echo '		</div>
		<div class="field">
			';
	echo $form->textField( $post, 'captcha', array( 'placeholder' => 'Code from the picture' ) );
	echo '			';
	$this->widget( 'CCaptcha', array( 'showRefreshButton' => false, 'clickableImage' => true ) );
	echo '			';
	echo $form->error( $post, 'captcha', array( 'class' => 'errorPopup' ) );
	echo '		</div>
		<div class="button">';
	echo CHtml::submitbutton( 'Enter', array( 'class' => 'button' ) );
	echo '</div>
		';
	$this->endWidget(  );
	echo '	</section>
</body>
</html>';
?>