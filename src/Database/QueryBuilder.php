<?php
namespace Vannghia\PetCare\Database;
use PDO;
use Vannghia\PetCare\Database\Connections\ConnectDB;
class QueryBuilder {
    private ?PDO $pdo = null;
    protected $table = '';
    private $where = "";
    private $orderBy = "";
    private $limit = "";
    private $join = "";
    private  $para = [];


    private ?string  $prepare = null;
    public function __construct()
    {
        if($this->pdo === null)
        {
            $this->pdo = ConnectDB::connect();
        }
      


    }
    public function where(array $array)
    {
        if (empty($this->where)) {
            $this->where = " WHERE ";
        } else {
            $this->where .= " AND ";
        }
        foreach ($array as  $arr) {
            $this->where .= $arr[0] . " $arr[1] " . "'{$arr[2]}'" . " AND ";
        }
        $this->where = substr($this->where, 0, -5);
        return $this;
    }

  
    public function insert(array $data)
    {
        try {
            $field = array_keys($data);
            $val = array_values($data);
            $stringField = implode(",", $field);
            $stringQuestionMark = str_repeat("?, ", count($field));
            $stringQuestionMark = substr($stringQuestionMark, 0, -2);
            $this->prepare = "INSERT INTO " . $this->table . " (" . $stringField . ")" . " values " . "(" . $stringQuestionMark . ")";
            $run = $this->pdo->prepare($this->prepare);
            $run = $run->execute($val);
            return true;
        } catch (\PDOException $e) {
            echo "ERROR! Co loi xay ra voi PDO";
            file_put_contents('PDOErrors.txt', $e->getMessage() . " at " . date("d\m\Y H:m:s", time()) . "\n", FILE_APPEND);
        }
    }
    public function select(array $items = []): QueryBuilder
    {
        // TODO: Implement select() method.

        if (empty($items)) {
            $this->prepare = "SELECT * FROM " . static::$table;
        } else {
            $string = implode(",", $items);
            $this->prepare = "SELECT " . $string . " FROM " . static::$table;
        }
        return $this;
    }  
    
    public function getPrepareString()
    {
        return $this->prepare . $this->where ;
    }


    public function get($flag = PDO::FETCH_ASSOC)
    {
        try {
            if (empty($this->prepare)) {
                $this->prepare = "SELECT * FROM " . $this->table;
            }
            $this->prepare .= $this->where;
            $test = $this->pdo->prepare($this->prepare);
            $test->execute();
        
            return $test->fetchAll($flag);

        } catch (\PDOException $e) {
            echo $this->getPrepareString();
            echo " Have some errors";
            file_put_contents('PDOErrors.txt', $e->getMessage() . " at " . date("d\m\Y H:m:s", time()) . "\n", FILE_APPEND);
        }
    }

    public function first($flag = \PDO::FETCH_ASSOC)
    {
        try {
            if (empty($this->prepare)) {
                $this->prepare = "SELECT * FROM " . $this->table;
            }
            $run = $this->pdo->prepare($this->prepare . $this->join . $this->where . $this->orderBy);
                $run->execute();
            return $run->fetch($flag);
        } catch (\PDOException $e) {
            echo "have some errors";
            file_put_contents('PDOErrors.txt', $e->getMessage() . " at " . date("d\m\Y H:m:s", time()) . "\n", FILE_APPEND);
        }
    }
}