<?php

/*
 *
 * @author  murat koker <muratkoker@live.com>
 *
 *
 * @version 2.0
 */

class Datatable {

    private $load;
    protected $table;
    protected $select = "*";
    protected $joins = array();
    protected $columns = array();
    protected $where = null;
    protected $group_by = null;
    protected $filtered = false;
    protected $add_columns = array();
    protected $edit_columns = array();
    protected $unset_columns = array();
    protected $ignore;

    function __construct() {
        $this->load = Load::getInstance();
        $this->db = Sql::getInstance();
    }

    function __get($name) {
        return $this->load->$name;
    }

    public function select($columns) {
        foreach ($this->explode(',', $columns) as $val) {
            $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
            $this->columns[] = $column;
            @$this->select[$column] = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));
        }
        $this->db->select($columns);
        return $this;
    }

    public function from($table) {
        $this->table = $table;
        $this->db->from($table);
        return $this;
    }

    public function orderBy($order_by, $order_dir = null){
        $this->db->orderBy($order_by, $order_dir);

        return $this;
    }

    public function cache($cache = 0) {
        if($cache > 0)
            $this->db->cache($cache);
        return $this;
    }

    public function join($table, $fk, $fk2) {
        $this->joins[] = array($table, $fk, $fk2);
        $this->db->join($table, $fk, $fk2);
        return $this;
    }

    public function leftJoin($table, $fk, $fk2) {
        $this->joins[] = array($table, $fk, $fk2);
        $this->db->leftJoin($table, $fk, $fk2);
        return $this;
    }

    public function where($key_condition) {

        if(strpos($this->where, $key_condition) === false){
            $this->where .= $key_condition;
            $this->db->where($this->where);
        }

        return $this;
    }

    public function groupBy($key_condition) {
        $this->group_by = $key_condition;
        $this->db->groupBy($this->group_by);
        return $this;
    }

    public function ignore($ignore) {
        $this->ignore = $ignore;
        return $this;
    }

    public function add_column($column, $content, $match_replacement = NULL) {
        $this->add_columns[$column] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        return $this;
    }

    public function edit_column($column, $content, $match_replacement) {
        $this->edit_columns[$column][] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        return $this;
    }

    public function unsetColumn($column) {
        $this->unset_columns[] = $column;
        return $this;
    }

    public function generate($charset = 'utf-8') {
        $this->getPaging();
        $this->getOrdering();
        $this->getFiltering();
        return $this->produceOutput($charset);
    }

    protected function getPaging() {
        $iStart = $_POST['iDisplayStart'];
        $iLength = $_POST['iDisplayLength'];
        $start = ($iStart) ? $iStart : 0;
        $end = ($iLength != '' && $iLength != '-1') ? $iLength : 10;
        $this->db->limit($start, $end);
    }

    protected function getOrdering() {
        if ($_POST['sColumns'])
            $mColArray = explode(',', $_POST['sColumns']);
        else
            $mColArray = $this->columns;

        $mColArray = array_values(array_diff($mColArray, $this->unset_columns));
        $columns = array_values(array_diff($this->columns, $this->unset_columns));

        for ($i = 0; $i < intval($_POST['iSortingCols']); $i++)
            if (isset($mColArray[intval($_POST['iSortCol_' . $i])]) && in_array($mColArray[intval($_POST['iSortCol_' . $i])], $columns) && $_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == 'true')
                $this->db->orderBy($mColArray[intval($_POST['iSortCol_' . $i])], $_POST['sSortDir_' . $i]);
    }

    protected function getFiltering() {

        $sWhere = "";

        //$_POST['sSearch_1'] = 'mu';
        //$_POST['sSearch_2'] = 'k00';


        $search_mode = false;
        for ($i = 0; $i < count($this->columns); $i++) {
            if(@$_POST["sSearch_". $i] != ""){
                $search_mode = true;
            }
        }

        if ((isset($_POST['sSearch']) && $_POST['sSearch'] != "") || $search_mode == true) {

            $this->filtered = true;

            $sWhere = " (";
            for ($i = 0; $i < count($this->columns); $i++) {
                $str = stristr($this->columns[$i], $this->ignore);

                if (!$str){
                    if($_POST['sSearch'] != ""){
                        $sWhere .= "" . $this->columns[$i] . " LIKE '%" . $_POST['sSearch'] . "%' OR ";
                    }else{
                       if(@$_POST['sSearch_'.$i] != ""){
                           $sWhere .= "" . $this->columns[$i] . " LIKE '%" . $_POST['sSearch_'.$i] . "%' OR ";
                       }
                    }
                }

            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ') ';

            for ($i = 0; $i < count($this->columns); $i++) {
                if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == "true" && $_POST['sSearch_' . $i] != '') {
                    if ($sWhere == "") {
                        $sWhere = " ";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $str = stristr($this->columns[$i], $this->ignore);
                    if (!$str)
                        $sWhere .= "" . $this->columns[$i] . " LIKE '%" . $_POST['sSearch_' . $i] . "%' ";
                }
            }

            if($this->where != null){
                $this->where(' AND ' . $sWhere);
            }else{
                $this->where($sWhere);
            }

        }

    }

    protected function getDisplayResult() {
        return $this->db->getAll('array');
        //return $this->db->print_mode(true)->getAll();
    }

    protected function produceOutput($charset) {
        $aaData = array();
        $rResult = $this->getDisplayResult();
        $iTotal = 0;
        $iFilteredTotal = $this->getTotalResults(false);

                
        foreach ($rResult as $row_key => $row_val) {     
            
            $aaData[$row_key] = $row_val;

            foreach ($this->add_columns as $field => $val)
                if ($this->check_mDataprop())
                    $aaData[$row_key][$field] = $this->execReplace($val, $aaData[$row_key]);
                else
                    $aaData[$row_key][] = $this->execReplace($val, $aaData[$row_key]);

                                
            foreach ($this->edit_columns as $modkey => $modval)
                foreach ($modval as $val)
                    $aaData[$row_key][($this->check_mDataprop()) ? $modkey : array_search($modkey, $this->columns)] = $this->execReplace($val, $aaData[$row_key]);

            $aaData[$row_key] = array_diff_key($aaData[$row_key], ($this->check_mDataprop()) ? $this->unset_columns : array_intersect($this->columns, $this->unset_columns));
        }
                                

        $sColumns = array_diff($this->columns, $this->unset_columns);
        $sColumns = array_merge_recursive($sColumns, array_keys($this->add_columns));

        $sOutput = array(
            'sEcho' => intval($_POST['sEcho']),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => $aaData,
            'sColumns' => implode(',', $sColumns)
        );

                      
        if (strtolower($charset) == 'utf-8')
            return json_encode($sOutput);
        else
            return $this->jsonify($sOutput);
    }

    protected function getTotalResults($filter = false) {
        if ($this->filtered)
            $this->getFiltering();

        if (!is_null($this->group_by))
            $this->db->groupBy($this->group_by);

        if ((isset($this->joins)))
            foreach ($this->joins as $val)
                $this->db->leftJoin($val[0], $val[1], $val[2]);

        if (is_null($this->where))
            $x = $this->db->select('COUNT(*) as total')->from($this->table)->print_mode(false)->get();
        else
            $x = $this->db->select('COUNT(*) as total')->from($this->table)->where($this->where)->print_mode(false)->get();


        return $x->total;
    }

    protected function execReplace($custom_val, $row_data) {
        $replace_string = '';

        if (isset($custom_val['replacement']) && is_array($custom_val['replacement'])) {
            foreach ($custom_val['replacement'] as $key => $val) {
                $sval = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($val));
                if (preg_match('/(\w+)\((.*)\)/i', $val, $matches) && function_exists($matches[1])) {
                    $func = $matches[1];
                    $args = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[,]+/", $matches[2], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                    foreach ($args as $args_key => $args_val) {
                        $args_val = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($args_val));
                        $args[$args_key] = (in_array($args_val, $this->columns)) ? ($row_data[($this->check_mDataprop()) ? $args_val : array_search($args_val, $this->columns)]) : $args_val;
                    }

                    $replace_string = call_user_func_array($func, $args);
                } elseif (in_array($sval, $this->columns))
                    $replace_string = $row_data[($this->check_mDataprop()) ? $sval : array_search($sval, $this->columns)];
                else
                    $replace_string = $sval;

                $custom_val['content'] = str_ireplace('$' . ($key + 1), $replace_string, $custom_val['content']);
            }
        }

        return $custom_val['content'];
    }

    protected function check_mDataprop() {
        if (!$_POST['mDataProp_0'])
            return FALSE;

        for ($i = 0; $i < intval($_POST['iColumns']); $i++)
            if (!is_numeric($_POST['mDataProp_' . $i]))
                return TRUE;

        return FALSE;
    }

    protected function get_mDataprop() {
        $mDataProp = array();

        for ($i = 0; $i < intval($_POST['iColumns']); $i++)
            $mDataProp[] = $_POST['mDataProp_' . $i];

        return $mDataProp;
    }

    protected function balanceChars($str, $open, $close) {
        $openCount = substr_count($str, $open);
        $closeCount = substr_count($str, $close);
        $retval = $openCount - $closeCount;
        return $retval;
    }

    protected function explode($delimiter, $str, $open = '(', $close = ')') {
        $retval = array();
        $hold = array();
        $balance = 0;
        $parts = explode($delimiter, $str);

        foreach ($parts as $part) {
            $hold[] = $part;
            $balance += $this->balanceChars($part, $open, $close);
            if ($balance < 1) {
                $retval[] = implode($delimiter, $hold);
                $hold = array();
                $balance = 0;
            }
        }

        if (count($hold) > 0)
            $retval[] = implode($delimiter, $hold);

        return $retval;
    }

    protected function jsonify($result = FALSE) {
        if (is_null($result))
            return 'null';
        if ($result === FALSE)
            return 'false';
        if ($result === TRUE)
            return 'true';

        if (is_scalar($result)) {
            if (is_float($result))
                return floatval(str_replace(',', '.', strval($result)));

            if (is_string($result)) {
                static $jsonReplaces = array(array('\\', '/', '\n', '\t', '\r', '\b', '\f', '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $result) . '"';
            }
            else
                return $result;
        }

        $isList = TRUE;

        for ($i = 0, reset($result); $i < count($result); $i++, next($result)) {
            if (key($result) !== $i) {
                $isList = FALSE;
                break;
            }
        }

        $json = array();

        if ($isList) {
            foreach ($result as $value)
                $json[] = $this->jsonify($value);

            return '[' . join(',', $json) . ']';
        } else {
            foreach ($result as $key => $value)
                $json[] = $this->jsonify($key) . ':' . $this->jsonify($value);

            return '{' . join(',', $json) . '}';
        }
    }

    function __destruct() {
        unset($this->select);
        unset($this->joins);
        unset($this->columns);
        unset($this->where);
        unset($this->group_by);
        unset($this->filtered);
    }

}
