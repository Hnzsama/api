<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Content-Type: application/json; charset=UTF-8');

include "db_config.php";

$postjson = json_decode(file_get_contents('php://input'), true);
$aksi = strip_tags($postjson['aksi']);
$data = array();

switch($aksi) {
    case 'add_buku':
        $judul = filter_var($postjson['judul'], FILTER_SANITIZE_STRING);
        $jenis = filter_var($postjson['jenis'], FILTER_SANITIZE_STRING);
        $pengarang = filter_var($postjson['pengarang'], FILTER_SANITIZE_STRING);
        $tahun_terbit = filter_var($postjson['tahun_terbit'], FILTER_SANITIZE_STRING);
        $isbn = filter_var($postjson['isbn'], FILTER_SANITIZE_STRING);
        $keterangan = filter_var($postjson['keterangan'], FILTER_SANITIZE_STRING);

        try {
            $sql = "INSERT INTO buku (judul, jenis, pengarang, tahun_terbit, isbn, keterangan) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $judul);
            $stmt->bindParam(2, $jenis);
            $stmt->bindParam(3, $pengarang);
            $stmt->bindParam(4, $tahun_terbit);
            $stmt->bindParam(5, $isbn);
            $stmt->bindParam(6, $keterangan);
            $stmt->execute();

            echo json_encode(['success' => true]);
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'msg' => $e->getMessage()]);
        }
        break;

    case 'get_buku':
        $limit = filter_var($postjson['limit'], FILTER_SANITIZE_NUMBER_INT);
        $start = filter_var($postjson['start'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $sql = "SELECT * FROM buku ORDER BY id DESC LIMIT :start, :limit";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row) {
                $data[] = array(
                    'id' => $row['id'],
                    'judul' => $row['judul'],
                    'jenis' => $row['jenis'],
                    'pengarang' => $row['pengarang'],
                    'tahun_terbit' => $row['tahun_terbit'],
                    'isbn' => $row['isbn'],
                    'keterangan' => $row['keterangan'],
                );
            }

            echo json_encode(['success' => true, 'result' => $data]);
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'msg' => $e->getMessage()]);
        }
        break;
}
?>
