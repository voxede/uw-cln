<?php

class HomeController extends BaseController
{
    public function index()
    {
        if(isset($_POST['user_name']) && isset($_POST["password"]))
        {
            $user_name = $_POST['user_name'];
            $password  = $_POST['password'];

            $userModel = $this->model('UserModel');
            
            $data = $userModel->readFromUserName($user_name);

            $db_user_name = $data[0]['user_name'];
            $db_password = $data[0]['password'];

            if($password === $db_password)
            {
                session_start();

                $user_data = [
                    'user_name' => $db_user_name,
                    'password' => $db_password
                ];

                $_SESSION['user_data'] = $user_data;

                var_dump($user_data);
            }
        }

        $this->view('home/index');
    }

    /*public function test()
    {
        $data = [
            'user_name' => 'voxede',
            'email' => 'voxede@server.com',
            'password' => '12345678'
        ];

        $this->view('home/test');

        $userModel = $this->model('UserModel');
        $userModel->create($data);
    }*/
}
