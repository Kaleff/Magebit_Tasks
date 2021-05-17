<?php


class Main extends Model
{
    public function verifyEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        } else if(substr($email, -2) == "co") {
            return "We don't accept emails from Columbia";
        } else {
            $pdoInfo = $this->pdo->query('SELECT *
                                                   FROM `email_list`');
            while($row = $pdoInfo->fetch(PDO::FETCH_ASSOC)) {
                if($row['email'] == $email) {
                    return "This e-mail is already subscribed to our newsletter!";
                }
            }
            $array1 = explode("@",$email);
            $domain = array_pop($array1);
            $email = strtolower($email);
            $domainId = $this->domainRegister($domain);

            $sql = "INSERT INTO `email_list` (email, domain_id) 
                    VALUES (:email, :domain_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'domain_id' => $domainId]);
            return true;
        }
    }
    protected function domainRegister($domain)
    {
        $pdoInfo = $this->pdo->query('SELECT * 
                                               FROM `email_domains`');
        while($row = $pdoInfo->fetch(PDO::FETCH_ASSOC)) {
            if($row['domain_name'] == $domain) {
                return $row['id'];
            }
        }
        $sql = "INSERT INTO `email_domains` (domain_name)  
                VALUE (:domain_name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['domain_name' => $domain]);
        return $this->domainRegister($domain); // WHEN NEW DOMAIN IS ADDED, THE METHOD STARTS AGAIN TO DETERMINE THE ID OF NEW DOMAIN
    }

    public function getDatabaseInfo()
    {
        $page= isset($_GET['page']) ? $_GET['page'] : 1;
        $page = (int) $page;
        $limit = 10;
        $offset = $limit * ($page - 1);

        if(isset($_POST['deleteId'])) {
            $this->deleteRecord($_POST['deleteId']);
        };
        $order = "ORDER BY `id` DESC"; // DEFAULT SORTING
        if(isset($_POST['ORDER_BY']) &&
        isset($_POST['orderDirection'])) {
            $order = "ORDER BY `" . $_POST['ORDER_BY'] . "` " .$_POST['orderDirection']; //OVERWRITES SORTING PARAMETERS IF SET BY USER
        }
        $urlSegments = explode("/", $_SERVER['REQUEST_URI']);
        $lastSegment = $urlSegments[count($urlSegments)-1]; // This detects whether or not filter request was required or not.
        $lastSegment = (int) $lastSegment;
        if($lastSegment != 0) {
            $categoryFilter = $lastSegment;
            $categoryFilter = (int) $categoryFilter; // PROTECTION FROM SQL INJECTION, SINCE ANYTHING OTHER THAN A NUMBER TURNED INTO A ZERO
            $sql = "SELECT * 
                    FROM `email_list` 
                    WHERE domain_id = (:domain_id)
                    $order
                    LIMIT $limit
                    OFFSET $offset";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['domain_id' => $categoryFilter]);
            $pdoInfo = $stmt;
            $pdoCategories = $this->pdo->query("SELECT * 
                                                         FROM `email_domains`");
            $res = $this->pdo->prepare('SELECT COUNT(*) 
                                              FROM email_list
                                              WHERE domain_id = (:domain_id)');
            $res->execute(['domain_id' => $categoryFilter]);
            $num_rows = $res->fetchColumn();
            $totalPages = $num_rows / 10;
            $totalPages = ceil($totalPages);
            $MainInformation = [
                "pdoInfo" => $pdoInfo,
                "pdoCategories" => $pdoCategories,
                "categoryFilter" => $categoryFilter,
                "totalPages" => $totalPages,
                "page" => $page
            ];
        } else {
            $pdoInfo = $this->pdo->query("SELECT * 
                                                   FROM `email_list`
                                                   $order
                                                   LIMIT $limit
                                                   OFFSET $offset");
            $res = $this->pdo->prepare('SELECT COUNT(*) 
                                              FROM email_list');
            $res->execute();
            $num_rows = $res->fetchColumn();
            $totalPages = $num_rows / 10;
            $totalPages = ceil($totalPages);
            $pdoCategories = $this->pdo->query("SELECT * 
                                                         FROM `email_domains`");
            $MainInformation = [
                "pdoInfo" => $pdoInfo,
                "pdoCategories" => $pdoCategories,
                "categoryFilter" => null,
                "totalPages" => $totalPages,
                "page" => $page
            ];
        }
        return($MainInformation);
    }
    protected function deleteRecord($id)
    {
        $sql = "SELECT *
                FROM email_list
                WHERE id = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $domain_id = $row->domain_id;

        $sql = "DELETE FROM email_list
                WHERE id = (:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $sql = "SELECT * 
                FROM email_list
                WHERE domain_id = (:domain_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['domain_id' => $domain_id]);
        $count = $stmt->fetchColumn(); // IF DELETED E-MAIL WAS LAST OF IT`S KIND, IT DELETES THE DOMAIN ID AND ASSOCIATED BUTTON
        if(!$count) {
            $sql = "DELETE FROM `email_domains`
                    WHERE id = (:id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $domain_id]);
        }
    }
    public function printFile($postArray)
    {
        $ids = [];
        foreach($postArray as $key => $value) {
            $ids [] = $value;
        }
        $filename = "CVS TABLE ".date('d.m.Y H:i:s') . '.csv';
        // Create array
        $list = array ();

        // Append results to array
        array_push($list, array("## START OF USER TABLE ##"));
        $pdoInfo = $this->pdo->query("SELECT *
                                               FROM `email_list`");
        while ($row = $pdoInfo->fetch(PDO::FETCH_ASSOC)) {
            foreach($ids as $idd) {
                if($idd == $row['id']) {
                    array_push($list, array_values($row));
                }
            }
        }
        array_push($list, array("## END OF USER TABLE ##"));

        // Output array into CSV file
        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        foreach ($list as $rowF) {
            fputcsv($fp, $rowF);
        }
    }
}