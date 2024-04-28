<?php

class DesignCollection extends Controller{
    public function Index()
    {
        // $data['data']=$this->getCollection();
        $collection = new Collection;

        $result = $collection->findAll('image_id');
        $data = ['data' => $result];
        // show($data);
        $this->view('collection/collection', $data);

    }

}