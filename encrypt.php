<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    $encryptedDir = 'encrypted/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }
    if (!is_dir($encryptedDir)) {
        mkdir($encryptedDir);
    }

    $file = $_FILES['file'];
    $originalPath = $uploadDir . basename($file['name']);
    $encryptedPath = $encryptedDir . basename($file['name']) . '.enc';

    // Move uploaded file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $originalPath)) {
        // Encrypt the file
        $key = 7; // Simple XOR key
        $data = file_get_contents($originalPath);
        $encryptedData = '';
        for ($i = 0; $i < strlen($data); $i++) {
            $encryptedData .= chr(ord($data[$i]) ^ $key);
        }

        file_put_contents($encryptedPath, $encryptedData);

        // Return JSON response
        echo json_encode([
            'success' => true,
            'filePath' => $encryptedPath,
            'fileName' => basename($encryptedPath),
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
