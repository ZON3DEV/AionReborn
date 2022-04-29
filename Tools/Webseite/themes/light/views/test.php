<div class="note">

<select>
	<option>-- Выберите персонажа --</option>
	<?php foreach ($model as $key=>$value): ?>
		<optgroup label="<?php echo $key; ?>">
			<?php foreach ($value as $data): ?>
				<option><?php echo $data['name']; ?></option>
			<?php endforeach; ?>
		</optgroup>
	<?php endforeach; ?>
</select>

<br><br>

Curabitur ultrices est eu eleifend imperdiet. In euismod ligula leo, ut ultricies ante tempor ut.
Pellentesque est justo, congue sit amet lorem sit amet, condimentum hendrerit arcu.
Cras et est ac leo suscipit pulvinar mollis in tellus.
Sed ultricies, massa vel pharetra semper, purus nunc semper mi, vitae lobortis mauris est eu ipsum.
Ut semper id odio non volutpat. Mauris sed interdum purus.
Curabitur tincidunt fringilla lectus, id rutrum felis convallis vitae.Nullam in pellentesque orci.
Nunc adipiscing lacinia faucibus. In rutrum, leo sed consectetur tempor, orci tellus pulvinar elit, blandit feugiat lacus dui et orci.
Curabitur posuere volutpat lacus. Mauris vel orci sit amet erat interdum molestie sagittis quis dui.
Nam condimentum, lorem vel bibendum auctor, leo tortor fermentum ante, quis sagittis nisl ligula et ligula.
Phasellus vulputate nunc ac augue condimentum, nec ornare nibh dignissim. Praesent quis auctor lectus.

<br><br>

<button class="show-modal button" modal="modal-test">Show modal</button>

</div>




<div class="modal none" id="modal-test">

<div class="modal-body">

Vivamus at blandit velit. Suspendisse potenti. Etiam aliquam varius turpis.
Aenean dolor odio, tempor at est vel, bibendum fermentum augue.
Cras odio purus, molestie in tortor eget, sodales egestas velit.
Cras nec semper justo. Sed dictum nisl velit, vitae placerat risus blandit a.
Aliquam dignissim enim quis leo condimentum mollis.
Proin libero lectus, laoreet et mi quis, sagittis congue lectus.
Mauris pretium metus et ligula luctus, quis tempor quam dignissim. 

<br><br>

<button class="close-modal button right" modal="modal-test">Close modal</button>

</div>

</div>