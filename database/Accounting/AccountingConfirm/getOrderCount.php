<?php
include('../../dbConnection.php');

$transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
$salesperson = empty($_GET['salesperson']) ? '%' : $_GET['salesperson'];
$type = $_GET['type'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$fname = empty($_GET['fname']) ? '%' : $_GET['fname'];
$lname = empty($_GET['lname']) ? '%' : $_GET['lname'];
$wholesaler = empty($_GET['wholesaler']) ? '%' : $_GET['wholesaler'];
$from_invoice = empty($_GET['from_invoice']) ? '%' : $_GET['from_invoice'];
$to_invoice = empty($_GET['to_invoice']) ? '%' : $_GET['to_invoice'];
$invoice = empty($_GET['invoice']) ? '%' : $_GET['invoice'];
$locator = empty($_GET['locator']) ? '%' : $_GET['locator'];
$airline = empty($_GET['airline']) ? '%' : $_GET['airline'];
$payment_type = $_GET['payment_type'];
$lock_status = $_GET['lock_status'] == 'all' ? '%' : $_GET['lock_status'];
$clear_status = $_GET['clear_status'] == 'all' ? '%' : $_GET['clear_status'];
$paid_status = $_GET['paid_status'] == 'all' ? '%' : $_GET['paid_status'];
$finish_status = $_GET['finish_status'] == 'all' ? '%' : $_GET['finish_status'];
$sup = $_GET['sup'];
$ref = $_GET['ref'];


if ($payment_type == 'non-cc') {
  $deal_location = $_GET['deal_location'];
  $non_cc_payment_type_arr = json_decode($_GET['non_cc_payment_type']);
}

$sql = "SELECT
            count(*) AS num_orders, 
            sum(fs.total_profit) AS sum_profit, 
            sum(fs.debt_raw) AS sum_debt, 
            sum(fs.received_raw) AS sum_received, 
            'kimSH' AS sum_selling_price
        FROM FinanceStatus fs
        JOIN Transactions t ON fs.transaction_id = t.transaction_id
        JOIN AirticketTour a ON a.airticket_tour_id = t.airticket_tour_id
        JOIN Salesperson s ON a.salesperson_id = s.salesperson_id
        JOIN Wholesaler w ON a.wholesaler_id = w.wholesaler_id
        WHERE fs.transaction_id LIKE '$transaction_id'
        AND s.salesperson_code LIKE '$salesperson'
        AND t.settle_time >= '$from_date'
        AND t.settle_time <= '$to_date'
        AND w.wholesaler_code LIKE '$wholesaler'
        AND a.locators LIKE '$locator'
        AND fs.lock_status LIKE '$lock_status'
        AND fs.clear_status LIKE '$clear_status'
        AND fs.paid_status LIKE '$paid_status'
        AND fs.finish_status LIKE '$finish_status'
        AND t.transaction_id IN
            (SELECT DISTINCT t.transaction_id FROM Transactions t JOIN AirticketNumber an ON t.airticket_tour_id = an.airticket_tour_id WHERE an.lname LIKE concat('%', '$lname', '%') AND an.fname LIKE concat('%', '$fname', '%'))
        AND t.transaction_id IN
            (SELECT DISTINCT t.transaction_id FROM Transactions t JOIN Airschedule asl ON t.airticket_tour_id = asl.airticket_tour_id WHERE asl.airline LIKE '$airline')
        ";
if ($payment_type == 'cc'){
    $sql .= " AND fs.received = 'CC'";
} else if ($payment_type == 'mco') {
    $sql .= " AND fs.ending = 'mco'";
} else if ($payment_type == 'non-cc') {
    $sql .= " AND a.deal_location LIKE '$deal_location'";
    if (sizeof($non_cc_payment_type_arr) > 0) {
        $sql .= " AND a.payment_type IN (";
        for ($i = 0; $i < sizeof($non_cc_payment_type_arr); $i++) {
            $sql = $sql . "'" . $non_cc_payment_type_arr[$i] . "',";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
    }
}

if ($sup == 'Y') {
    $sql .= " AND fs.ending LIKE 'sup'";
} else if ($sup == 'N') {
    $sql .= " AND IFNULL(fs.ending, '') NOT LIKE 'sup'";
}
if ($ref =='Y') {
    $sql = " AND fs.ending LIKE 'ref'";
} else if ($ref == 'N') {
    $sql = " AND IFNULL(fs.ending, '') NOT LIKE 'ref'";
}

if ($invoice != '%') {
    $sql .= " AND fs.invoice LIKE '$invoice'";
} else if ($from_invoice != '%' or $to_invoice != '%') {
    $sql .= " AND (fs.invoice >= '$from_invoice' AND fs.invoice <= '$to_invoice')";
}

$result = $conn->query($sql);

$res = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $res = $row;
}

echo json_encode($res);

mysqli_close($conn);
 ?>
