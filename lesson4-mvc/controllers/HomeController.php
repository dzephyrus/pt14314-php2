<?php
namespace Controllers;
use Models\Product;
class HomeController{


	public function index(){
		$products = Product::getAll();
		include_once './views/home/index.php';
	}

	public function about(){
		echo "Day la trang gioi thieu";
	}
}


 ?>