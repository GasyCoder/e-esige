<?php 
class AdminController extends BaseController {


    public function index() {
        return View::make('components.panel');
    }



}