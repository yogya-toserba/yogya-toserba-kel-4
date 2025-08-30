<?php
// Simple test form to check database insertion
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database configuration
$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$database = $_ENV['DB_DATABASE'] ?? 'db_yogya';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

$message = '';
$messageType = '';

if ($_POST) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("
            INSERT INTO karyawan (nama, divisi, alamat, email, tanggal_lahir, nomer_telepon, id_shift, created_at, updated_at) 
            VALUES (:nama, :divisi, :alamat, :email, :tanggal_lahir, :nomer_telepon, :id_shift, NOW(), NOW())
        ");
        
        $data = [
            'nama' => $_POST['nama'],
            'divisi' => $_POST['divisi'],
            'alamat' => $_POST['alamat'],
            'email' => $_POST['email'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'nomer_telepon' => $_POST['nomer_telepon'],
            'id_shift' => $_POST['id_shift']
        ];
        
        $result = $stmt->execute($data);
        
        if ($result) {
            $lastId = $pdo->lastInsertId();
            $message = "Karyawan berhasil ditambahkan dengan ID: $lastId";
            $messageType = 'success';
        } else {
            $message = "Gagal menambahkan karyawan";
            $messageType = 'error';
        }
        
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
        $messageType = 'error';
    } catch (Exception $e) {
        $message = "General error: " . $e->getMessage();
        $messageType = 'error';
    }
}

// Get shift options
$shiftOptions = [];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id_shift, nama_shift FROM shift ORDER BY id_shift");
    $shiftOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Ignore errors, form will still work
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Karyawan Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 300px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        textarea { height: 80px; resize: vertical; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Test Karyawan Form</h1>
    
    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="divisi">Divisi:</label>
            <input type="text" id="divisi" name="divisi" required value="<?php echo htmlspecialchars($_POST['divisi'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($_POST['alamat'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="<?php echo htmlspecialchars($_POST['tanggal_lahir'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="nomer_telepon">Nomor Telepon:</label>
            <input type="text" id="nomer_telepon" name="nomer_telepon" required value="<?php echo htmlspecialchars($_POST['nomer_telepon'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="id_shift">Shift:</label>
            <select id="id_shift" name="id_shift" required>
                <option value="">-- Pilih Shift --</option>
                <?php foreach ($shiftOptions as $shift): ?>
                    <option value="<?php echo $shift['id_shift']; ?>" 
                            <?php echo (($_POST['id_shift'] ?? '') == $shift['id_shift']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($shift['nama_shift']); ?>
                    </option>
                <?php endforeach; ?>
                <?php if (empty($shiftOptions)): ?>
                    <option value="1">Pagi (Default)</option>
                    <option value="2">Siang (Default)</option>
                    <option value="3">Malam (Default)</option>
                <?php endif; ?>
            </select>
        </div>
        
        <button type="submit">Tambah Karyawan</button>
    </form>
    
    <hr>
    <h2>Current Data in Database</h2>
    <?php
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query("SELECT * FROM karyawan ORDER BY id_karyawan DESC LIMIT 10");
        $karyawans = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($karyawans) {
            echo "<table border='1' cellpadding='8' cellspacing='0'>";
            echo "<tr><th>ID</th><th>Nama</th><th>Divisi</th><th>Email</th><th>Tanggal Lahir</th><th>Telepon</th><th>Shift ID</th></tr>";
            foreach ($karyawans as $karyawan) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($karyawan['id_karyawan']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['divisi']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['email']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['tanggal_lahir']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['nomer_telepon']) . "</td>";
                echo "<td>" . htmlspecialchars($karyawan['id_shift']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data found in karyawan table.</p>";
        }
    } catch (Exception $e) {
        echo "<p>Error fetching data: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
</body>
</html>
