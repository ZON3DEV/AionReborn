<?php $this->setPageTitle('Userbar Creation'); ?>


<script type="text/javascript" src="<?php echo @Power::url('js/jquery.ddslick.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo @Power::url('js/iColorPicker.js'); ?>"></script>
<script>
	$('document').ready(function(){
		$.getJSON('<?php echo @Power::url('userbar/getfiles'); ?>', function(data) {
			$('#backgroundImageDropdown').ddslick({
				data: data,
				width:440,
				imagePosition:"left",
				onSelected: function(data){
					var img = data.selectedData.imageSrc;
					$('#UserbarForm_image').val(img);
				}
			});
		});
		$('.iColorPicker').change(function(){
			$(this).css('background-color', $(this).val());
		});
		$('#UserbarForm_id').change(function(){
			$('#submitUserbar').removeAttr('disabled');
		});
	});
</script>


<div class="note">
	<div class="note-title">Userbar Creationа</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo $form->errorSummary($post); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post, 'player'); ?></div>
				<div>
					<select id="UserbarForm_id" name="UserbarForm[id]">
						<option value="0">-- Choose a character --</option>
						<?php foreach ($players as $key=>$value): ?>
							<optgroup label="Аккаунт <?php echo $key; ?>">
								<?php foreach ($value as $data): ?>
									<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
								<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="bold">Choose a color</div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post, 'name'); ?></div>
				<div><?php echo $form->textField($post, 'name', array('class'=>'iColorPicker text', 'value'=>'#ffcc00', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'legion'); ?></div>
				<div><?php echo $form->textField($post, 'legion', array('class'=>'iColorPicker text', 'value'=>'#00aeef', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'race_class'); ?></div>
				<div><?php echo $form->textField($post, 'race_class', array('class'=>'iColorPicker text', 'value'=>'#ffffff', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'level'); ?></div>
				<div><?php echo $form->textField($post, 'level', array('class'=>'iColorPicker text', 'value'=>'#ff3300', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'pvp'); ?></div>
				<div><?php echo $form->textField($post, 'pvp', array('class'=>'iColorPicker text', 'value'=>'#00aeef', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'hp_mp'); ?></div>
				<div><?php echo $form->textField($post, 'hp_mp', array('class'=>'iColorPicker text', 'value'=>'#acd372', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'shadow'); ?></div>
				<div><?php echo $form->textField($post, 'shadow', array('class'=>'iColorPicker text', 'value'=>'#000000', 'maxlength'=>7)); ?></div>
			</div>
			<div class="row">
				<div>Select background</div>
				<div class="mb5">
					<div id="backgroundImageDropdown"></div>
					<?php echo $form->hiddenField($post, 'image'); ?>
				</div>
			</div>
			<div class="row">
				<div class="full center"><?php echo CHtml::submitButton('Create Userbar', array('id'=>'submitUserbar','class'=>'button', 'disabled'=>true)); ?></div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>


<?php if ($image): ?>
<div class="note">
	<div class="note-title">Userbar Links</div>
	<div class="note-body">
		<div class="table">
			<div class="row">
				<div>Result</div>
				<div class="mb10"><img src="<?php echo $image; ?>" /></div>
			</div>
			<div class="row">
				<div>Image link</div>
				<div><input class="text" size="50" type="text" value="<?php echo $image; ?>" onClick="select_field(this);"></div>
			</div>
			<div class="row">
				<div>HTML Code</div>
				<div><input class="text" size="50" type="text" value="&lt;a href=&#34<?php echo Yii::app()->homeUrl; ?>&#34;>&lt;img src=&#34;<?php echo $image; ?>&#34; /&gt;&lt;/a&gt;" onClick="select_field(this);"></div>
			</div>
			<div class="row">
				<div>[BB] Code</div>
				<div><input class="text" size="50" type="text" value="[url=<?php echo Yii::app()->homeUrl; ?>][img]<?php echo $image; ?>[/img][/url]" onClick="select_field(this);"></div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>