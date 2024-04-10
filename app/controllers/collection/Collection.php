<?php

class Collection extends Controller{
    public function Index()
    {
        $data['data']=$this->getCollection();


        $this->view('collection/collection', $data);


    }

    private function getCollection(){
        // echo 'hello';
        $collection = new DesignCollection();
        return $collection->findAll();

        // show($data);
       

    }
}