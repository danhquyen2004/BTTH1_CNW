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
    <style>
        /* Make the container scrollable */
        .flower-list {
            max-height: 80vh;
            /* Adjust height as needed */
            overflow-y: auto;
            margin-bottom: 20px;
        }

        /* Set max size for the images */
        .card-img-top {
            max-width: 100%;
            /* Ensures image scales responsively */
            max-height: 400px;
            /* Adjust the max height for the images */
            object-fit: cover;
            /* Makes sure the image is cropped proportionally */
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Danh sách Hoa</h1>
        <div class="flower-list">
            <?php foreach ($flowers as $flower): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $flower['name']; ?></h5>
                        <p class="card-text"><?= $flower['description']; ?></p>
                    </div>
                    <img src="<?= $flower['image']; ?>" class="card-img-top" alt="<?= $flower['name']; ?>">

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>