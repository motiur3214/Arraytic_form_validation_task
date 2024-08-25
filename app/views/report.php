<?php include_once '../config/constant.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Report</title>
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style_report.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style_navbar.css">
    <script src="<?php echo BASE_PATH; ?>js/jquery.min.js"></script>
</head>
<body>
<?php include_once '../includes/navbar.php'; ?>
<h1>Submission Report</h1>

<form id="filterForm" action="<?php echo BASE_PATH; ?>report" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $_GET['start_date'] ?? ''; ?>">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $_GET['end_date'] ?? ''; ?>">

    <label for="entry_by">User ID:</label>
    <input type="text" id="entry_by" name="entry_by" value="<?php echo $_GET['entry_by'] ?? ''; ?>">
    <button type="submit">Filter</button>
</form>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Amount</th>
        <th>Buyer</th>
        <th>Receipt ID</th>
        <th>Items</th>
        <th>Buyer Email</th>
        <th>Buyer IP</th>
        <th>Note</th>
        <th>City</th>
        <th>Phone</th>
        <th>Hash Key</th>
        <th>Entry At</th>
        <th>Entry By</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($submissions as $submission): ?>
        <tr>
            <td><?php echo $submission['id']; ?></td>
            <td><?php echo $submission['amount']; ?></td>
            <td><?php echo $submission['buyer']; ?></td>
            <td><?php echo $submission['receipt_id']; ?></td>
            <td><?php echo $submission['items']; ?></td>
            <td><?php echo $submission['buyer_email']; ?></td>
            <td><?php echo $submission['buyer_ip']; ?></td>
            <td><?php echo $submission['note']; ?></td>
            <td><?php echo $submission['city']; ?></td>
            <td><?php echo $submission['phone']; ?></td>
            <td class="limit-hash" title="<?php echo $submission['hash_key']; ?>">
                <?php echo substr($submission['hash_key'], 0, 10); ?>
            </td>
            <td><?php echo $submission['entry_at']; ?></td>
            <td><?php echo $submission['entry_by']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>