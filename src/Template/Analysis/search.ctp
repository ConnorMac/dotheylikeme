<div class="small-12 columns">
	<div class="row">
	<?php if(isset($error)): ?>
		<p><?= $error ?></p>
	<?php elseif(isset($commentsWithScore)): ?>

		<!-- Overal Results Display -->
		<div class="small-12 medium-2 large-offset-3 columns text-center">
			<?php if($totalNeg > $totalPos && $totalNeg > $totalNeu): ?>
				<i class="fa fa-frown-o"></i>
			<?php elseif($totalPos > $totalNeg && $totalPos > $totalNeu): ?>
				<i class="fa fa-smile-o"></i>
			<?php else: ?>
				<i class="fa fa-neuter"></i>
			<?php endif; ?>
		</div>
		<div class="small-12 medium-5 columns result-details">
			<?php if($totalNeg > $totalPos && $totalNeg > $totalNeu): ?>
				<p> <strong><?= $searchString ?></strong> , is seen in an overal negative light </p>
			<?php elseif($totalPos > $totalNeg && $totalPos > $totalNeu): ?>
				<p> <strong><?= $searchString ?></strong> , is seen in an overal positive light </p>
			<?php else: ?>
				<p> <strong><?= $searchString ?></strong> , is neutral </p>
			<?php endif; ?>
			<p>
				<span class="red bold">Negetivity Score:</span> <?= $totalNeg ?> <br>
				<span class="blue bold">Positivity Score:</span> <?= $totalPos ?> <br>
				<span class="bold">Neutral Score:</span> <?= $totalNeu ?> <br>
			</p>
		</div>

		<?= $this->Html->scriptBlock('var commentsJson=' . $commentsWithScore); ?>
		<?= $this->Html->scriptBlock('handleComments()'); ?>
	</div>

	<div class="clear"></div>
	
	<!-- Comment Control -->
	<div class="row">
		<div class="small-12 medium-6 columns comment-controls jsCommentControls">	
			<input type="checkbox" id="pos" name="pos" class="jsHideComment" data-rating="pos">
			<label for="pos">Hide positive</label>
			
			<input type="checkbox" id="neg" name="neg" class="jsHideComment" data-rating="neg">
			<label for="neg">Hide negative</label>
			
			<input type="checkbox" id="neu" name="neu" class="jsHideComment" data-rating="neu">
			<label for="neu">Hide neutral</label>
		</div>
	</div>

	<!-- Comments holder, populated via javascript -->
	<div class="row">
		<div class="small-12 medium-8 large-centered columns comment-wrapper jsComments"></div>
	</div>
	<?php endif; ?>
</div>