<?php $this->setPageTitle('Причины, по которым вы не можете авторизоваться на сайте'); ?>

<div class="note">
	<div class="note-title"><?php echo $this->getPageTitle(); ?></div>
	<div class="note-body">
		<ul class="loginProblem">
			<li>Неправильно указан логин или пароль.</li>
			<li>Исчерпано максимально возможное количество попыток неправильного ввода пароля.</li>
			<li>Аккаунт заблокирован администрацией.</li>
			<li>Аккаунт не активирован. <b><a href="<?php echo Power::url('user/activation'); ?>" id="activation">Повторно отправить письмо для активации аккаунта</a></b>.</li>
		</ul>
	</div>
</div>