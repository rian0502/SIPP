<?php
class Connection{
    private static $USERNAME = "root";
    private static $PASSWORD = "rian";
    private static $HOSTNAME = "localhost";
    private static $DATABASE = "perpustakaan";
    private static $KONEKSI = NULL;
    public static function getConnection(){
        self::$KONEKSI = mysqli_connect(self::$HOSTNAME, self::$USERNAME, self::$PASSWORD, self::$DATABASE);
        return self::$KONEKSI;
    }
    public static function removeConnection(){
        self::$KONEKSI = NULL;
    }
}

if (Connection::getConnection()){
    echo "berhasil";
}else{
    echo "gagal";
}
?>