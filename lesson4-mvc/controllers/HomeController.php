<?php
namespace Controllers;
use Models\Product;

class HomeController extends BaseController {



	public function index(){
		$products = Product::all();
		include_once './views/home/index.php';
	}

	public function dashboard(){

	    $this->render('admin.dashboard');
    }
}


 ?>