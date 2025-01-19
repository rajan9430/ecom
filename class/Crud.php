<?php // Start PHP tag
require_once('Db.php'); // Include Db.php file

class Crud extends Db // Create Crud class extending Db class
{
    // $insert_data = array( // Commented out code for inserting data
    //     'username' => 'Rajan  Tiwari',
    //     'pass' => $password,
    // );

    public function insert($table_name, $data) 
    {
        if (!empty($data)) { 
            $fields = $placeholder = []; 

            foreach ($data as $field => $value) { 
                $fields[] = $field; 
                $placeholder[] = ":{$field}"; 
            }
        }

        $sql = "INSERT INTO {$table_name} (" . implode(',', $fields) . ") VALUES(" . implode(',', $placeholder) . ")"; 
        $stmt = $this->db->prepare($sql); 

        try { // Try executing SQL statement
            $this->db->beginTransaction(); 
            $stmt->execute($data); 
            $insert_id = $this->db->lastInsertId(); 
            $this->db->commit(); 
            return $insert_id; 
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage(); 
        }
    }

    public function slugify($text, $slug_url, $table_name) 
    {
        //preg_replace(patterns, replacements, input, limit)
        $text = preg_replace('/[^a-z0-9]+/i', '-', strtolower($text)); 

        $query = "SELECT $slug_url FROM $table_name WHERE $slug_url LIKE '$text%'"; 
        $stmt = $this->db->prepare($query); 

        $stmt->execute(); 
        if ($stmt->rowCount() > 0) { 
            $result = $stmt->fetchAll(); 
            foreach ($result as $row) { 
                $data[] = $row[$slug_url]; 
            }

            if (in_array($text, $data)) { 
                $count = 0; 
                while (in_array(($text . '-' . ++$count), $data)); 
                $text = $text . '-' . $count; 
            }
        }

        return $text; 
    }

    public function get($table_name, $offset, $records_per_page) 
    {
        $sql = "SELECT * FROM $table_name LIMIT $offset, $records_per_page"; 
        // prepare our query
        $stmt = $this->db->prepare($sql); 
        
        $stmt->execute(); 
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        return $result; 
    }

    public function custom_get($table_name, $where = '', $fetch_type = "fetchAll") 
    {
        $sql = "SELECT * FROM $table_name "; 
        if (!empty($where)) { 
            $sql .= $where; 
        }
        // prepare our query
        $stmt = $this->db->prepare($sql); 
        
        $stmt->execute(); 

        if ($fetch_type == "fetchAll") { 
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }
        if ($fetch_type == "fetch") { 
           
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        return $result; 
    }

    public function query($query, $where = '', $fetch_type = "fetchAll") 
    {
       
        // prepare our query
        $stmt = $this->db->prepare($query); 
        $stmt->execute(); 

        if ($fetch_type == "fetchAll") { 
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        }
        if ($fetch_type == "fetch") { 
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        return $result; 
    }

    public function pagination($table, $no_of_records_per_page) 
    {
        $query = "SELECT COUNT(*) FROM $table"; 
        $stmt = $this->db->prepare($query); 
        $stmt->execute(); 
        $total_records = $stmt->fetchColumn(); 
        $total_pages = ceil($total_records / $no_of_records_per_page); 

        return $total_pages; 
    }

    public function where() 
    {
        " WHERE "; 
        return $this; 
    }

    public function update($table, $data, $where) 
    {
        if (!empty($data)) { 
            $fields = ''; 
            $x = 1; 
            $fieldscount = count($data); 
            foreach ($data as $field => $value) { 
                $fields .= "{$field}=:{$field}";
                if ($x < $fieldscount) { 
                    $fields .= ", "; 
                }
                $x++; 
            }
        }
        $sql = "UPDATE $table SET {$fields} $where"; 
        $stmt = $this->db->prepare($sql); 
        try { 
            $this->db->beginTransaction(); 
            $stmt->execute($data); 
            $this->db->commit(); 
            return true; 
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage(); 
            $this->db->rollback(); 
        }
    }

    public function delete($table, $where) 
    {
        $sql = "DELETE FROM $table $where"; 
        $stmt = $this->db->prepare($sql); 
        try { 
            $stmt->execute(); 
            return true; 
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage(); 
            $this->db->rollback(); 
        }
    }
}
