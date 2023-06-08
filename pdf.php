<?php
require_once "vendor/autoload.php";
require_once "db.php";
use Dompdf\Dompdf;

$mysqli = new mysqli("localhost", "myo","yngWIE500","kbtc_test");
$query = "SELECT * FROM customer;";
$result = mysqli_query($mysqli, $query);

$html = '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h2  {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }
        table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse
        }
        td, th{
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .my-table {
            text-align: right;
        }
        #sign {
            padding-top:50px;
            text-align: right;

        }
    </style>
</head>
<body>
    <h2>Employee Salaries</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Employee Salary</th>
            </tr>
        </thead>
        <tbody>';

$total = null;
while ($row = mysqli_fetch_object($result)) {
    $html .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->name.'</td>
                <td>'.number_format($row->salary, 2).'</td>
            </tr>';
    $total += $row->salary;
}

$html .= '</tbody>
        <tr>
            <th colspan="2" class="my-table">Grand Total</th>
            <th colspan="2" class="my-table">'.number_format($total, 2).'</th>
        </tr>
        <tr>
            <th colspan="3" class="my-table " id="sign">Signature</th>
        </tr>
    </table>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$options = $dompdf->getOptions();
$options->setDefaultFont('Courier');
$dompdf->setPaper("A4", 'portrait');
$dompdf->setOptions($options);
$dompdf->render();
$dompdf->stream('salaries.pdf');


