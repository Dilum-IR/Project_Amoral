<?php

class Guest extends Controller
{
    public function index()
    {

        $guestgarment = new GuestGarment;

        if (isset($_POST["guest_register"])) {

            unset($_POST["guest_register"]);
            // show($_POST);
            $guestgarment->insert($_POST);
            redirect("home");

        }
        $this->view('home/guest');
    }
}
