<div class="row">
	<div class="col-sm-6 col-md-offset-3">
		<form action="/save-project" method="post" enctype="multipart/form-data">

			<input type="hidden" name="project[id]" value="<?= empty($project) ? "" : $project->getID(); ?>" />
			
			<div class="form-group">
				<label>Project title</label>
				<input type="text" name="project[title]" class="form-control" placeholder="What's it called?" value="<?= empty($project) ? "" : $project->getTitle(); ?>" autocomplete="off" />
			</div>
			
			<div class="form-group">
				<label>Project Description</label>
				<textarea name="project[description]" class="form-control" placeholder="Say something about it" autocomplete="off"><?= empty($project) ? "" : $project->getDescription(); ?></textarea>
			</div>

			<button class="btn btn-large btn-default">Save this project</button>

		</form>
	</div>
</div>