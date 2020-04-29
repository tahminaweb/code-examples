<?php
include_once 'controller.php';
class Import extends controller {
    public function index() {
        $data = [];
        if(isset($_SESSION["message"])) {
            $data = [
                "message" => $_SESSION["message"]
            ];

            unset($_SESSION["message"]);
        }
        $this->renderPage('import.php', $data);
    }

    public function upload() {
        if( $_FILES["csvfile"]["tmp_name"] != '') {
            $db = PDB::getInstance();
            $row = 1;
            $cols = [];
            if (($handle = fopen($_FILES["csvfile"]["tmp_name"], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);

                    if($row == 1) {
                        for ($c=0; $c < $num; $c++) {
                            $cols [$c] = filter_var($data[$c], FILTER_SANITIZE_STRING);
                        }
                    }


                    if($row > 1) {
                        $inputData = [];
                        for ($c=0; $c < $num; $c++) {
                            if($cols [$c] == 'email') {
                                $inputData[$c] = filter_var($data[$c], FILTER_SANITIZE_EMAIL);
                            } else if($cols [$c] == 'www') {
                                $inputData[$c] = filter_var($data[$c], FILTER_SANITIZE_URL);
                            } else {
                                $inputData[$c] = filter_var($data[$c], FILTER_SANITIZE_STRING);
                            }
                        }


                        $sql = "INSERT INTO contacts (".implode(',', $cols).") VALUES ('".implode("','", $inputData)."')";
                        $db->query($sql);
                        $db->execute();


                    }


                    $row++;
                }
                fclose($handle);

                $_SESSION["message"] = [
                    'type' => 'success',
                    'message' => 'csv file imported',
                    'data' => $data
                ];

                header ('Location: /');
            }
        } else {
            $_SESSION["message"] = [
                'type' => 'danger',
                'message' => 'no csv file uploaded.'
            ];

            header ('Location: /import/');
        }
    }

    public function facebook() {

    }
}