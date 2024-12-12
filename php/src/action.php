<?php
session_start();
ob_start();
include 'config.php';
include 'style/sweetalert.php';

$update = false;
$id = "";
$name = "";
$part = "";
$song = "";
$score1 = "";
$score2 = "";
$active = "";


if (isset($_POST['add'])) {
	$name = $_POST['name'];
	$part = $_POST['part'];
	$song = $_POST['song'];
	$score1 = 0;
	$score2 = 0;
	$active = 0;

	$query = "INSERT INTO singer(name,part,song,score1,score2,active)VALUES(?,?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssiii", $name, $part, $song, $score1, $score2, $active);
	$stmt->execute();

	echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'ເພີ່ມຂໍ້​ມູນເຂົ້າລະບົບສຳເລັດແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=singer");
}
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$query = "DELETE FROM singer WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();

	if ($stmt) {

		header("refresh:1; url=singer");
	}
}

if (isset($_POST['update'])) {

	$id = $_POST['id'];
	$name = $_POST['name'];
	$part = $_POST['part'];
	$song = $_POST['song'];

	$query = "UPDATE singer SET name=?,part=?,song=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssi", $name, $part, $song, $id);
	$stmt->execute();

	echo "<script>
				$(document).ready(function() {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'ອັບເດດຂໍ້ມູນສຳເລັດແລ້ວ',
						showConfirmButton: false,
						timer: 3000
					  });
				});
			</script>";

	header("refresh:3; url=singer");
}

if (isset($_GET['updateactive'])) {
	$id = $_GET['updateactive'];
	$active = $_GET['active'];

	$query = "UPDATE singer SET active=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("si", $active, $id);
	$stmt->execute();

	echo "<script>
				$(document).ready(function() {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'ປ່ຽນ​ສະ​ຖາ​ນະ​ສ​ຳ​ເລັດ',
						showConfirmButton: false,
						timer: 2000
					  });
				});
			</script>";

	header("refresh:2; url=singer");
}

if (isset($_POST['addscore1'])) {
	$id = $_POST['id'];

	$result = $conn->query("SELECT id FROM singer WHERE id = '$id' and active = 1");
	$row_cnt = $result->num_rows;

	if ($row_cnt > 0) {

		$sql1 = "SELECT score1 FROM singer WHERE id = '$id'";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$scores1 = $row1['score1'];

		$newscores1 = $scores1 + 1;

		$query = "UPDATE singer SET score1=? WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $newscores1, $id);
		$stmt->execute();

		if ($stmt) {
			$_SESSION['message'] = "ເພີ່ມຄະ​ແນນ​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "success"; // To track message type
		} else {
			$_SESSION['message'] = "ເພີ່ມຄະ​ແນນ​ບໍ່​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "error"; // To track message type
		}
		header("Location: index");
		exit();
	} else {

		echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'info',
					title: 'ນັກ​ຮ້ອງ​ທ່ານ​ນີ້​ ໄດ້​ຖືກ​ປິດ​ລົງ​ຄະ​ແນນ​ແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=index");
	}
}

if (isset($_POST['minusscore1'])) {
	$id = $_POST['id'];

	$result = $conn->query("SELECT id FROM singer WHERE id = '$id' and active = 1");
	$row_cnt = $result->num_rows;

	if ($row_cnt > 0) {

		$sql1 = "SELECT score1 FROM singer WHERE id = '$id'";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$scores1 = $row1['score1'];

		$newscores1 = $scores1 - 1;

		$query = "UPDATE singer SET score1=? WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $newscores1, $id);
		$stmt->execute();

		if ($stmt) {
			$_SESSION['message'] = "ລົບຄະ​ແນນ​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "success"; // To track message type
		} else {
			$_SESSION['message'] = "ລົບຄະ​ແນນ​ບໍ່​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "error"; // To track message type
		}
		header("Location: index");
		exit();
	} else {

		echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'info',
					title: 'ນັກ​ຮ້ອງ​ທ່ານ​ນີ້​ ໄດ້​ຖືກ​ປິດ​ລົງ​ຄະ​ແນນ​ແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=index");
	}
}

if (isset($_POST['addscore2'])) {
	$id = $_POST['id'];

	$result = $conn->query("SELECT id FROM singer WHERE id = '$id' and active = 1");
	$row_cnt = $result->num_rows;

	if ($row_cnt > 0) {

		$sql1 = "SELECT score2 FROM singer WHERE id = '$id'";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$scores2 = $row1['score2'];

		$newscores2 = $scores2 + 1;

		$query = "UPDATE singer SET score2=? WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $newscores2, $id);
		$stmt->execute();

		if ($stmt) {
			$_SESSION['message'] = "ເພີ່ມຄະ​ແນນ​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "success"; // To track message type
		} else {
			$_SESSION['message'] = "ເພີ່ມຄະ​ແນນ​ບໍ່​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "error"; // To track message type
		}
		header("Location: index");
		exit();
	} else {

		echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'info',
					title: 'ນັກ​ຮ້ອງ​ທ່ານ​ນີ້​ ໄດ້​ຖືກ​ປິດ​ລົງ​ຄະ​ແນນ​ແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=index");
	}
}

if (isset($_POST['minusscore2'])) {
	$id = $_POST['id'];

	$result = $conn->query("SELECT id FROM singer WHERE id = '$id' and active = 1");
	$row_cnt = $result->num_rows;

	if ($row_cnt > 0) {

		$sql1 = "SELECT score2 FROM singer WHERE id = '$id'";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$scores2 = $row1['score2'];

		$newscores2 = $scores2 - 1;

		$query = "UPDATE singer SET score2=? WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $newscores2, $id);
		$stmt->execute();

		if ($stmt) {
			$_SESSION['message'] = "ລົບຄະ​ແນນ​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "success"; // To track message type
		} else {
			$_SESSION['message'] = "ລົບຄະ​ແນນ​ບໍ່​ສຳ​ເລັດ";
			$_SESSION['message_type'] = "error"; // To track message type
		}
		header("Location: index");
		exit();
	} else {

		echo "<script>
			$(document).ready(function() {
				Swal.fire({
					position: 'center',
					icon: 'info',
					title: 'ນັກ​ຮ້ອງ​ທ່ານ​ນີ້​ ໄດ້​ຖືກ​ປິດ​ລົງ​ຄະ​ແນນ​ແລ້ວ',
					showConfirmButton: false,
					timer: 3000
				  });
			});
		</script>";

	header("refresh:3; url=index");
	}
}
ob_end_flush();
