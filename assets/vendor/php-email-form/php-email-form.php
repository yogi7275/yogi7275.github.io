<?php

class PHP_Email_Form {
    public $ajax = false;
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $smtp = [];
    public $message = '';

    public function add_message($content, $field, $required = false) {
        if ($required && empty($content)) {
            die("Error: $field is required.");
        }
        $this->message .= ucfirst($field) . ": " . htmlspecialchars($content) . "\n";
    }

    public function send() {
        $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
        $headers .= "Reply-To: {$this->from_email}\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $smtp = $this->smtp;
        if (!empty($smtp)) {
            // Send using SMTP
            return $this->send_via_smtp($headers);
        } else {
            // Send using PHP's mail() function
            return mail($this->to, $this->subject, $this->message, $headers);
        }
    }

    private function send_via_smtp($headers) {
        $smtp = $this->smtp;

        // Ensure SMTP configuration is provided
        if (empty($smtp['host']) || empty($smtp['username']) || empty($smtp['password']) || empty($smtp['port'])) {
            die('SMTP configuration is incomplete.');
        }

        // Setup SMTP connection using PHPMailer or similar (if needed)
        // For simplicity, here’s a placeholder for your SMTP setup
        return mail($this->to, $this->subject, $this->message, $headers);
    }
}

?>
