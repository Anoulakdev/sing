<?php
include 'config.php';
$query = "SELECT *, score1 + score2 as totals From singer order by totals DESC, id ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>
<table class="table table-bordered" id="table">
    <thead>
        <tr class="text-center align-middle" style="height: 80px;">
            <th class="fs-2">ລ/ດ</th>
            <th class="fs-2">ຊ​ື່​ນັ​ກ​ຮ້ອງ</th>
            <th class="fs-2">ມາ​ຈາກ​ພາກ​ສ່ວນ</th>
            <th class="fs-2">​ຄະ​ແນນສຽງ​ດີ</th>
            <th class="fs-2">​ຄະ​ແນນການ​ສະ​ແດງ</th>
            <th class="fs-2">ລວມ</th>
        </tr>
    </thead>
    <tbody class="align-middle">
        <?php $i = 1; ?>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td class="text-center fs-3"><?= $i++; ?></td>
                <td class="fs-3"><?= $row['name']; ?></td>
                <td class="fs-3 text-center"><?= $row['part']; ?></td>
                <td class="fs-3 text-center"><?= $row['score1']; ?></td>
                <td class="fs-3 text-center"><?= $row['score2']; ?></td>
                <td class="fs-3 text-center"><?= $row['totals']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <?php
        $query1 = "SELECT sum(score1) as s1, sum(score2) as s2, sum(score1) + sum(score2) as alltotals FROM singer";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        ?>
        <?php while ($row1 = $result1->fetch_assoc()) { ?>
            <tr class="text-center align-middle" style="height: 80px;">
                <th colspan="3" class="fs-2">ລວມ​ຄະ​ແນນ​ທັງ​ໝົດ</th>

                <td class="text-center fs-2 fw-bold"><?= $row1['s1']; ?></td>
                <td class="text-center fs-2 fw-bold"><?= $row1['s2']; ?></td>
                <td class="text-center fs-2 fw-bold"><?= $row1['alltotals']; ?></td>
            </tr>
        <?php } ?>
    </tfoot>
</table>