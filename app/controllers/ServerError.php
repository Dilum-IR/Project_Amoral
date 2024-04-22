<?php
class ServerError extends Controller
{
    public function index()
    {
        $this->view('utils/server_down');
    }
}



