<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
  
Class Standard_model extends CI_Model
{
    function __construct()
    {
      parent::__construct();      
    }

    private $table = null;
    private $condition = null;
    private $join = null;
    private $right_join = null;
    private $left_join = null;
    private $field = null;
    private $select_as_array = null;
    private $limit = null;
    private $offset = 0;
    private $groupby = null;
    private $order_by = null;
    private $where_in = null;
    private $or_where_in = null;
    private $having = null;
    private $insert_batch = null;
    private $update_batch = null;
    private $database = null;    
    private $like = null;
    private $or_like = null;
    

    /* This function used to set private variables which is required for DB queries*/
    public function set_query_data($data){
        if( count($data) ){
            
            $this->table = ( isset($data['table']) ) ? $data['table'] :  null;
            if($this->table == null){
                return "missing table name";
            }
            $this->condition       = ( isset($data['condition']) ) ? $data['condition'] :  null;
            $this->having       = ( isset($data['having']) ) ? $data['having'] :  null;
            $this->field           = ( isset($data['field']) ) ? $data['field'] :  null;
            $this->select_as_array = ( isset($data['select_as_array']) ) ? $data['select_as_array'] : false;
            $this->join            = ( isset($data['join']) ) ? $data['join'] :  null;
            $this->right_join      = ( isset($data['right_join']) ) ? $data['right_join'] :  null;
            $this->left_join       = ( isset($data['left_join']) ) ? $data['left_join'] :  null;
            $this->groupby         = ( isset($data['group_by'])) ? $data['group_by'] : null;
            $this->order_by        = ( isset($data['order_by'])) ? $data['order_by'] : null;
            $this->limit           = ( isset($data['limit'])) ? $data['limit'] : null;
            $this->offset          = ( isset($data['offset'])) ? $data['offset'] : null;            
            $this->where_in        = ( isset($data['where_in'])) ? $data['where_in'] : null;
            $this->or_where        = ( isset($data['or_where'])) ? $data['or_where'] : null;
            $this->or_where_in     = ( isset($data['or_where_in'])) ? $data['or_where_in'] : null;
            $this->where_not_in    = ( isset($data['where_not_in'])) ? $data['where_not_in'] : null;
            $this->insert_batch    = ( isset($data['insert_batch'])) ? $data['insert_batch'] : null;
            $this->update_batch    = ( isset($data['update_batch'])) ? $data['update_batch'] : null;
            // $this->database        = ( isset($data['database'])) ? $this->load->database($data['database'], true) : $this->load->database('default', true);
            $this->like            = ( isset($data['like'])) ? $data['like'] : null;
            $this->or_like            = ( isset($data['or_like'])) ? $data['or_like'] : null;            
        }
        else{
            return "missing parmeters";
        }
        
    }
    public function select(){
        if( !$this->db->table_exists( $this->table ) )
        {
            return;
        }

        $this->db->select( $this->field )->from( $this->table );
        if( $this->join ){ 
        // Here check for join is set if it is join operation is performed
            foreach ( $this->join as $table_name => $join_condition ) {
                $this->db->join( $table_name , $join_condition);
            }
        }

        if( $this->right_join ){ 
        // Here check for join is set if it is join operation is performed
            foreach ( $this->right_join as $table_name => $join_condition ) {
                $this->db->join( $table_name , $join_condition, 'RIGHT');
            }
        }

        if( $this->left_join ){ 
        // Here check for join is set if it is join operation is performed
            foreach ( $this->left_join as $table_name => $join_condition ) {
                $this->db->join( $table_name , $join_condition, 'LEFT');
            }
        }

        if( $this->condition ){
            // Here check for condition if condition is set where condition is applied
            $this->db->where( $this->condition );
        }

        if($this->or_where){
           
            $this->db->or_where( $this->or_where );
        }

        if($this->where_in){
            //$this->db->where_in( $this->where_in );
             $this->db->where_in( $this->where_in['where_in_field'], $this->where_in['where_in_array'] );
        }

        if($this->or_where_in){
            $this->db->or_where_in( $this->or_where_in['or_where_in_field'], $this->or_where_in['where_in_array'] );
        }
        if($this->where_not_in){
            $this->db->where_not_in( $this->where_not_in['where_not_in_field'], $this->where_not_in['where_not_in_array'] );
        }

        if($this->groupby){
            foreach ( $this->groupby as  $groupby ) {
                $this->db->group_by( $groupby );
            }
            
        }

        if( $this->having ){
          // Here applying condition with having clause
          $this->db->having( $this->having );
        }

        if($this->order_by){
            foreach ( $this->order_by as  $key => $value ) {
                $this->db->order_by( $key, $value );
            }            
        }

        if( $this->limit ){
            // $this->db->limit( $this->limit, $this->offset );
            if (isset($this->offset)) {
                $this->db->limit( $this->limit, $this->offset );
            } else {
                $this->db->limit( $this->limit );
            }
        }
        
        if($this->like) {
            $this->db->like($this->like);
        }
        
        if($this->or_like) {
            $this->db->or_like($this->or_like);
        }
        

        $result = $this->db->get();

        /*Here check for num rows returned by query if num rows <=1 then row() is returned otherwise result is returned*/
        if( $result->num_rows <= 1 ) {
            return $result->row();             
        } else {
            $query_result = null;
            if ($this->select_as_array) {                
                return $result->result_array();
            } else {                
                return $result->result();
            }
            
            return $query_result;
        }
    }
    public function insert( $data = '' ){
        if( $this->insert_batch )
            return $this->db->insert_batch( $this->table , $data); 
        else
            return $this->db->insert( $this->table , $data );
    }

    public function insert_and_id( $data = '' ){
        $status =  $this->db->insert( $this->table , $data );
            if( $status )
                $last_id = $this->db->insert_id();
        return $last_id;
    } 

    public function delete(){
        return $this->db->delete( $this->table , $this->condition );
    }
    public function update( $data ){
        if( $this->update_batch ){
             $this->db->trans_start();
             $this->db->update_batch($this->table , $data, $this->condition ); 
             $this->db->trans_complete();    
             return $this->db->trans_status() ;
        }else{

            if($this->where_not_in){
                $this->db->where_not_in( $this->where_not_in['where_not_in_field'], $this->where_not_in['where_not_in_array']);
            }else if($this->where_in){
                $this->db->where_not_in( $this->where_in['where_in_field'], $this->where_in['where_in_array']);
            }else{

                $this->db->where( $this->condition );
            }
            return $this->db->update( $this->table, $data );
        }
    }
}
?>