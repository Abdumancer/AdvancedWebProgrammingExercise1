<?php
interface iRadio {
    public function create($work_name, $work_text, $work_link, $identification_number);
    public function save();
    public function read();
}

class GraduateThesis implements iRadio {
    private $work_name;
    private $work_text;
    private $work_link;
    private $identification_number;
    private static $db;

    public function __construct() {
        self::$db = new mysqli('localhost', 'root', '', 'thesis'); 
        if (self::$db->connect_error) {
            die("Connection failed: " . self::$db->connect_error);
        }
    }

    public function create($work_name, $work_text, $work_link, $identification_number) {
        $this->work_name = $work_name;
        $this->work_text = $work_text;
        $this->work_link = $work_link;
        $this->identification_number = $identification_number;
    }

    public function save() {
        $stmt = self::$db->prepare("INSERT IGNORE INTO graduate_theses (work_name, work_text, work_link, identification_number) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $this->work_name, $this->work_text, $this->work_link, $this->identification_number);
        $stmt->execute();
        $stmt->close();
    }

    public function read() {
        $result = self::$db->query("SELECT * FROM graduate_theses");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
