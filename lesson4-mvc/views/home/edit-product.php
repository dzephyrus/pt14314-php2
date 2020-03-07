<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .form-group label.error{
            color: indianred;
        }
        .main-content{
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container main-content">
        <h3>Cập nhật thông tin sản phẩm</h3>
        <form id="edit-product-form" action="<?= BASE_URL . 'save-edit-product'?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product->id?>">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên sản phẩm<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="<?= $product->name?>"
                               placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục sản phẩm</label>
                        <select name="cate_id" class="form-control">
                            <?php foreach ($cates as $ca):?>
                            <option
                                    <?php if($ca->id == $product->cate_id):?>
                                        selected
                                    <?php endif?>
                                    value="<?= $ca->id ?>"><?= $ca->cate_name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm<span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control"
                               value="<?= $product->price?>"
                               placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng views</label>
                        <input type="number" name="views" class="form-control"
                               value="<?= $product->views?>"
                               placeholder="Nhập số lượt xem sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả ngắn</label>
                        <textarea name="short_desc" class="form-control" rows="5"><?= $product->short_desc?></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <img src="<?= BASE_URL . $product->image ?>" class="img-fluid" id="img-preview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh sản phẩm<span class="text-danger">*</span></label>
                        <input type="file" onchange="encodeImageFileAsURL(this)"  name="image" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Số sao</label>
                        <input type="number" name="star"
                               value="<?= $product->star?>"
                               class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Chi tiết</label>
                        <textarea name="detail" class="form-control" rows="7"><?= $product->detail ?></textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>&nbsp;
                    <a href="<?= BASE_URL ?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script>
    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        if(file === undefined){
            $("#img-preview").attr("src", "<?= BASE_URL . $product->image ?>");
            return false;
        }
        var reader = new FileReader();
        reader.onloadend = function() {
            $("#img-preview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
    $(document).ready(function(){

        // tên: bắt buộc nhập, tối thiểu 2 ký tự
        // giá: bắt buộc nhập, phải là số, không âm
        // views: ko bắt buộc nhập, phải là số, không âm
        // star: ko bắt buộc nhập, phải là số, không âm, nằm trong khoảng 0-5
        // ảnh sản phẩm: bắt buộc nhập, chỉ chấp nhận định dạng ảnh
        $('#edit-product-form').validate({
            rules:{
                name: {
                    required: true,
                    minlength: 2,
                    remote: {
                        url: "<?= BASE_URL . 'check-product-name'?>",
                        type: "post",
                        data: {
                            name: function() {
                                return $( "input[name='name']" ).val();
                            },
                            id: function(){
                                return $( "input[name='id']" ).val();
                            }
                        }
                    }
                },
                price: {
                    required: true,
                    number: true,
                    min: 1
                },
                views: {
                    number: true,
                    min: 0
                },
                star: {
                    min: 0,
                    max: 5
                },
                image: {
                    extension: "jpg|png|jpeg|gif"
                }
            },
            messages:{
                name: {
                    required: "Nhập tên sản phẩm",
                    minlength: "Tối thiểu 2 ký tự",
                    remote: "Tên sản phẩm đã tồn tại, vui lòng chọn tên khác"
                },
                price: {
                    required: "Nhập giá sản phẩm",
                    number: "Yêu cầu nhập số",
                    min: "Giá trị nhỏ nhất là 1"
                },
                views: {
                    number: "Yêu cầu nhập số",
                    min: "Không nhập số âm"
                },
                star: {
                    max: "Star không lớn hơn 5",
                    min: "Không nhập số âm"
                },
                image: {
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                }
            }
        });
    });
</script>
</body>
</html>