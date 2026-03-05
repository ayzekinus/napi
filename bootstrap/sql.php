<?php

class Sql {

    private static $instance;
    private static $db = null;
    public static $pdo = null;
    private static $select = '*';
    private static $from = null;
    private static $where = null;
    private static $limit = null;
    private static $join = null;
    private static $order_by = null;
    private static $group_by = null;
    private static $having = null;
    private static $num_rows = 0;
    private static $insert_id = null;
    private static $query = null;
    private static $error = null;
    private static $cache = null;
    private static $result = array();
    private static $prefix = null;
    private static $print = false;
    private static $array_mode = false;
    private static $op = array('=', '!=', '<', '>', '<=', '>=', '<>');
    public static $queryCount = 0;

    function __construct() {
        
    }

    public static function __callstatic($name, $params) {
        self::$name($params);
    }

    public static function getInstance() {

        if (empty(self::$instance)) {
            self::$instance = new Sql();
            self::$db = Database::getInstance();
            self::$pdo = self::$db->connect();
            self::$prefix = self::$db->getPrefix();
        }
        return self::$instance;
    }

    public function select($select) {
        self::$select = $select;
        return new self;
    }

    public function from($from) {
        self::instanceControl();
        self::$from = self::$prefix . $from;
        return new self;
    }

    public function join($table, $field1, $op = null, $field2 = null, $join = 'INNER') {
        $where = $field1;
        $table = self::$prefix . $table;

        if (!is_null($op))
            $where = (!in_array($op, self::$op) ? $field1 . ' = ' . $op : $field1 . ' ' . $op . ' ' . $field2);

        if (is_null(self::$join))
            self::$join = " " . $join . " JOIN" . " " . $table . " ON " . $where;
        else
            self::$join = self::$join . " " . $join . " JOIN" . " " . $table . " ON " . $where;

        return new self;
    }

    public function leftJoin($table, $field1, $op = null, $field2 = null) {
        self::join($table, $field1, $op, $field2, 'LEFT');
        return new self;
    }

    public function rightJoin($table, $field1, $op = null, $field2 = null) {
        self::join($table, $field1, $op, $field2, 'RIGHT');
        return new self;
    }

    public function where($where, $op = null, $val = null, $ao = 'AND') {

        if (is_array($where)) {
            $_where = array();
            foreach ($where as $column => $data)
                $_where[] = $column . '=' . self::escape($data);

            $where = implode(' ' . $ao . ' ', $_where);
        } else {
            if (!is_null($op)) {
                if (!in_array($op, self::$op))
                    $where = $where . ' = ' . self::escape($op);
                else
                    $where = $where . ' ' . $op . ' ' . self::escape($val);
            }
        }

        if (is_null(self::$where))
            self::$where = $where;
        else
            self::$where = self::$where . ' ' . $ao . ' ' . $where;
        return new self;
    }

    public function orWhere($where, $op = null, $val = null) {
        self::where($where, $op, $val, 'OR');
        return new self;
    }

    public function whereGroup($obj) {
        if (is_object($obj)) {
            if (is_null(self::$where)) {
                self::$where = '(';
                call_user_func($obj);
                self::$where .= ')';
            } else {
                self::$where = self::$where . ' (';
                call_user_func($obj);
                self::$where .= ')';
            }
        }

        return new self;
    }

    public function in($field, $keys, $not = '', $ao = 'AND') {
        if (is_array($keys)) {
            $_keys = array();
            foreach ($keys as $k => $v)
                $_keys[] = (is_numeric($v) ? $v : self::escape($v));

            $keys = implode(', ', $_keys);

            if (is_null(self::$where))
                self::$where = $field . ' ' . $not . 'IN (' . $keys . ')';
            else
                self::$where = self::$where . ' ' . $ao . ' ' . $field . ' ' . $not . 'IN (' . $keys . ')';
        }
        return new self;
    }

    public function notIn($field, $keys) {
        self::in($field, $keys, 'NOT ', 'AND');
        return new self;
    }

    public function orIn($field, $keys) {
        self::in($field, $keys, '', 'OR');
        return new self;
    }

    public function orNotIn($field, $keys) {
        self::in($field, $keys, 'NOT ', 'OR');
        return new self;
    }

    public function between($field, $value1, $value2, $not = '', $ao = 'AND') {

        if (is_null(self::$where))
            self::$where = $field . ' ' . $not . 'BETWEEN ' . self::escape($value1) . ' AND ' . self::escape($value2);
        else
            self::$where = self::$where . ' ' . $ao . ' ' . $field . ' ' . $not . 'BETWEEN ' . self::escape($value1) . ' AND ' . self::escape($value2);

        return new self;
    }

    public function notBetween($field, $value1, $value2) {
        self::between($field, $value1, $value2, 'NOT ', 'AND');
        return new self;
    }

    public function orBetween($field, $value1, $value2) {
        self::between($field, $value1, $value2, '', 'OR');
        return new self;
    }

    public function orNotBetween($field, $value1, $value2) {
        self::between($field, $value1, $value2, 'NOT ', 'OR');
        return new self;
    }

    public function like($field, $data, $type = '%-%', $ao = 'AND') {
        $like = '';
        if ($type == '-%')
            $like = $data . '%';
        elseif ($type == '%-')
            $like = '%' . $data;
        else
            $like = '%' . $data . '%';

        $like = self::escape($like);

        if (is_null(self::$where))
            self::$where = $field . ' LIKE ' . $like;
        else
            self::$where = self::$where . ' ' . $ao . ' ' . $field . ' LIKE ' . $like;

        return new self;
    }

    public function orLike($field, $data, $type = '%-%') {
        self::like($field, $data, $type, 'OR');
        return new self;
    }

    public function limit($limit, $limitEnd = null) {
        if (!is_null($limitEnd))
            self::$limit = $limit . ', ' . $limitEnd;
        else
            self::$limit = $limit;

        return new self;
    }

    public function orderBy($order_by, $order_dir = null) {
        if (!is_null($order_dir))
            self::$order_by = $order_by . ' ' . $order_dir;
        else {
            if (stristr($order_by, ' ') || $order_by == 'rand()')
                self::$order_by = $order_by;
            else
                self::$order_by = $order_by . ' ASC';
        }

        return new self;
    }

    public function groupBy($group_by) {
        self::$group_by = $group_by;
        return new self;
    }

    public function having($field, $op = null, $val = null) {
        if (!in_array($op, self::$op))
            self::$having = $field . ' > ' . self::escape($op);
        else
            self::$having = $field . ' ' . $op . ' ' . self::escape($val);

        return new self;
    }

    public function count() {
        return self::$num_rows;
    }

    public function print_mode($mode = false) {
        self::$print = $mode;
        return new self;
    }

    public function insertId() {
        return self::$insert_id;
    }

    public function error() {        
        $msg .= '<span><strong>Query:</strong> <em style="font-weight:normal;">" ' . self::$query . ' "</em></span><br/>';
        $msg .= '<span><strong>Error:</strong> <em style="font-weight:normal;">' . self::$error . '</em></span><br/>';
        $msg .= '<span><strong>User:</strong> <em style="font-weight:normal;">' . $_SESSION['username'] . '</em></span><br/>';
        $msg .= '<span><strong>Date:</strong> <em style="font-weight:normal;">' . date('d.m.Y H:i'). '</em></span><br/>';
        $msg .= '<hr/>';
        return $msg;
    }

    public function error_query(){
        return self::$error;
    }

    public function get($type = false) {
        $query = "SELECT " . self::$select . " FROM " . self::$from;

        if (!is_null(self::$join))
            $query = $query . self::$join;
        if (!is_null(self::$where))
            $query = $query . ' WHERE ' . self::$where;
        if (!is_null(self::$group_by))
            $query = $query . " GROUP BY " . self::$group_by;
        if (!is_null(self::$having))
            $query = $query . " HAVING " . self::$having;
        if (!is_null(self::$order_by))
            $query = $query . " ORDER BY " . self::$order_by;

        $query = $query . ' LIMIT 1';

        if (self::$print) {
            echo $query;
            die();
        }

        return ($type == true) ? self::query($query, false, true) : self::query($query, false, false);
    }

    public function getAll($type = false) {
        $query = "SELECT " . self::$select . " FROM " . self::$from;

        if (!is_null(self::$join))
            $query = $query . self::$join;
        if (!is_null(self::$where))
            $query = $query . ' WHERE ' . self::$where;
        if (!is_null(self::$group_by))
            $query = $query . " GROUP BY " . self::$group_by;
        if (!is_null(self::$having))
            $query = $query . " HAVING " . self::$having;
        if (!is_null(self::$order_by))
            $query = $query . " ORDER BY " . self::$order_by;

        $query = (!is_null(self::$limit)) ? $query . "  LIMIT " . self::$limit : $query;



        if (self::$print) {
            echo $query;
            die();
        }

        return ($type == 'array') ? self::query($query, true, true) : self::query($query, true, false);
    }

    public function insert($data, $print = false) {
        if (is_array($data)) {
            $columns = array_keys($data);
            $column = implode(',', $columns);
            $val = implode(",", array_map(array($this, 'escape'), $data));
        } else {
            $params = func_get_args();
            $column = $val = null;
            $allParams = count($params) - 1;
            foreach ($params as $NO => $param) {
                $split = explode('=', $param, 2);
                if ($allParams == $NO) {
                    $column .= $split[0];
                    $val .= self::escape($split[1]);
                } else {
                    $column .= $split[0] . ',';
                    $val .= self::escape($split[1]) . ',';
                }
            }
        }

        $query = 'INSERT INTO ' . self::$from . ' (' . $column . ') VALUES (' . $val . ')';

        if ($print == true)
            return $query;
        else {
            $query = self::query($query);
            if ($query) {
                self::$insert_id = self::$pdo->lastInsertId();
                return self::insertId();
            }
        }
    }

    public function update($data, $print = false) {
        $query = "UPDATE " . self::$from . " SET ";

        if (is_array($data)) {
            $values = array();
            foreach ($data as $column => $val)
                $values[] = $column . "=" . self::escape($val);
            $query = $query . (is_array($data) ? implode(', ', $values) : $data);
        } else {
            $params = func_get_args();
            $val = null;
            $allParams = count($params) - 1;
            foreach ($params as $NO => $param) {
                $split = explode('=', $param, 2);
                if ($allParams == $NO)
                    $val .= $split[0] . '=' . self::escape($split[1]);
                else
                    $val .= $split[0] . '=' . self::escape($split[1]) . ', ';
            }
            $query = $query . $val;
        }

        if (!is_null(self::$where))
            $query = $query . ' WHERE ' . self::$where;
        if (!is_null(self::$order_by))
            $query = $query . " ORDER BY " . self::$order_by;

        $query = (!is_null(self::$limit)) ? $query . "  LIMIT " . self::$limit : $query;

        return ($print == true) ? $query : self::query($query);
    }

    public function delete($print = false) {
        $query = "DELETE FROM " . self::$from;

        if (!is_null(self::$where)) {
            $query = $query . ' WHERE ' . self::$where;
            if (!is_null(self::$order_by))
                $query = $query . " ORDER BY " . self::$order_by;

            $query = (!is_null(self::$limit)) ? $query . "  LIMIT " . self::$limit : $query;
        }
        else
            $query = 'TRUNCATE TABLE ' . self::$from;

        return ($print == true) ? $query : self::query($query);
    }

    public function query($query, $all = true, $array = false) {
        self::instanceControl();

        self::reset();
        self::$query = preg_replace('/\s\s+|\t\t+/', ' ', trim($query));
        $str = stristr(self::$query, 'SELECT');

        self::$array_mode = $array;

        $cache = self::readCache(self::$query);

        if (!$cache && $str) {

            if ($array == false)
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            try {
                $sql =  ($all) ? self::$pdo->query(self::$query):self::$pdo->query(self::$query)->fetch();
            } catch (PDOException $e ) {
                self::$cache = null;
                self::$error = self::$pdo->errorInfo();
                self::$error = self::$error[2];
                return self::error();
            }

            if ($sql) {
                self::$num_rows = ($all)?$sql->rowCount():count($sql);

                if ((self::$num_rows > 0)) {
                    self::$result = $sql;
                }

                if (!is_null(self::$cache)){
                    self::saveCache(self::$query, $sql->fetchAll(\PDO::FETCH_BOTH));
                    self::$result = self::readCache(self::$query);
                }

                self::$cache = null;
            }else{
                return 0;
            }
            
        } elseif ((!$cache && !$str) || ($cache && !$str)) {
            self::$cache = null;
            self::$result = self::$pdo->query(self::$query);
            if (!self::$result) {
                self::$error = self::$pdo->errorInfo();
                self::$error = self::$error[2];
                return false;
            }
        } else {
            self::$cache = null;
            self::$result = $cache;
        }

        self::$queryCount++;

        return self::$result;
    }

    public function cache($cache = 0) {
        self::$cache = $cache;
        return new self;
    }

    private function saveCache($sql, $result) {
        if (is_null(self::$cache))
            return false;

        $name = md5($sql);
        $finish = time() + (self::$cache * 60);
        $file = ROOT . '/storage/cache/sql/' . $name . '.cache';
        $file = fopen(str_replace('//', '/', $file), 'w');

        if ($file)
            fputs($file, serialize(array('data' => $result, 'finish' => $finish)));
    }

    private function readCache($sql) {
        if (is_null(self::$cache))
            return false;

        $name = md5($sql);
        $file = ROOT . '/storage/cache/sql/' . $name . '.cache';
        $file = str_replace('//', '/', $file);

        if (file_exists($file)) {
            $cache = unserialize(file_get_contents($file));

            if ($cache['finish'] < time()) {
                unlink($file);
                return;
            }
            else{
                $data = $cache['data'];

                if(!self::$array_mode){
                    $data = self::arrayToObject($data);
                }

                return $data;
            }
        }
    }

    private function arrayToObject($d) {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map([__CLASS__, __METHOD__], $d);
        }
        else {
            // Return object
            return $d;
        }
    }

    public function reset() {
        self::$select = '*';
        self::$from = null;
        self::$where = null;
        self::$limit = null;
        self::$order_by = null;
        self::$group_by = null;
        self::$having = null;
        self::$join = null;
        self::$num_rows = 0;
        self::$insert_id = null;
        self::$query = null;
        self::$error = null;
        self::$result = array();
        self::$prefix = null;
    }

    public function escape($data) {
        $data = trim($data);
        return self::$pdo->quote($data);
    }

    private function instanceControl() {
        if (is_null(self::$instance))
            self::getInstance();
    }

    function __destruct() {
        self::$db = null;
    }

}
