<!-- Initial Body -->
<div class="row">
	<div class="small-12 columns text-center heading-text">
		<h2>
			Enter a company name to see what Reddit thinks about it.
		</h2>
	</div>
</div>

<div class="row search-form">
	<div class="small-12 medium-4 large-centered columns">
		<?= $this->Form->create() ?>
		<?= $this->Form->input('search', ['label' => FALSE]) ?>
		<?= $this->Form->button('<i class="fa fa-heartbeat"></i> Find out', ['class' => 'button jsSubmit']); ?>
		<?= $this->Form->end(); ?>
	</div>
</div>
<!-- End initial Body -->

<!-- Ajax spinner -->
<div class="row jsAjaxLoader">
	<div class="small-12 columns text-center">
		<p class="loading-text">Processing Reddit posts...</p>
		<i class="fa fa-spin fa-cog loader"></i>
	</div>
</div>

<!-- Results holder, filled via ajax -->
<div class="row jsResults"></div>