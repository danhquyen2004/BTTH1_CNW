<?php
$flowers = [
    [
        "name" => "Hoa dạ yến thảo",
        "description" => "Dạ yến thảo là lựa chọn thích hợp cho những ai yêu thích trồng hoa làm đẹp nhà ở. Hoa có thể nở rực quanh năm, kể cả tiết trời se lạnh của mùa xuân hay cả những ngày nắng nóng cao điểm của mùa hè. Dạ yến thảo được trồng ở chậu treo nơi cửa sổ hay ban công, dáng hoa mềm mại, sắc màu đa dạng nên được yêu thích vô cùng.",
        "image" => "images/dayenthao.png"
    ],
    [
        "name" => "Hoa đồng tiền",
        "description" => "Hoa đồng tiền thích hợp để trồng trong mùa xuân và đầu mùa hè, khi mà cường độ ánh sáng chưa quá mạnh. Cây có hoa to, nở rộ rực rỡ, lại khá dễ trồng và chăm sóc nên sẽ là lựa chọn thích hợp của bạn trong tiết trời này. Về mặt ý nghĩa, hoa đồng tiền cũng tượng trưng cho sự sung túc, tình yêu và hạnh phúc viên mãn.",
        "image" => "images/dongtien.png"
    ],
    [
        "name" => "Hoa giấy",
        "description" => "Hoa giấy có mặt ở hầu khắp mọi nơi trên đất nước ta, thích hợp với nhiều điều kiện sống khác nhau nên rất dễ trồng, không tốn quá nhiều công chăm sóc nhưng thành quả mang lại sẽ khiến bạn vô cùng hài lòng. Hoa giấy mỏng manh nhưng rất lâu tàn, với nhiều màu như trắng, xanh, đỏ, hồng, tím, vàng… cùng nhiều sắc độ khác nhau. Vào mùa khô hanh, hoa vẫn tươi sáng trên cây khiến ngôi nhà luôn luôn bừng sáng.",
        "image" => "images/hoagiay.png"
    ]
];

// Thêm chức năng thêm hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['description']) && isset($_FILES['image'])) {
        $uploadDir = 'images/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $newFlower = [
                "name" => htmlspecialchars($_POST['name']),
                "description" => htmlspecialchars($_POST['description']),
                "image" => $imagePath
            ];
            $flowers[] = $newFlower;
        } else {
            echo "<script>alert('Lỗi khi tải ảnh lên. Vui lòng thử lại!');</script>";
        }
    }
}

// Kiểm tra nếu có yêu cầu sửa thông tin hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editIndex'])) {
    $editIndex = (int)$_POST['editIndex'];

    if (isset($flowers[$editIndex])) {
        // Cập nhật thông tin hoa
        $flowers[$editIndex]['name'] = htmlspecialchars($_POST['name']);
        $flowers[$editIndex]['description'] = htmlspecialchars($_POST['description']);

        // Cập nhật lại thông tin trong mảng hoặc cơ sở dữ liệu (nếu cần)
        // Ví dụ: lưu vào session (nếu dữ liệu không lưu vào cơ sở dữ liệu)
        $_SESSION['flowers'] = $flowers;

        // Chuyển hướng về trang chính sau khi sửa (để reload dữ liệu)
        header("Location: ?");
    } else {
        echo "<script>alert('Không tìm thấy hoa để sửa.');</script>";
    }
}

// Kiểm tra nếu có yêu cầu xóa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteIndex'])) {
    $deleteIndex = (int)$_POST['deleteIndex'];
    if (isset($flowers[$deleteIndex])) {
        // Xóa hoa từ mảng
        array_splice($flowers, $deleteIndex, 1);
        
        //header("Location: ?");
        exit();
    } else {
        echo "<script>alert('Không tìm thấy hoa để xóa.');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <h1 style="text-align: center;">Danh sách các loài hoa</h1>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFlowerModal">Thêm hoa</button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên hoa</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= $flower['name'] ?></td>
                        <td><?= $flower['description'] ?></td>
                        <td>
                            <img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" style="width:100px; height:auto;">
                        </td>
                        <td>
                            <!-- Nút sửa, hiển thị modal -->
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editFlowerModal" 
                                    data-name="<?= $flower['name']; ?>"
                                    data-description="<?= $flower['description']; ?>"
                                    data-index="<?= $index; ?>">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </td>
                        <td>
                            <!-- Nút xóa không có xác nhận -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="deleteIndex" value="<?= $index; ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- Modal Thêm hoa -->
    <div class="modal fade" id="addFlowerModal" tabindex="-1" aria-labelledby="addFlowerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFlowerModalLabel">Thêm hoa mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên hoa</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa hoa -->
    <div class="modal fade" id="editFlowerModal" tabindex="-1" aria-labelledby="editFlowerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFlowerModalLabel">Sửa hoa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="editIndex" id="editIndex">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Tên hoa</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Khi click vào nút sửa, điền thông tin hoa vào form sửa
        document.querySelectorAll('[data-bs-target="#editFlowerModal"]').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                const index = this.getAttribute('data-index');

                document.getElementById('editName').value = name;
                document.getElementById('editDescription').value = description;
                document.getElementById('editIndex').value = index;
            });
        });
    </script>
</body>

</html>