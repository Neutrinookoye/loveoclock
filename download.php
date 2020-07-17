<?php
require_once("config.php") ;
require_once("database.class.php") ;

//check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $the_email = $_POST['email'] ;
        // Check if the field is completely filled i.e not empty
        if(!empty($the_email)) {
            $model_object = new DBResult($DBF) ;
		    $model_object->connect() ;
            //Now sanitize the input
            // $the_email = validate_email($email_pattern , $email , $model_object->connect() ) ;	

            // Query the database to see if the value entered by the user is unique
            $que = "SELECT Email FROM download WHERE Email = '$the_email' " ;
            $data = mysqli_query($model_object->connect() , $que) ;
                if(mysqli_num_rows($data) == 0) {
                    if($the_email) {
                        $query = "INSERT INTO download(email) VALUE ('$the_email')" ;
                        $model_object->setQuery($query) ;
                        $result = mysqli_query($model_object->connect() , $model_object->getQuery()) ;
                        echo("Congratulations... The link to download the app will be forwarded to your email very soon") ;
                    }
                    else {
                        echo("Please enter the field correctly") ;
                    }
                } 
                else {
			        echo("This email already exist") ;
                }

                $model_object->close();

        }
        else {
		    $msg = 'Please , you need to fill all the fields' ;  
		    echo($msg) ;
        }

    }

?>