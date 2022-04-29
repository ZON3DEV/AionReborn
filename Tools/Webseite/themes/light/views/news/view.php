<?php $this->setPageTitle($model['title']); ?>

<div class="note">
	<a class="note-category" href="<?php echo @Power::url('news/category', $model['category_alt_name']); ?>">
		<img src="<?php echo @Power::url('images/news', $model['image_id']); ?>" title="<?php echo $model['category_name']; ?>" />
	</a>
	<div class="note-title"><?php echo $model['title']; ?></div>
	<div class="note-body">
		<div class="note-text"><?php echo nl2br($model['text_full']); ?></div>
		<div class="note-date"><?php echo @Power::date($model['date'], 'd MMMM yyyy, HH:mm'); ?></div>
		<div class="clear"></div>
	</div>
</div>


<?php if (@Power::isAuth() AND Config::get('news_comment_enable') AND $model['comments_enable']): ?>
	<div class="note">
		<div class="note-title">Add a comment</div>
		<div class="note-body">
			<?php $form=$this->beginWidget('CActiveForm', array('id'=>'comment-form')); echo @Power::message(); ?>
				<?php echo $form->error($post,'message'); ?>
				<div><?php echo $form->textArea($post, 'message', array('size'=>1024)); ?></div>
				<?php echo CHtml::submitButton('Add a comment', array('class'=>'button')); ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>
<?php endif; ?>


<?php foreach ($comments as $data): ?>
	
	<div class="comment">
		<div class="comment-author"><?php echo $data['login']; ?></div>
		<div class="comment-date"><?php echo @Power::date($data['date'], 'dd.MM.yyyy, HH:mm'); ?></div>
		<div class="comment-body"><?php echo nl2br($data['message']); ?></div>
	</div>
	<div class="comment-avatar">
		<?php ($data['avatar_id']) ? $avatar = @Power::url('avatars', $data['avatar_id']) : $avatar = @Power::url('images/noavatar.png') ; ?>
		<img src="<?php echo $avatar; ?>" />
	</div>
	<div class="clear"></div>
<?php endforeach; ?>