<?php
require_once 'app/models/User.php';

class UsersController{
	public function index(){
		$userModel = new User();
		$users = $userModel->readAll();
		
		include 'app/views/users/index.php';
	}

	public function create(){
		include 'app/views/users/create.php';
	}

	public function store(){
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			if($password !== $confirm_password){
				echo "Password do not match";
				return;
			}

			$userModel = new User();
			$data = [
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => 1, //по умолчанию
			];
			$userModel->create($data);
		}
		header("Location: index.php?page=users");
	}

	public function edit(){
		$userModel = new User();
		$user = $userModel->read($_GET['id']);

		include 'app/views/users/edit.php';
	}

	public function update(){
		$userModel = new User();
		$userModel->update($_GET['id'], $_POST);
		header('Location: index.php?page=users');
	}

	public function delete(){
		$userModel = new User();
		$userModel->delete($_GET['id']);
		header('Location: index.php?page=users');
	}
}