<?php
session_start();

require_once __DIR__ . '/../vendors/autoload.php';

$billData = [
    'company_name' => 'ABC Electronics',               // The name of the company issuing the receipt
    'company_address' => '1234 Market Street, Cityville', // Company address
    'customer_name' => 'John Doe',                      // Name of the customer
    'customer_address' => '5678 Elm St, Townsville',    // Customer's address
    'date' => date('F d, Y'),                           // Current date (formatted)
    'invoice_number' => 'INV-1001',                     // Unique invoice number
    'items' => [                                        // List of purchased items with quantity and price
        ['item_name' => 'Laptop', 'quantity' => 1, 'price' => 1000.00],
        ['item_name' => 'Mouse', 'quantity' => 2, 'price' => 20.00],
        ['item_name' => 'Keyboard', 'quantity' => 1, 'price' => 50.00],
    ],
    'tax' => 50.00,                                     // Tax amount
    'discount' => 20.00,                                // Discount
    'total' => 1110.00                                  // Final total after tax and discount
];

// Generate the HTML structure for the receipt
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic styling for the receipt */
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; }
        .bill-details, .customer-details, .items { margin: 20px 0; }
        .items table { width: 100%; border-collapse: collapse; }
        .items table, .items th, .items td { border: 1px solid black; }
        .items th, .items td { padding: 10px; text-align: left; }
        .summary { margin-top: 20px; text-align: right; }
    </style>
    <title>Bill Receipt</title>
</head>
<body>

    <!-- Company Information -->
    <div class="header">
        <h1>' . $billData['company_name'] . '</h1>
        <p>' . $billData['company_address'] . '</p>
    </div>

    <!-- Invoice and Date Information -->
    <div class="bill-details">
        <p><strong>Date:</strong> ' . $billData['date'] . '</p>
        <p><strong>Invoice Number:</strong> ' . $billData['invoice_number'] . '</p>
    </div>

    <!-- Customer Information -->
    <div class="customer-details">
        <p><strong>Customer Name:</strong> ' . $billData['customer_name'] . '</p>
        <p><strong>Customer Address:</strong> ' . $billData['customer_address'] . '</p>
    </div>

    <!-- Itemized List of Purchased Products -->
    <div class="items">
        <h3>Items Purchased:</h3>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price (USD)</th>
                    <th>Total (USD)</th>
                </tr>
            </thead>
            <tbody>';

// Loop through each item and display it in the table
foreach ($billData['items'] as $item) {
    $totalPrice = $item['quantity'] * $item['price']; // Calculate total price for each item
    $html .= '
                <tr>
                    <td>' . $item['item_name'] . '</td>
                    <td>' . $item['quantity'] . '</td>
                    <td>$' . number_format($item['price'], 2) . '</td>
                    <td>$' . number_format($totalPrice, 2) . '</td>
                </tr>';
}

// Close the HTML for items table and create a summary for tax, discount, and total
$html .= '
            </tbody>
        </table>
    </div>

    <!-- Summary Section -->
    <div class="summary">
        <p><strong>Tax:</strong> $' . number_format($billData['tax'], 2) . '</p>
        <p><strong>Discount:</strong> -$' . number_format($billData['discount'], 2) . '</p>
        <p><strong>Total Amount:</strong> $' . number_format($billData['total'], 2) . '</p>
    </div>

</body>
</html>';

// Create an instance of mPDF (used to generate PDF files)
$mpdf = new \Mpdf\Mpdf();

// Pass the generated HTML into the PDF
$mpdf->WriteHTML($html);

// Output the PDF (this will trigger the download of the receipt)
$mpdf->Output('bill_receipt.pdf', 'I'); // 'D' forces download, 'I' would display in browser
?>
