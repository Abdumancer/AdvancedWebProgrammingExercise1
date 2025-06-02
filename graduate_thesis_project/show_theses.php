<?php
<?php
require_once 'GraduateThesis.php';

$thesis = new GraduateThesis();
$theses = $thesis->read();

echo "<h2>Graduate Theses Listesi</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Başlık</th>
        <th>Açıklama</th>
        <th>Bağlantı</th>
        <th>Identification Number</th>
      </tr>";

foreach ($theses as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['work_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['work_text']) . "</td>";
    echo "<td><a href='" . htmlspecialchars($row['work_link']) . "' target='_blank'>Link</a></td>";
    echo "<td>" . htmlspecialchars($row['identification_number']) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>