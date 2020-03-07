<?php
namespace Controllers;
use Models\Product;
use Models\Category;

class ProductController extends BaseController {

	public function detail(){
		echo "Trang chi tiet san pham";
	}

	public function remove($id){

        // lấy ra sản phẩm dựa vào id
        $product = Product::find($id);
        if($product == null){
            header("location: " . BASE_URL . "?msg=id không tồn tại");
            die;
        }

        // xoá sản phẩm dựa vào id
        Product::destroy($id);
        header("location: " . BASE_URL . "?msg=Xóa thành công!");
        die;
    }

    public function addForm(){
	    $cates = Category::all();
	    include_once './views/home/add-product.php';
    }

    public function editForm(){
	    $cates = Category::getAll();
	    $id = isset($_GET['id']) ? $_GET['id'] : -1;
	    // lấy ra dữ liệu của sản phẩm theo id
        $product = Product::findOne($id);
        if(!$product){
            header("location: " . BASE_URL . "?msg=id không tồn tại");
            die;
        }

	    include_once './views/home/edit-product.php';
    }

    public function saveAdd(){
	    $model = new Product();
        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['image'];
        $filename = "";
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->image = $filename;
        // lưu dữ liệu với csdl
        $model->save();
        header('location: ' . BASE_URL);
        die;
    }

    public function saveEdit(){
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $model = Product::find($id);
        if(!$model){
            header("location: " . BASE_URL . "?msg=id không tồn tại");
            die;
        }

        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['image'];
        $filename = $model->image;
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->image = $filename;
        // lưu dữ liệu với csdl
        $model->save();
        header('location: ' . BASE_URL);
        die;
    }

    public function saveEdit(){
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;
        $model = Product::findOne($id);
        if(!$model){
            header("location: " . BASE_URL . "?msg=id không tồn tại");
            die;
        }

        // gán dữ liệu cho model
        $model->fill($_POST);
        // validate dữ liệu thêm 1 lần nữa bằng php => form
        // lưu file ảnh
        $image = $_FILES['image'];
        $filename = $model->image;
        if($image['size'] > 0){
            $filename = "public/images/" . uniqid() . '-' . $image['name'];
            move_uploaded_file($image['tmp_name'], $filename);
        }
        $model->image = $filename;
        // lưu dữ liệu với csdl
        $model->update();
        header('location: ' . BASE_URL);
        die;
    }

    public function checkNameExisted(){
	    $name = $_POST['name'];
	    $id = isset($_POST['id']) ? $_POST['id'] : -1;

	    $queryData = Product::where('name', $name);

	    if($id != -1){
	        $queryData->where('id', '!=', $id);
        }
        $numberRecord = $queryData->count();

	    echo $numberRecord == 0 ? "true" : "false";

    }
}

 ?>