<?php
	namespace crud;
	use PDO;
	class Crud{
		public function __construct(){
			$this->db = \config\Database::medoo();
		}
		public function fncStringifyArrCol($arrCol){
			$arrToString = "";
			$arrColLen = count($arrCol);
			$counter = 0;

			if(is_array($arrCol)){
				foreach($arrCol as $value) {
					$arrToString .= $value;
					$arrToString .= ($counter == $arrColLen-1) ? "" : ",";	
					$counter++;
				}
				return $arrToString;
			}		
		}
		public function view($strTbl,$arrCol=[],$arrWhere = []){
			$table = $strTbl;
			$columns = $arrCol;
			$where = $arrWhere;
			
			if(!empty($where)){

				if(is_array($columns))
					$columns = $this->fncStringifyArrCol($columns);
				foreach ($where as $key => $value) {
					$strWhere = $key . " = :".$key;
				}

				$sql = $this->db->pdo->prepare("SELECT $columns from $table WHERE $strWhere");

				$sql->execute($where);
				$result =  $sql->fetchAll(PDO::FETCH_ASSOC);
				
				if(empty($result)){

					$error["data"] = "0 Reuslts";
					$error["query"] = "Pls Check your Query: " . $sql->queryString; 
					$error["code"] = 400;
					
					return  $error;
				}
				else{
					$data["data"] = $result;
			    	$data["code"] = 200; 
			    	return $data;	
				}
					
			}
			else{
			    $sql = $this->db->pdo->prepare("SELECT * from $table");
			    $sql->execute();
			    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

			    if(empty($result)){
			    	$error["data"] = "0 Reuslts";
					$error["query"] = "Pls Check your Query: " . $sql->queryString;
					$error["code"] = 400;
					return $error;
			    }else{

			    	$data["data"] = $result;
			    	$data["code"] = 200;

			    	return $data;
			    }
			    
			}
		}
	}
?>