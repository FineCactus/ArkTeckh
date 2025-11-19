<?php
// export_paymentreport.php -- simplified version
include '../dboperation.php';

$db = new dboperation();
$month = $_GET['month'] ?? '';
$plan  = $_GET['plan']  ?? '';

$conds = ["s.status = 'Paid'"];
if ($month !== '') {
    $m = $db->conn->real_escape_string($month);
    $conds[] = "DATE_FORMAT(s.regdate, '%Y-%m') = '$m'";
}
if ($plan !== '') {
    $p = intval($plan);
    $conds[] = "s.plan_id = $p";
}

$where = 'WHERE ' . implode(' AND ', $conds);

$sql = "SELECT
    s.payid, a.arch_name, a.email, a.phone, a.arch_locations,
    p.plan_name, s.amount, s.regdate, s.renewaldate, s.status
    FROM tbl_subscriptionplan s
    JOIN tbl_architects a ON s.architect_id = a.architect_id
    JOIN tbl_plan p ON s.plan_id = p.plan_id
    $where
    ORDER BY s.regdate DESC";

$res = $db->executequery($sql);

$filename = 'payment_report_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
echo "\xEF\xBB\xBF"; // UTF-8 BOM for Excel

$out = fopen('php://output', 'w');
fputcsv($out, ['Payment ID','Architect Name','Email','Phone','Location','Plan Type','Amount','Payment Date','Renewal Date','Status']);

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $payid = '#' . str_pad($row['payid'], 4, '0', STR_PAD_LEFT);
        $reg   = date('Y-m-d H:i:s', strtotime($row['regdate']));
        $renew = $row['renewaldate'] ? date('Y-m-d', strtotime($row['renewaldate'])) : '';
        fputcsv($out, [$payid, $row['arch_name'], $row['email'], $row['phone'], $row['arch_locations'], $row['plan_name'], $row['amount'], $reg, $renew, $row['status']]);
    }
}

fclose($out);
exit;

?>
