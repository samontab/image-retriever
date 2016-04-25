<?php
include("ImageRetriever.php");
include("ImageRetrieverView.php");

$imageRetriever = new ImageRetriever();

$tags = "";
if (isset($_GET['tags']) && !empty($_GET['tags'])) {
	$tags = urldecode($_GET['tags']);
}

$imageRetriever->setTags($tags);
$imageRetriever->setImagesPerPage(20);
$imageRetriever->setPage(1);
$imageRetriever->retrieveImages();

$imageRetrieverView = new ImageRetrieverView($imageRetriever);
echo $imageRetrieverView->output();

