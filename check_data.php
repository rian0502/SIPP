<?php
    require_once "config.php";
    class Check{
        private static $con;

        public static function checkData():int{
            self::$con = new Connection();
            $stmt = self::$con->getKoneksi()->prepare("SELECT COUNT(id_pinjam) AS jumlah FROM peminjaman");
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['jumlah'];
        }

    }
