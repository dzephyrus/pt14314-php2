<?php 
// require_once './Category.php';
// require_once './User.php';

// $cates = Category::all();
// echo "<pre>";
// var_dump($cates);die;

class A{
	private $salary = 4800;
	protected $isMarried = "Đã có bồ";

	function getSalary(){
		return $this->salary;
	}
}

class B extends A{

	function getRelation(){
		return $this->isMarried;
	}
}

$dat = new B();

echo $dat->getSalary();









 ?>