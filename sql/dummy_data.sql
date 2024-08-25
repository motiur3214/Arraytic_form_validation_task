USE
`db_arraytics`;

INSERT INTO `submissions` (`amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`,
                           `hash_key`, `entry_at`, `entry_by`)
VALUES (100, 'John Doe', 'REC1234567890', 'Item1, Item2', 'john@example.com', '192.168.1.1', 'This is a test note',
        'New York', '8801234567890', SHA2(CONCAT('REC1234567890', 'salt'), 512), CURDATE(), 1),
       (200, 'Jane Smith', 'REC0987654321', 'Item3, Item4', 'jane@example.com', '192.168.1.2', 'Another test note',
        'Los Angeles', '8809876543210', SHA2(CONCAT('REC0987654321', 'salt'), 512), CURDATE(), 2);