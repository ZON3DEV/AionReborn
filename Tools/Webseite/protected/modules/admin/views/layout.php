<?php

	echo '<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "UTF-8">
	<title>';
	echo @Power::title( $this->pageTitle );
	echo '</title>
	<link rel="shortcut icon" href="';
	echo @Power::url( 'images/favicon.png' );
	echo '" type="image/x-icon" />
	<link rel="stylesheet" href="';
	echo @Power::url( 'themes/admin/style.css' );
	echo '" type="text/css" />
	<link rel="stylesheet" href="';
	echo @Power::theme( 'css/modules.css' );
	echo '" type="text/css" />
	';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/jquery-1.8.3.min.js' );
	echo '"></script>
	';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/datatables-1.9.4/jquery.dataTables.min.js' );
	echo '"></script>
	';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/modules.js' );
	echo '"></script>
	';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/tooltip.js' );
	echo '"></script>
	';
	echo '<s';
	echo 'cript type="text/javascript" src="http://aiona.net/js/tooltip.js"></script>
	';
	echo '<s';
	echo 'cript>
		$(document).ready(function() {
			// Active link TODO
			$.each($(".navigation>li>ul>li>a"), function() {
				var r = location.href.split(\'index\')[0].split(\'?\')[0].split(\'#\')[0].split(\'edit\')[0].split(\'view\')[0];
				if (this.href == r) {
					var el = $(this);
					var li = el.parent().parent().parent();
					var ul = el.parent().parent();
					el.addClass(\'current\');
					li.a';
	echo 'ddClass(\'active\');
					ul.show();
				}
			});
			$.each($(".navigation li a"), function() {
				var u = location.href.split(\'index\')[0].split(\'?\')[0].split(\'#\')[0];
				if (this.href == u) $(this).parent().addClass(\'active\');
			});
			 // Navigation sub-menu
			$(".navigation li a.expand").click(function(){
				var ul = $(this).next();
				if (ul.css(\'display\') === \'block\') ul.hide(1';
	echo '00);
				else ul.show(100);
			});
		});
	</script>
</head>


<body>

	<div id="header">
		header
	</div>

	<div id="wrapper">
		<div id="sidebar">
			<ul class="navigation">
				<!-- Main Menu -->
				<li><a href="';
	echo @Power::url(  );
	echo '">Home page</a></li>
				<li><a href="';
	echo @Power::url( 'admin' );
	echo '">Administrator</a></li>
				
				<!-- news -->
				<li>
					<a href="#" class="expand">News management</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/news/add' );
	echo '">Add News</a></li>
						<li><a href="';
	echo @Power::url( 'admin/news' );
	echo '">News list</a></li>
						<li><a href="';
	echo @Power::url( 'admin/news/category' );
	echo '">News Categories</a></li>
					</ul>
				</li>

				<!-- Pages -->
				<li>
					<a href="#" class="expand">Page management</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/page/add' );
	echo '">Add page</a></li>
						<li><a href="';
	echo @Power::url( 'admin/page' );
	echo '">Page list</a></li>
					</ul>
				</li>

				<!-- Accounts -->
				<li>
					<a href="#" class="expand">Accounts</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/user' );
	echo '">a list of users</a></li>
						<li><a href="';
	echo @Power::url( 'admin/account' );
	echo '">Account List</a></li>
						<li><a href="';
	echo @Power::url( 'admin/player' );
	echo '">Character List</a></li>
						<li><a href="';
	echo @Power::url( 'admin/legion' );
	echo '">Legion List</a></li>
					</ul>
				</li>

				<!-- Marketplace -->
				<li>
					<a href="#" class="expand">Marketplace</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/webshop/add' );
	echo '">Add item</a></li>
						<li><a href="';
	echo @Power::url( 'admin/webshop' );
	echo '">List Item</a></li>
						<li><a href="';
	echo @Power::url( 'admin/webshop/category' );
	echo '">WebShop Categories</a></li>
						<li><a href="';
	echo @Power::url( 'admin/webshop/membership' );
	echo '">Premium accounts</a></li>
					</ul>
				</li>

				<!-- Логи -->
				<li>
					<a href="#" class="expand">View reports</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/log/payments' );
	echo '">Balance replenishment</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/webshop' );
	echo '">Marketplace</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/membership' );
	echo '">Premium Buying</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/votes' );
	echo '">Ratings Vote</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/transferpoints' );
	echo '">Point Transfer</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/referrals' );
	echo '">Referrals</a></li>
						<li><a href="';
	echo @Power::url( 'admin/log/auth' );
	echo '">Login</a></li>
					</ul>
				</li>

				<!-- Service -->
				<li>
					<a href="#" class="expand">Service</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/manage/fusioneditems' );
	echo '">Item Fusion</a></li>
						<li><a href="';
	echo @Power::url( 'admin/manage/questcount' );
	echo '">Walkthrough Quest</a></li>
					</ul>
				</li>

				<!-- Game mail -->
				<li>
					<a href="#" class="expand">Game mail</a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/mail' );
	echo '">Mail list</a></li>
						<li><a href="';
	echo @Power::url( 'admin/mail/send' );
	echo '">Send mail</a></li>
					</ul>
				</li>

				<!-- Settings -->
				<li>
					<a href="#" class="expand">Settings</span></a>
					<ul>
						<li><a href="';
	echo @Power::url( 'admin/settings' );
	echo '">Customization Setup</a></li>
						<li><a href="';
	echo @Power::url( 'admin/vote/settings' );
	echo '">Rating settings</a></li>
						<li><a href="';
	echo @Power::url( 'admin/robokassa/settings' );
	echo '">Set up Robokassa</a></li>
						<li><a href="';
	echo @Power::url( 'admin/interkassa/settings' );
	echo '">Setting up Interkassa</a></li>
					</ul>
				</li>
			</ul>
		</div>

		<div id="content">
			';

	if (Yii::app(  )->user->hasFlash( 'message' )) {
		echo Yii::app(  )->user->getFlash( 'message' );
	}

	echo '			';
	echo $content;
	echo '		</div>
	</div>

	<div class="clear"></div>

	<div id="footer">
		<div class="profile">';
	echo @Power::profile(  );
	echo '</div>
		<div class="copyright">';
	echo @Power::copyright(  );
	echo '</div>
	</div>
</body>
</html>
';
?>