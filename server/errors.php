<?php if (count($errors) > 0): ?>
	<div class="errors">
		<?php foreach ($errors as $error): ?>
			<p><?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>