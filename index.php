<?php 
ini_set("display_errors", "On");
error_reporting(E_ALL);

require_once "vendor/autoload.php";

$app = new Slim\Slim([
	"templates.path" => "./app/views/"
]);

$app->get("/", function() {
	echo "Hello";
});

$app->get("/create-project", function() use ($app) {

	$data = [ "title"=>"Setup your project", "bodyClass"=>"projects" ];

	$app->render("header.php", $data);
	$app->render("projects/define.php", $data);
	$app->render("footer.php", $data);

});

$app->post("/save-project", function() use ($app) {

	$project = new \WeAreNotMachines\PDFMaker\PDFProject($_POST['project']);
	$factory = (new \WeAreNotMachines\PDFMaker\Factories\PDFProjectFactory);

	$factory->save($project);
	$app->redirect("/project/".$project->getSlug());

});

$app->get("/project/:slug", function($slug) use ($app) {

	$project = (new \WeAreNotMachines\PDFMaker\Factories\PDFProjectFactory)->load($slug);

	$data = [ "title"=>$project->getTitle(), "bodyClass"=>"projects", "project"=>$project ];

	$app->render("header.php", $data);
	$app->render("projects/define.php", $data);
	$app->render("footer.php", $data);

});

$app->get("/project/:slug/add-section", function($slug) use ($app) {
	
	$project = (new \WeAreNotMachines\PDFMaker\Factories\PDFProjectFactory)->load($slug);

	$data = [ "title"=>$project->getTitle(), "bodyClass"=>"sections", "project"=>$project ];

	$app->render("header.php", $data);
	$app->render("sections/define.php", $data);
	$app->render("footer.php", $data);

});

$app->post("/save-section/:projectSlug", function($projectSlug) use ($app) {

	$section = new \WeAreNotMachines\PDFMaker\PDFSection($_POST['section']);
	$project = new \WeAreNotMachines\PDFMaker\PDFProject(["id"=>$_POST['section']['project_id']]);
	$section->setProject($project);
	$factory = (new \WeAreNotMachines\PDFMaker\Factories\PDFSectionFactory);

	$factory->save($section);

	$app->redirect("/project/$projectSlug/".$section->getSlug());

});

$app->get("/project/:project/:section", function($projectSlug, $sectionSlug) use ($app) {

	$project = (new \WeAreNotMachines\PDFMaker\Factories\PDFProjectFactory)->load($projectSlug);
	$section = (new \WeAreNotMachines\PDFMaker\Factories\PDFSectionFactory)->load($sectionSlug, $projectSlug);

	$data = [ "title"=>$project->getTitle().": ".$section->getTitle(), "bodyClass"=>"section", "project"=>$project, "section"=>$section ];

	$app->render("header.php", $data);
	$app->render("sections/define.php", $data);
	$app->render("footer.php", $data);

});

$app->run();