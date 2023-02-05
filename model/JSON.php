<?php

class Json{

    // Проверка существования файла JSON
    static function fileExist($filename){
        if (file_exists($filename)){
            $file = file_get_contents($filename);
        } else {
            $file = fopen($filename, 'a+');
        }
        return !empty($file)?$file:false;
    }

    // Запись строки в файл JSON (CREATE)
    static function dataWrite($newRecord, $dataStringJSON){

        if (!empty($newRecord) && !empty($dataStringJSON)) {
            unset($newRecord['passwordconfirm'], $newRecord['errorArray']);

            $dataArrayJSON = json_decode($dataStringJSON, true);

            array_push($dataArrayJSON, $newRecord);

            file_put_contents('../users.json', json_encode($dataArrayJSON));
        }
    }

    // Получение содержимого всего файла JSON в виде строки или массива JSON (READ)
    static function getAllStringJSON($isStringResponse = true){

        $file = Json::fileExist('../users.json');

        if ($file) {
            if ($isStringResponse) {
                return $file;
            } else {
                return json_decode($file, true);
            }
        } else {
            return false;
        }
        
    }

    // Получение одной записи из файла JSON в виде строки или массива JSON (READ)
    static function getRecordStringJSON($userlogin, $isStringResponse = true){

        $file = Json::fileExist('../users.json');
        
        if ($file){

            $dataArrayJSON = json_decode($file, true);

            foreach ($dataArrayJSON as $value) {
                if ($value['userlogin'] == $userlogin) {
                    if ($isStringResponse){
                        return json_encode($value);
                    } else {
                        return $value;
                    }
                }
            }
        }

        return false;
    }

    // Обновление записи в файле JSON (UPDATE)
    static function dataUpdate($updateRecord, $userlogin, $dataStringJSON){
        if (!empty($updateRecord) && !empty($userlogin) && !empty($dataStringJSON)) {
            $dataArrayJSON = json_decode($dataStringJSON, true);

            foreach ($dataArrayJSON as $key => $value) {
                if ($value['userlogin'] == $userlogin) {
                    if (isset($updateRecord['userlogin'])){
                        $dataArrayJSON[$key]['userlogin'] = $updateRecord['userlogin'];
                    }
                    if (isset($updateRecord['password'])){
                        $dataArrayJSON[$key]['password'] = md5($updateRecord['password'] . $updateRecord['salt']);
                    }
                    if (isset($updateRecord['email'])){
                        $dataArrayJSON[$key]['email'] = $updateRecord['email'];
                    }
                    if (isset($updateRecord['name'])){
                        $dataArrayJSON[$key]['name'] = $updateRecord['name'];
                    }
                    if (isset($updateRecord['salt'])){
                        $dataArrayJSON[$key]['salt'] = $updateRecord['salt'];
                    }
                    break;
                }
            }
            file_put_contents('../users.json', json_encode($dataArrayJSON));
        }
    }

    // Удаление записи из файла JSON (DELETE)
    static function dataDelete($userlogin, $dataStringJSON){
        if (!empty($userlogin) && !empty($dataStringJSON)) {
            
            $dataArrayJSON = json_decode($dataStringJSON, true);

            foreach ($dataArrayJSON as $key => $value) {
                if ($value['userlogin'] == $userlogin) {
                    unset($dataArrayJSON[$key]);
                }
            }
            file_put_contents('../users.json', json_encode($dataArrayJSON));
        }
    } 

}