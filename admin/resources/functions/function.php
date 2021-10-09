<?php
// The function takes 3 parameters the id , the table name and condition if found
    function countItem($id , $table , $condition=null)
    {
            global $con;
            if($condition == "groupid = 0")
            // To only display the users who have groupID = 0
            {
                $stmt2 = $con -> prepare("SELECT COUNT($id) FROM $table WHERE $condition");
                $stmt2 -> execute();
                $count = $stmt2->fetchColumn();
                return $count;
            }
            // To display data if exists
            elseif ($id > 0)
            {
                $stmt2 = $con -> prepare("SELECT COUNT($id) FROM $table"); 
                $stmt2 -> execute();
                $count = $stmt2->fetchColumn();
                return $count;
            }
            else
            {
                $stmt3 = $con -> prepare("SELECT COUNT($id) FROM $table"); 
                $stmt3 -> execute();
                $count = $stmt3->fetchColumn();
                return $count;
            }
    }
?>