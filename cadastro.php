<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $nome     = $_POST["Nome"] ?? '';
    $email    = $_POST["E-mail"] ?? '';
    $telefone = $_POST["Telefone"] ?? '';

    $dburl = getenv('DATABASE_URL');

    if (!$dburl) {
        die("Erro: A variável DATABASE_URL não foi encontrada no ambiente do Render.");
    }

    try {
        $dbopts = parse_url($dburl);
        $host   = $dbopts['host'];
        $port   = $dbopts['port'] ?? 5432;
        $user   = $dbopts['user'];
        $pass   = $dbopts['pass'];
        $dbname = ltrim($dbopts['path'], '/');

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
        
       $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'     => $nome,
            ':email'    => $email,
            ':telefone' => $telefone
        ]);

        echo "<h1>Cadastro realizado com sucesso</h1><br>";
        echo "Nome: " . htmlspecialchars($nome) . "<br>";
        echo "E-mail: " . htmlspecialchars($email) . "<br>";
        echo "Telefone: " . htmlspecialchars($telefone);

    } catch (PDOException $e) {
        die("Erro ao conectar ou gravar no Neon: " . $e->getMessage());
    }
}
?>