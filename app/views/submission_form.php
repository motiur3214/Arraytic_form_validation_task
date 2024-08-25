<?php include_once '../config/constant.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Form</title>
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style_form.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style_navbar.css">
    <script src="<?php echo BASE_PATH; ?>js/jquery.min.js"></script>
    <script src="<?php echo BASE_PATH; ?>js/validation.js"></script>
</head>
<body>
<?php include_once '../includes/navbar.php'; ?>
<h1>Submission Form</h1>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Clear the message after displaying
}
?>
<form id="submissionForm" action="<?php echo BASE_PATH; ?>submit" method="POST">
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount" required>

    <label for="buyer">Buyer:</label>
    <input type="text" id="buyer" name="buyer" required>

    <label for="receipt_id">Receipt ID:</label>
    <input type="text" id="receipt_id" name="receipt_id" required>

    <label for="items">Items:</label>
    <input type="text" id="items" name="items" required>
    <button type="button" id="addItem">Add Item</button>

    <label for="buyer_email">Buyer Email:</label>
    <input type="email" id="buyer_email" name="buyer_email" required>

    <label for="note">Note:</label>
    <textarea id="note" name="note" required></textarea>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="entry_by">Entry By:</label>
    <input type="text" id="entry_by" name="entry_by" required>

    <button type="submit">Submit</button>
</form>

<script>
    // Automatically prepend "880" to phone number
    $('#phone').on('input', function () {
        let value = $(this).val();
        if (!value.startsWith('880')) {
            $(this).val('880' + value);
        }
    });

    // Add items dynamically
    $('#addItem').on('click', function () {
        let newItem = prompt("Enter the item:");
        if (newItem) {
            let currentItems = $('#items').val();
            if (currentItems) {
                $('#items').val(currentItems + ', ' + newItem);
            } else {
                $('#items').val(newItem);
            }
        }
    });
</script>
</body>
</html>