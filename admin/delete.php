<?php 

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$kdBarang = $_GET['p'];
$foto = $_GET['foto'];

if( deleteStock($kdBarang, $foto) > 0 ){
    echo "
        <script>
            alert('data berhasil dihapus!');
            document.location.href = 'stock.php';
        </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal diahpus!');
        document.location.href = 'stock.php';
    </script>
";
}

?>