<?php

class Submission
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save($amount, $buyer, $receipt_id, $items, $buyer_email, $buyer_ip, $note, $city, $phone, $hash_key, $entry_at, $entry_by)
    {
        $stmt = $this->db->prepare("
            INSERT INTO submissions (amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, hash_key, entry_at, entry_by)
            VALUES (:amount, :buyer, :receipt_id, :items, :buyer_email, :buyer_ip, :note, :city, :phone, :hash_key, :entry_at, :entry_by)
        ");
       return $stmt->execute([
            ':amount' => $amount,
            ':buyer' => $buyer,
            ':receipt_id' => $receipt_id,
            ':items' => $items,
            ':buyer_email' => $buyer_email,
            ':buyer_ip' => $buyer_ip,
            ':note' => $note,
            ':city' => $city,
            ':phone' => $phone,
            ':hash_key' => $hash_key,
            ':entry_at' => $entry_at,
            ':entry_by' => $entry_by,
        ]);
    }

    public function getSubmissions($start_date = null, $end_date = null, $entry_by = null)
    {
        $query = "SELECT * FROM submissions";
        $conditions = [];

        if (!empty($start_date)) {
            $conditions[] = "entry_at >= :start_date";
        }

        if (!empty($end_date)) {
            $conditions[] = "entry_at <= :end_date";
        }

        if (!empty($entry_by)) {
            $conditions[] = "entry_by = :entry_by";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($query);

        if (!empty($start_date)) {
            $stmt->bindParam(':start_date', $start_date);
        }

        if (!empty($end_date)) {
            $stmt->bindParam(':end_date', $end_date);
        }

        if (!empty($entry_by)) {
            $stmt->bindParam(':entry_by', $entry_by);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}