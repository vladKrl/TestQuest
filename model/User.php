<?php
class User{
    public $userlogin, $password, $passwordconfirm, $email, $name, $salt, $coockie;

    public $errorArray;

    function __construct($userlogin, $password, $passwordconfirm, $email, $name){
        $this->userlogin = $userlogin;
        $this->password = $password;
        $this->passwordconfirm = $passwordconfirm;
        $this->email = $email;
        $this->name = $name;
        $this->salt = $this->saltGenerate();
        $this->coockie = $this->saltGenerate();

        $this->validation();

        if (isset($this->errorArray)){
            $this->errorProcessing();
            die();
        }
         else {
            setcookie('Key', $this->coockie, time()+60*60*24*7); 
            User::formationSession($this->userlogin, $this->email, $this->name);
            $this->password = md5($this->password . $this->salt);
            $dataStringJSON = Json::getAllStringJSON();
            Json::dataWrite((array)$this, $dataStringJSON); 

            $response = [
                'status' => true
            ];
            echo json_encode($response);
        }
    }

    // Формирование сессии
    static function formationSession($userlogin, $email, $name){
        $_SESSION['user'] = ['Login' => $userlogin, 'Email' => $email, 'Name' => $name];
        
        $_SESSION['auth'] = true;
    } 

    // Вызов функций валидации
    function validation(){

        $this->validPassword();
        $this->validConfirmPassword();
        $this->validUserlogin();
        $this->validEmail();
        $this->validName();
        
    }

    // Проверка пароля на валидность
    function validPassword(){
        if (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]{6,}$/', $this->password) )
            $this->errorArray['notValidPassword'] = 'Invalid password!';
    }

    // Проверка соответствия пароля и подтвержденного пароля 
    function validConfirmPassword(){
        if ($this->password != $this->passwordconfirm)
            $this->errorArray['notCorrectPasswords'] = 'Passwords don\'t match!';
    }                                                                                     

    // Проверка логина пользователя на валидность и уникальность
    function validUserlogin(){

        $responseStringJSON = Json::getAllStringJSON();
        $searchLoginRegex = '/"userlogin":"' . $this->userlogin . '"/';

        if (!preg_match('/^[^\sа-яА-ЯёЁ]{6,}$/', $this->userlogin))
            $this->errorArray['notValidUserlogin'] = 'Invalid login!';
            elseif (preg_match($searchLoginRegex, $responseStringJSON))
                $this->errorArray['notValidUserlogin'] = 'Login already exists!';
        
        unset($responseStringJSON, $searchLoginRegex);
    }

    // Проверка электронной почты на валидность и уникальность
    function validEmail(){

        $responseStringJSON = Json::getAllStringJSON();
        $searchLoginRegex = '/"email":"' . $this->email . '"/';

        if (!preg_match('/^\w+@\w+\.\w+$/', $this->email) )
        $this->errorArray['notValidEmail'] = 'Invalid e-mail!';
            elseif (preg_match($searchLoginRegex, $responseStringJSON))
                $this->errorArray['notValidEmail'] = 'E-mail already exists!';
            
        unset($responseStringJSON, $searchLoginRegex);
    } 

    // Проверка имени на валидность
    function validName(){
        if (!preg_match('/^[a-zA-Z]{2,}$/', $this->name) )
            $this->errorArray['notValidName'] = 'Invalid name!';
    }

    // Обработка ошибок
    function errorProcessing(){
        $response = [
            'status' => false
        ];
        foreach ($this->errorArray as $key => $value) {
            $response[$key] = $value;
        }
        echo json_encode($response);
    }

    // Вывод имени пользователя
    static function writeWelcomingMessage(){
        if(isset($_SESSION['user']['Name'])) 
            echo $_SESSION['user']['Name'];
    }

    // Авторизация пользователя
    static function userAuthorization($userlogin = '', $password = ''){
        $dataStringJSON = Json::getAllStringJSON();            

        $dataStringJSON = json_decode($dataStringJSON, true);

        $passwordFind = false;
        $loginFind = false;
        foreach ($dataStringJSON as $value) {
            if ($value['userlogin'] == $userlogin){
                $loginFind = true;
                if (md5($password . $value['salt']) == $value['password']) {
                    $passwordFind = true;
                    User::formationSession($value['userlogin'], $value['email'], $value['name']);
                    setcookie('Key', $value['coockie'], time()+60*60*24*7); 
                    
                    $response = [
                        'status' => true
                    ];
                    
                    echo json_encode($response);

                    break;
                }
                break;
            }
        }

        if(!$loginFind) {
            $response = [
                'status' => false,
                'notValidAuthorizeLogin' => 'Login doesn\'t exist!'
            ];
            echo json_encode($response);
            die();
        }
        if(!$passwordFind && $loginFind) {    
            $response = [
                'status' => false,
                'notValidAuthorizePassword' => 'Wrong password!'
            ];
            echo json_encode($response);
            die();
        }
       
    }

    // Генерация случайной строки, выступающей в качестве соли
    function saltGenerate($length = 8){				
	    $chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890'; 
	    $salt = ''; 
	    while($length--)
		    $salt .= $chars[random_int(0, strlen($chars) - 1)]; 
	    
	    return $salt;
    }

    
}