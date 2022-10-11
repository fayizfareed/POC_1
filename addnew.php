<?php

use Web\FS\Data\Database;

//require __DIR__ . "/Web/FS/Data/Database.php";

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/db.php';

$form = new HTML_QuickForm2('tutorial');

// Set defaults for the form elements
// $form->addDataSource(new HTML_QuickForm2_DataSource_Array([
//     'name' => 'Joe User'
// ]));

// Add some elements to the form
$fieldset = $form->addElement('fieldset')->setLabel('Basic User Info');
$firstname = $fieldset->addElement('text', 'firstname', ['size' => 50, 'maxlength' => 200])->setLabel('First Name:');
$lastname = $fieldset->addElement('text', 'lastname', ['size' => 50, 'maxlength' => 200])->setLabel('Last Name:');
$email = $fieldset->addElement('text', 'emailaddresss', ['size' => 50, 'maxlength' => 200])->setLabel('Email:');
$fieldset->addElement('submit', null, ['value' => 'Save']);

// Define filters and validation rules
$firstname->addFilter('trim');
$firstname->addRule('required', 'You Must Fill First Name');

$lastname->addFilter('trim');
$lastname->addRule('required', 'You Must Fill Last Name');

$email->addFilter('trim');
$email->addRule('required', 'You Must Fill Email Address');
$email->addRule('regex', 'You Must Enter Valid Email Address', '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');

// Try to validate a form
if ($form->validate()) {
    try
    {
        // $db = new Database("Assignment");
        // $db->Insert("Insert Into user_info (first_name, last_name, mail_address) VALUES ('.$firstname->getValue().','.$lastname->getValue().','.$email->getValue().')", []);
        $fname = $firstname->getValue();
        $lname = $lastname->getValue();
        $mail = $email->getValue();
        $conn_string = "host=localhost port=5432 dbname=".$dbname." user=".$dbusername." password=".$dbpassword;
        $query1 = "Insert Into user_info (first_name, last_name, mail_address) VALUES ($1,$2,$3)";
        $conn = pg_connect($conn_string);
        if (pg_send_query_params($conn, $query1, array( $fname, $lname, $mail))) {
            $res=pg_get_result($conn);
            if ($res) {
              $state = pg_result_error_field($res, PGSQL_DIAG_SQLSTATE);
              if ($state==0) {
                echo file_get_contents("html/validation_header.html");
                echo "Data Added To Database Successfully";
              }
              else {
                // some error happened
                if ($state=="23505") { 
                    echo file_get_contents("html/validation_header.html");
                    echo "You Must Type Unique Email Address";
                  // process specific error
                }
                else {
                    echo file_get_contents("html/validation_header.html");
                    echo "Something Went Wrong while processing data";
                }
              }
            }  
          }
    }
    catch(Exception $ee0)
    {
        echo $ee0;
    }
    exit;
}

// Output the form
echo file_get_contents("html/header1.html");
echo $form;