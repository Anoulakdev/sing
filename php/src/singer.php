<?php include 'action.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ນັກ​ຮ້ອງ</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Berry is made using Bootstrap 5 design framework. Download the free admin template & use it for your project." />
    <meta name="keywords" content="Berry, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template" />
    <meta name="author" content="CodedThemes" />

    <?php include 'style/stylesheet.php'; ?>

    <style>
        .scrollable-table {
            width: 100%;
            overflow-x: auto;
        }

        .scrollable-table table {
            width: 100%;
            white-space: nowrap;
        }
    </style>

</head>


<body>

    <?php include 'navbar/navbar.php'; ?>

    <?php include 'sidebar/sidebar.php'; ?>


    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <h2 class="mt-2 mb-4"><b>ນັກ​ຮ້ອງ</b></h2>


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="modal fade" id="addModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">ເພີ່ມນັກ​ຮ້ອງ</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="row g-3" action="action" method="post">

                                                <div class="col-md-12">
                                                    <label for="name" class="form-label">ຊື່ນັກ​ຮ້ອງ</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="part" class="form-label">​ມາ​ຈາກ​ພາກ​ສ່ວນ</label>
                                                    <input type="text" name="part" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="song" class="form-label">ຊື່​ເພງ</label>
                                                    <input type="text" name="song" class="form-control" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                                    <button type="submit" name="add" class="btn btn-primary">ເພີ່ມ​ຂໍ້​ມູນ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                ເພີ່ມນັກ​ຮ້ອງ
                            </button>
                            <!-- Default Table -->

                            <?php
                            $query = "SELECT * FROM singer";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                            }
                            ?>

                            <div class="scrollable-table mt-3">
                                <table class="table table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th>ລ/ດ</th>
                                            <th>ສະ​ຖາ​ນະ</th>
                                            <th>ຊ​ື່​ນັ​ກ​ຮ້ອງ</th>
                                            <th>​ມາ​ຈາກ​ພາກ​ສ່ວນ</th>
                                            <th>ຊື່​ເພງ</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>

                                                <td>
                                                    <?php if ($row['active'] == 1) { ?>
                                                        <a href="action?updateactive=<?= $row['id']; ?>&active=0" type="button" class="btn btn-success">ເປີດ</a>
                                                    <?php } else { ?>
                                                        <a href="action?updateactive=<?= $row['id']; ?>&active=1" type="button" class="btn btn-danger">ປິດ</a>
                                                    <?php } ?>

                                                </td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= $row['part']; ?></td>
                                                <td><?= $row['song']; ?></td>
                                                <td>
                                                    <a href="#edit_<?= $row['id']; ?>" type="button" class="btn btn-primary" data-bs-toggle="modal"><i class="ti ti-edit"></i></a>
                                                    <a data-id="<?= $row['id']; ?>" href="action?delete=<?= $row['id']; ?>" type="button" class="btn btn-danger delete-btn"><i class="ti ti-trash"></i></a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="edit_<?= $row['id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">ແກ້​ໄຂນັກ​ຮ້ອງ</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" action="action" method="post">
                                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="name" class="form-label">ຊື່ນັກ​ຮ້ອງ</label>
                                                                    <input type="text" name="name" value="<?= $row['name']; ?>" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="part" class="form-label">​ມາ​ຈາກ​ພາກ​ສ່ວນ</label>
                                                                    <input type="text" name="part" value="<?= $row['part']; ?>" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="song" class="form-label">ຊື່​ເພງ</label>
                                                                    <input type="text" name="song" value="<?= $row['song']; ?>" class="form-control" required>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                                                    <button type="submit" name="update" class="btn btn-success">ອັບ​ເດດ​ຂໍ້​ມູນ</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </tbody>
                                </table>
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
        $(function() {
            $("#example").DataTable({
                "oLanguage": {
                    "sProcessing": "ກຳລັງດຳເນີນການ...",
                    "sLengthMenu": "ສະແດງ _MENU_ ແຖວ",
                    "sZeroRecords": "ບໍ່ມີຂໍ້ມູນຄົ້ນຫາ",
                    "sInfo": "ສະແດງ _START_ ຖີງ _END_ ຈາກ _TOTAL_ ແຖວ",
                    "sInfoEmpty": "ສະແດງ 0 ຖີງ 0 ຈາກ 0 ແຖວ",
                    "sInfoFiltered": "(ຈາກຂໍ້ມູນທັງໝົດ _MAX_ ແຖວ)",
                    "sSearch": "ຄົ້ນຫາ :",
                    "oPaginate": {
                        "sFirst": "ເລີ່ມຕົ້ນ",
                        "sPrevious": "ກັບຄືນ",
                        "sNext": "ຕໍ່ໄປ",
                        "sLast": "ສຸດທ້າຍ"
                    }
                },

            })

        });

        $(".delete-btn").click(function(e) {
            let userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'ຕ້ອງການຈະລົບຂໍ້ມູນອອກບໍ່?',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ຕົກລົງ',
                cancelButtonText: 'ຍົກເລີກ',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'action',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'ລົບຂໍ້ມູນສຳເລັດແລ້ວ',

                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'singer';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>

</body>

</html>