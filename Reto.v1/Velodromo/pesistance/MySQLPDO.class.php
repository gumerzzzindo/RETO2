<?php
//incluir la clase
//use MySQLPDO as GlobalMySQLPDO;
//include_once "../entity/Numeros.class.php";
class MySQLPDO {
    private static $host = "10.11.0.127"; //o la IP del servidor de BBBDD remoto
    private static $database = "prueba";
    private static $username = "admin";
    private static $password = "Maristak2324";
    private static $base;
    
    public static function connect() {
        if (MySQLPDO::$base != null) {
            MySQLPDO::$base = null;
        }
        try {
            $dsn = "mysql:host=" . MySQLPDO::$host . ";dbname=" . MySQLPDO::$database;
            MySQLPDO::$base = new PDO($dsn, MySQLPDO::$username, MySQLPDO::$password);
            MySQLPDO::$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return MySQLPDO::$base;
        } catch (Exception $e) {
            die ("Error connecting: {$e->getMessage()}");
        }
    }
    
    //ejecuta sentencias INSERT, UPDATE y DELETE
    public static function exec($sql, $params) {
        $stmt = MySQLPDO::$base->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->rowCount();
        return $result; //devuelve el n� de filas afectadas por la sentencia
    }
    
    //ejecuta sentencias SELECT
    public static function select($sql, $params) {
        $stmt = MySQLPDO::$base->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll();
        return $result; //devuelve el conjunto de datos de la consulta
    }

    public static function insertusu ($usuario){
        $sql="INSERT INTO usuarios (nombre,contrasena) VALUES (?,?)";
        $params=array  ($usuario->getNombre(),$usuario->getContra());
        $result= MySQLPDO::exec($sql,$params);
        return $result;
    }
    public static function buscarUsu($buscar) {
        $sql = "SELECT * FROM usuarios WHERE id LIKE ? OR nombre LIKE ?";
        $params = ["%$buscar%", $buscar];  // Corrección: Cambiar ( al corchete [ y ; a ]
        $result = MySQLPDO::select($sql, $params);
        return $result;
    }
    
}
?>