<?php

use JetBrains\PhpStorm\NoReturn;

require_once '../app/models/Submission.php';

class SubmissionController
{
    private Submission $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function index($flag = null): void
    {
        include '../app/views/submission_form.php';
    }

   public function submit(): void
    {
        session_start(); // Start the session to use session variables

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Backend validation
            $amount = filter_var($_POST['amount'], FILTER_VALIDATE_INT);
            $buyer = preg_match("/^[\w\s]{1,20}$/", $_POST['buyer']) ? $_POST['buyer'] : null;
            $receipt_id = $_POST['receipt_id'];
            $items = $_POST['items'];
            $buyer_email = filter_var($_POST['buyer_email'], FILTER_VALIDATE_EMAIL);
            $note = $_POST['note'];
            $city = preg_match("/^[a-zA-Z\s]+$/", $_POST['city']) ? $_POST['city'] : null;

            // Phone number validation
            $phone = $_POST['phone'];
            // Remove non-numeric characters
            $phone = preg_replace('/\D/', '', $phone);
            // Prepend '880' if not present
            if (!str_starts_with($phone, '880')) {
                $phone = '880' . $phone;
            }

            $entry_by = filter_var($_POST['entry_by'], FILTER_VALIDATE_INT);
            $buyer_ip = $this->getUserIpAddr();
            $hash_key = hash('sha512', $receipt_id . 'salt');
            $entry_at = date('Y-m-d');

            // Validation check for all required fields
            if ($amount && $buyer && $receipt_id && $items && $buyer_email && $note && $city && $phone && $entry_by) {
                $result= $this->submission->save($amount, $buyer, $receipt_id, $items, $buyer_email, $buyer_ip, $note, $city, $phone, $hash_key, $entry_at, $entry_by);
                if ($result) {
                    $_SESSION['message'] = 'Submission successful!';
                } else {
                    $_SESSION['message'] = 'Database error: Submission failed!';
                }
            } else {
                $_SESSION['message'] = 'Validation failed!';
            }
        }
        // Redirect to the form page
        header('Location: home/');
        exit();
    }


    public function report(): void
    {

        $start_date = $_GET['start_date'] ?? null;
        $end_date = $_GET['end_date'] ?? null;
        $entry_by = $_GET['entry_by'] ?? null;
        $submissions = $this->submission->getSubmissions($start_date, $end_date, $entry_by);

        include '../app/views/report.php';
    }

    private function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP from shared internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passed from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Convert IPv6 localhost to IPv4 localhost
        // As in localhost ::1 is the expected ip to return
        if ($ip == '::1') {
            $ip = '127.0.0.1';
        }

        return $ip;
    }


}