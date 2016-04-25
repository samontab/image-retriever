<?php
class ImageRetrieverView
{
    private $model;

    public function __construct($model) {
        $this->model = $model;

    }

    public function output() {
	$httpForm = '
	<form action="index.php" method="get">
	<input type="text" name="tags" value="' . htmlspecialchars($this->model->getTags()) . '">
	<input type="submit" value="Get Images!">
	</form>
	';

	$httpImages = "";
	foreach ($this->model->getImages() as $image) {
	    $imageTitle = $image['title'];
	    $imageUrl = $image['url'];
	    $httpImages .= "<img alt='".$imageTitle."' title='".$imageTitle."' src='".$imageUrl."' />";
	}

	return $httpForm . $httpImages;
    }
}

