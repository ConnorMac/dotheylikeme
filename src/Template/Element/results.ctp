<?php if(isset($commentsWithScore)): ?>
	<?php if($totalNeg > $totalPos && $totalNeg > $totalNeu): ?>
		<p> <?= $searchString ?> , is seen in an overal negative light </p>
	<?php elseif($totalPos > $totalNeg && $totalPos > $totalNeu): ?>
		<p> <?= $searchString ?> , is seen in an overal positive light </p>
	<?php else: ?>
		<p> <?= $searchString ?> , is neutral </p>
	<?php endif; ?>
	<p>

	</p>
	<p>
		Total Neg: <?= $totalNeg ?> <br>
		Total Pos: <?= $totalPos ?> <br>
		Total Neu: <?= $totalNeu ?>
	</p>
<?php endif; ?>	