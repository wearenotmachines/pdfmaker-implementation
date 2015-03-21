<div class="row">
	<div class="col-sm-6 col-md-offset-3">
		<form action="/save-section/<?= $project->getSlug(); ?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="section[id]" value="<?= empty($section) ? "" : $section->getID(); ?>" />
			<input type="hidden" name="section[project_id]" value="<?= $project->getID(); ?>" />

			<div class="form-group">
				<label>Section title</label>
				<input type="text" name="section[title]" class="form-control" placeholder="What's it called?" value="<?= empty($section) ? "" : $section->getTitle(); ?>" autocomplete="off" />
			</div>
			
			<div class="form-group">
				<label>Section description</label>
				<textarea name="section[description]" class="form-control" placeholder="Say something about it" autocomplete="off"><?= empty($section) ? "" : $section->getDescription(); ?></textarea>
			</div>

			<button class="btn btn-large btn-default">Save this project</button>

		</form>
	</div>
</div>