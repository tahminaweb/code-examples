<?php
include_once 'controller.php';
class Contact extends controller {
    public function index() {
        $db = PDB::getInstance();
        $sortBy = filter_var(isset($_POST['sort'])? key($_POST['sort']) : 'name', FILTER_SANITIZE_STRING);
        $sortOrder = filter_var( isset($_POST['sort'][$sortBy])? $_POST['sort'][$sortBy] : 'asc', FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM contacts ";
        $order = "order by $sortBy $sortOrder";
        $q = filter_var($_POST['searchPhrase'], FILTER_SANITIZE_STRING);

        if($q != '') {
            $sql .= " WHERE `name` LIKE '%{$q}%' OR
            `work_phone` LIKE '%{$q}%' OR
            `mobile` LIKE '%{$q}%' OR
            `email` LIKE '%{$q}%' OR
            `address` LIKE '%{$q}%' OR
            `category` LIKE '%{$q}%'
            ";
        }

        $current = (int) $_POST['current'];
        $rowCount = (int) $_POST['rowCount'];
        $offset = ($current - 1) * $rowCount;
        $limit = " LIMIT {$offset}, {$rowCount} ";
        $db->query($sql);
        $db->collections();
        $totalCount = $db->count();

        $db->query($sql.$order.$limit);

        $rows = $db->collections();

        $output = [
            "current"=> $current,
            "rowCount"=> $rowCount,
            "rows" => $rows,
            "total"=> $totalCount
        ];

        $this->renderJSON($output);
    }

    public function add() {
        $data = [];
        if(isset($_SESSION["message"])) {
            $data = [
                "message" => $_SESSION["message"]
            ];

            unset($_SESSION["message"]);
        }

        $this->renderPage('add-new.php', $data);
    }

    public function save() {
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['category'] = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['work_phone'] = filter_var($_POST['work_phone'], FILTER_SANITIZE_STRING);
        $data['mobile'] = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
        $data['www']= filter_var($_POST['url'], FILTER_SANITIZE_URL);

        if($data['name'] == '' || $data['email'] == '' || $data['address'] == '') {
            $_SESSION["message"] = [
                'type' => 'danger',
                'message' => 'Please entered required (*) entry',
                'data' => $data
            ];

            header ('Location: /contacts/add');
        }

        $cols = [];
        $rows = [];

        foreach($data as $key=>$value) {
            $cols []= $key;
            $rows []= "'{$value}'";
        }
        $db = PDB::getInstance();
        $sql = "INSERT INTO contacts (".implode(',', $cols).") VALUES (".implode(',', $rows).")";

        $db->query($sql);
        $db->execute();

        $_SESSION["message"] = [
            'type' => 'success',
            'message' => 'contact successfully added.',
            'data' => $data
        ];

        header ('Location: /');
    }


    public function edit($id) {
        $data = [];
        if(isset($_SESSION["message"])) {
            $data = [
                "message" => $_SESSION["message"]
            ];

            unset($_SESSION["message"]);
        } else {
            $sql = "SELECT * FROM contacts WHERE `id` = {$id}";
            $db = PDB::getInstance();
            $db->query($sql);
            $result = $db->single();

            if(empty($result)) {
                $_SESSION["message"] = [
                    'type' => 'danger',
                    'message' => 'ID# {$id} is not exists.'
                ];

                header ('Location: /');
            }

            $data['message']['data'] = $result;
        }

        $this->renderPage('edit.php', $data);
    }

    public function show($id) {
        $data = [];
        $sql = "SELECT * FROM contacts WHERE `id` = {$id}";
        $db = PDB::getInstance();
        $db->query($sql);
        $result = $db->single();

        if(empty($result)) {
            $_SESSION["message"] = [
                'type' => 'danger',
                'message' => 'ID# {$id} is not exists.'
            ];

            header ('Location: /');
        }

        $data['message']['data'] = $result;
        $this->renderPage('show.php', $data);
    }

    public function update($id) {
        $data['id'] = $id;
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['category'] = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['work_phone'] = filter_var($_POST['work_phone'], FILTER_SANITIZE_STRING);
        $data['mobile'] = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
        $data['www']= filter_var($_POST['url'], FILTER_SANITIZE_URL);

        if($data['name'] == '' || $data['email'] == '' || $data['address'] == '') {
            $_SESSION["message"] = [
                'type' => 'danger',
                'message' => 'Please entered required (*) entry',
                'data' => $data
            ];

            header ('Location: /contacts/add');
        }

        $cols = [];
        $rows = [];

        foreach($data as $key=>$value) {
            $cols []= $key;
            $rows []= "'{$value}'";
        }
        $db = PDB::getInstance();
        $sql = "REPLACE INTO contacts (".implode(',', $cols).") VALUES (".implode(',', $rows).")";

        $db->query($sql);
        $db->execute();

        $_SESSION["message"] = [
            'type' => 'success',
            'message' => 'contact successfully added.'
        ];

        header ('Location: /');
    }

    public function delete($id) {
        $sql = "SELECT * FROM contacts WHERE `id` = {$id}";
        $db = PDB::getInstance();
        $db->query($sql);
        $result = $db->single();

        if(empty($result)) {
            $_SESSION["message"] = [
                'type' => 'danger',
                'message' => 'ID# {$id} is not exists.'
            ];

            header ('Location: /');
        } else {
            $sql = "DELETE FROM contacts WHERE `id` = {$id}";
            $db->query($sql);
            $db->execute();
        }

        $_SESSION["message"] = [
            'type' => 'success',
            'message' => 'contact successfully deleted.'
        ];

        header ('Location: /');
    }
}