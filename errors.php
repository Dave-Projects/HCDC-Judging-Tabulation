
<?php if (count($errors) > 0): ?>
	<div class="alert alert-info animated bounceInDown" role="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php foreach ($errors as $error): ?>
			<p><?php echo "".$error.""; ?></p>
			<?php endforeach ?>
	</div>
<?php endif ?>