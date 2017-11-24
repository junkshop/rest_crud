<?php 

	namespace config;

	class Database{

		public static function medoo(){

			return new \medoo(
				[
					"database_type" => "mysql",
					"database_name"	=> "dumbdb", 
					"server"	    => "localhost",
					"username"		=> "root",
					"password"		=> "",
					"charset"	 	=> "utf8",

				]
			);
		}
	}

?>