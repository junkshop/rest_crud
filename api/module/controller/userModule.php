<?php
	namespace Controller;
	use Psr\Http\Message\RequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;
	use crud\Crud as crud;
	use PDO;
	class Users{
		protected $crud;
		protected $db;
		public function __construct(){
			
			$this->crud = new crud();
		}
		public function fncView(Request $req, Response $res, $arg){
			$user_id = $arg;
			if($user_id == null){
				$results = $this->crud->view('users',"*");
				return $res->withJSON($results['data'],$results['code']);
			}
			else{
				$results = $this->crud->view('users','*',['id' => $user_id['id']]);
				return $res->withJSON($results['data'],$results['code']);
			}
		}
	}
?>