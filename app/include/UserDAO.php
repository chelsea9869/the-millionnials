<?php
require_once 'common.php';
class UserDAO{

    public function retrieveProfile($username){
        
        $conn_manager = new ConnectionManager();
        $conn = $conn_manager->getConnection();
        
        $sql = 'SELECT profile from user where username=:username';
        $stmt = $conn->prepare($sql);
        @$stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $row = $stmt->fetch();
        $profile = $row['profile'];

        $stmt->closeCursor();
        $conn = null;

        return $profile;
    }
    public function updateRiskProfile($username,$profile){
        
        $conn_manager = new ConnectionManager();
        $conn = $conn_manager->getConnection();
        
        $sql = 'Update user set profile=:profile where username=:username';
        $stmt = $conn->prepare($sql);
        @$stmt->bindParam(':username', $username, PDO::PARAM_STR);
        @$stmt->bindParam(':profile', $profile, PDO::PARAM_STR);

        if (!$status = $stmt->execute()) {
            return $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();
        $conn = null;

        return $status;
    }
}


?>