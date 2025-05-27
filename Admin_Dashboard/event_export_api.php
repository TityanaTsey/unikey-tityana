
<?php
// export_event_students.php

session_start();
include "../Connect.php";

$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
if ($event_id < 1) exit('Invalid event_id');

// Fetch students
$stmt = $con->prepare("
 SELECT
  s.id,
  s.fname,
  s.lname,
  s.department_id,
  d.name AS department_name
FROM students AS s
JOIN student_events AS er
  ON er.student_id = s.id
LEFT JOIN departments AS d
  ON s.department_id = d.id
WHERE er.event_id = ?
ORDER BY s.lname, s.fname;
");
$stmt->bind_param('i',$event_id);
$stmt->execute();
$res = $stmt->get_result();

// Send headers for an .xls download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"event_{$event_id}_students.xls\"");
echo "<table border='1'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Department Name</th></tr>\n";

// Output rows
while ($row = $res->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['department_name']}</td></tr>\n";
}

echo "</table>";
exit;

// // 1) Bootstrap & DB connection
// session_start();
// include "../Connect.php";  // adjust path as needed

// // 2) Get and validate event_id
// $event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
// if ($event_id <= 0) {
//     die("Invalid or missing event_id");
// }

// // 3) Query students registered for this event
// $sql = "
//     SELECT s.fname, s.lname
//     FROM students s
//     JOIN student_events er
//       ON er.student_id = s.id
//     WHERE er.event_id = ?
//     ORDER BY s.lname, s.fname
// ";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("i", $event_id);
// $stmt->execute();
// $result = $stmt->get_result();

// // 4) Send HTTP headers to force download as Excel file
// $filename = "event_{$event_id}_students.xls";
// header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
// header("Content-Disposition: attachment; filename=\"{$filename}\"");
// header("Pragma: no-cache");
// header("Expires: 0");

// // Optional: UTF-8 BOM so Excel opens with correct encoding
// echo "\xEF\xBB\xBF";

// // 5) Output column headers
// echo "First Name\tLast Name\n";

// // 6) Output each row as tab-delimited
// while ($row = $result->fetch_assoc()) {
//     // Escape tabs/newlines just in case
//     $fname = str_replace(["\t","\n","\r"], ' ', $row['fname']);
//     $lname = str_replace(["\t","\n","\r"], ' ', $row['lname']);
//     echo "{$fname}\t{$lname}\n";
// }

// $stmt->close();
// exit;
