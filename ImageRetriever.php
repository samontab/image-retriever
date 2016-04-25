<?php
class ImageRetriever
{
    private $base_url;
    private $api_key;
    private $tags;
    private $perPage;
    private $pageNum;
    private $images;

    public function __construct(){
        $this->base_url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
        $this->api_key = 'INSERT_YOUR_API_KEY_HERE';
        $this->tags = '';
        $this->perPage = 20;
        $this->pageNum = 1;
    }

    public function retrieveImages()
    {
	$this->images = array();

        $url = $this->base_url;
        $url.= '&api_key='.$this->api_key;
        $url.= '&tags='.urlencode($this->tags);
        $url.= '&per_page='.$this->perPage;
        $url.= '&page='.$this->pageNum;
        $url.= '&format=json';
        $url.= '&nojsoncallback=1';

        $response = json_decode(file_get_contents($url));

        $photo_array = $response->photos->photo;

	if(sizeof($photo_array) > 0)
        foreach($photo_array as $single_photo){
         $farm_id = $single_photo->farm;
         $server_id = $single_photo->server;
         $photo_id = $single_photo->id;
         $secret_id = $single_photo->secret;
         $size = 'm';

         $title = $single_photo->title;

         $photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';

	 $image = array('title' => $title, 'url' => $photo_url);
	 array_push($this->images, $image);         
        }        

    }


    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function setImagesPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
    public function setPage($page)
    {
        $this->pageNum = $page;
    }

    public function getTags()
    {
        return $this->tags;
    }
    public function getImagesPerPage()
    {
        return $this->perPage;
    }
    public function getPage()
    {
        return $this->pageNum;
    }
    public function getImages()
    {
        return $this->images;
    }
}
