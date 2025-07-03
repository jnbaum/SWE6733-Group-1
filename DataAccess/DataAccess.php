<?php
//https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/index.html
require_once(__DIR__ . '/../Packages/vendor/autoload.php');
require_once(__DIR__ . '/../Models/QueryType.php');
use Doctrine\DBAL\DriverManager;

class DataAccess {
    public function GetConnection() {
            $connectionParams = [
        'dbname' => 'rovalydb',
        'user' => 'root',
        'password' => '',
        'host' => 'rovaly-db:3306', // change this to 127.0.0.1:3306
        'driver' => 'pdo_mysql'
    ];
    return DriverManager::GetConnection($connectionParams);

    }

    public function GetPhoto(int $userKey): ?string {
        $conn = $this->GetConnection();
        
        $result = $conn->executeQuery(
            "SELECT PhotoUrl FROM profilephoto WHERE UserKey = ?",
            [$userKey]
        );
        
        $row = $result->fetchAssociative();
        $conn->close();
        
        return $row['PhotoUrl'] ?? null;
    }
    

    public function ExecuteQuery(string $query, QueryType $queryType) {
        $conn = $this->GetConnection();
        $stmt = $conn->ExecuteQuery($query);
        
        // Return the key of the record that was inserted if doing an INSERT query
        if($queryType == QueryType::INSERT) {
            $lastInsertedId = $conn->lastInsertId();
            $conn->close();
            return $lastInsertedId;
        }
        $conn->close();
        return $stmt;
    }

}
?>