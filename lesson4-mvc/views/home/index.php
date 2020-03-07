<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php if(isset($_GET['msg'])):?>
        <p class="text-danger"><?= $_GET['msg']; ?></p>
    <?php endif?>
    <table class="table table-stripped">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th width="100">Image</th>
            <th>Price</th>
            <th>Star</th>
            <th>
                <a href="<?= BASE_URL . "add-product"?>" class="btn btn-sm btn-success">Thêm</a>
            </th>
        </thead>
        <tbody>
        <?php foreach($products as $pro):?>
            <tr>
                <td><?php echo $pro->id ?></td>
                <td><?php echo $pro->name ?></td>
                <td>
                    <img src="<?= BASE_URL . $pro->image?> " class="img-fluid">
                </td>
                <td><?php echo $pro->price ?></td>
                <td><?php echo $pro->star ?></td>
                <td>
                    <a href="<?= BASE_URL . "edit-product?id=$pro->id"?>" class="btn btn-sm btn-primary">Sửa</a> &nbsp;
                    <a href="<?= BASE_URL . "products/remove/$pro->id"?>" class="btn btn-sm btn-danger btn-remove">Xóa</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function(){
            $('.btn-remove').on('click', function(){
                Swal.fire({
                    title: 'Cảnh báo!',
                    text: "Bạn chắc chắn muốn xóa sản phẩm này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!'
                }).then((result) => {
                    if (result.value) {
                        var url = $(this).attr('href');
                        window.location.href = url;
                    }
                })
                return false;
            });
        });
    </script>
</body>
</html>