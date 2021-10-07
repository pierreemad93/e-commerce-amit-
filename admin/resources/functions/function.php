<?php
    function countItem($id , $table , $condition=null)
    {
            global $con;
            if($condition == "groupid = 0")
            {
                $stmt2 = $con -> prepare("SELECT COUNT($id) FROM $table WHERE $condition");
                $stmt2 -> execute();
                $count = $stmt2->fetchColumn();
                return $count;
            }
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