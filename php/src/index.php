<?php include 'action.php'; ?>

<?php
$query = "SELECT * FROM singer WHERE active = 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ໃຫ້​ຄະ​ແນນ​ນັກ​ຮ້ອງ</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Berry is made using Bootstrap 5 design framework. Download the free admin template & use it for your project." />
    <meta name="keywords" content="Berry, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template" />
    <meta name="author" content="CodedThemes" />

    <?php include 'style/stylesheet.php'; ?>

</head>


<body>

    <?php include 'navbar/navbar_i.php'; ?>

    <?php include 'sidebar/sidebar.php'; ?>


    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="mx-0 mx-sm-auto">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h2 class="card-title text-white mt-2" id="exampleModalLabel">ໃຫ້​ຄະ​ແນນ​ນັກ​ຮ້ອງ</h2>
                                    </div>
                                    <div class="modal-body">

                                        <?php foreach ($data as $row) { ?>
                                            <form action="action" method="post">
                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                                <div class="mb-4 mt-4">
                                                    <h3 class="text-start"><b>ລຳ​ດັບ​ທີ່: </b><?= $row['no']; ?></h3>
                                                </div>

                                                <div class="mb-4 mt-4">
                                                    <h3 class="text-start"><b>ຊື່ນັກ​ຮ້ອງ: </b><?= $row['name']; ?></h3>
                                                </div>
                                                <div class="mb-4">
                                                    <h3 class="text-start"><b>ມາ​ຈາກ​ພາກ​ສ່ວນ: </b><?= $row['part']; ?></h3>
                                                </div>
                                                <div class="mb-4">
                                                    <h3 class="text-start"><b>ຊື່​ເພງ: </b><?= $row['song']; ?></h3>
                                                </div>
                                                <hr>

                                                <div>
                                                    <h3><b>ສຽງ​ດີ: </b></h3>
                                                </div>
                                                <div class="d-flex justify-content-start mb-4">
                                                    <div>
                                                        <button type="submit" name="addscore1" class="btn btn-success me-3">ກົດ​ໃຫ້​ຄະ​ແນນ</button>
                                                    </div>
                                                    <div>
                                                        <button type="submit" name="minusscore1" class="btn btn-danger">ກົດ​ລົບ​ຄະ​ແນນ</button>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h3><b>ການ​ສະ​ແດງ: </b></h3>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <div>
                                                        <button type="submit" name="addscore2" class="btn btn-success me-3">ກົດ​ໃຫ້​ຄະ​ແນນ</button>
                                                    </div>
                                                    <div>
                                                        <button type="submit" name="minusscore2" class="btn btn-danger">ກົດ​ລົບ​ຄະ​ແນນ</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <?php include 'footer/footer.php'; ?>

    <?php include 'style/script.php'; ?>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            <?php if (isset($_SESSION['message'])): ?>
                var messageType = '<?= $_SESSION['message_type']; ?>'; // Get the message type
                var message = '<?= $_SESSION['message']; ?>'; // Get the message

                // Show Toastr notification based on message type
                if (messageType === 'success') {
                    toastr.success(message, 'Success!', {
                        timeOut: 1000
                    });
                } else if (messageType === 'error') {
                    toastr.error(message, 'Error!', {
                        timeOut: 1000
                    });
                }

                // Unset session variables to avoid repeated alerts
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            <?php endif; ?>
        });
    </script>


</body>

</html>