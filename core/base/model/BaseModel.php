<?php


namespace core\base\model;


use core\base\controller\Singleton;
use core\base\exceptions\DbException;

class BaseModel
{

        use Singleton;

        protected $db;

         private function __construct()
         {
            $this->db = @new \mysqli(HOST,USER,PASSWORD,DB_NAME);

            if ($this->db->connect_errno){
                throw new DbException("Ошибка подключения к базе ". $this->db->connect_errno . ' | ' . $this->db->connect_error );
            }

            $this->db->query("SET NAMES UTF8");

         }

         final public function query($query, $crud = 'r', $return_id = false){

             $result = $this->db->query($query);

             if ($this->db->affected_rows === -1){
                 throw new DbException('Ошибка в SQL запросе - ' . $query . ' - ' . $this->db->errno . ' ' . $this->db->error );
             }

             switch ($crud){
                 case 'r':
                     if ($result->num_rows){
                         $res = [];

                         for ($i = 0; $i < $result->num_rows; $i++){
                             $res[] = $result->fetch_assoc();
                         }
                         return $res;
                     }
                     return false;
                 case 'c':

                     if($return_id){
                         return $this->db->insert_id;
                     }

                     return true;
                 default:
                     return true;

             }

         }

        /**
         * @param $table
         * @param array $set
         * 'fields'=>['id','name'],
         * 'where' => ['id' => 1, 'name' => 'Masha'],
         * 'operand' => ['=','<>'],
         * 'condition' => ['AND'],
         * 'order' => ['fio','name'],
         * 'order_direction' => ['ACS','DESC'],
         * 'limit' => '1',
         */

         final public function get($table,$set=[]){

            $fields = $this->createFields($table,$set);
            $where = $this->createWhere($table,$set);

            $join_arr =  $this->createJoin($table,$set);
            $fields .= $join_arr['fields'];
            $join = $join_arr['join'];
            $fields .= $join_arr['where'];

            $fields = rtrim($fields,',');

            $order = $this->createOrder($table,$set);

            $limit = $set['limit'] ?? '';

            $query = "SELECT $fields FROM $table $join $where $order $limit";

            return $this->query($query);
         }

         protected function createFields($table = false, $set){

             $set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ?? ['*'];

             $table = $table ? $table . '.' : '';

             $fields =  '';

             foreach ($set['fields'] as $field){
                $fields .= $table . $field . ',';
             }

             return $fields;
         }

         protected function createOrder($table = false, $set){

             $table = $table ? $table . ',' : '';

             $order_by = '';

              if(is_array($set['order']) && !empty($set['order'])){
                  $set['order_direction'] = (is_array($set['order_direction']) && !empty($set['order_direction'])) ?? ['ASC'];

                  $order_by = 'ORDER BY ';
                  $direct_count = 0;

                  foreach ($set['order'] as $order){
                    if($set['order_direction'][$direct_count]){
                        $order_direction = strtoupper($set['order_direction'][$direct_count]) ;
                        $direct_count++;
                    }else{
                        $order_direction = strtoupper($set['order_direction'][$direct_count-1]) ;
                    }

                      $order_by .= $table . $order . ' ' . $order_direction . ',';

                  }

                  $order_by = rtrim($order_by,',');

              }
              return $order_by;


         }
}