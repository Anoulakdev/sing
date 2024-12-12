<?php include 'action.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ຜົນ​ຄະ​ແນນ</title>
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

    <?php include 'navbar/navbar.php'; ?>

    <?php include 'sidebar/sidebar.php'; ?>


    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <h2 class="mb-3"><b>ຜົນ​ຄະ​ແນນ</b></h2>


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div id="table">
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

    <script type="text/javascript">
        function table() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("table").innerHTML = this.responseText;

            }
            xhttp.open("GET", "score_table");
            xhttp.send();
        }

        setInterval(function() {
            table();
        }, 1500);
    </script>

</body>

</html>