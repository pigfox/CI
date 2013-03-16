<?php
class Common_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function insert($table, $input)
    {
      foreach($input as $key => $value)
    		 $this->$key = $value;
    		 
    	return $this->db->insert($table, $this);
    }
    
    function getRows($table, $limit, $offset, $orderfield, $order)
		{
			$arr = array();

			if($orderfield != '' &&  $order != '')
				$this->db->order_by($orderfield, $order); 

			if(is_numeric($limit) && is_numeric($offset))			
				$this->db->limit($limit, $offset);

			$query = $this->db->get($table);
			
			if(0 < $query->num_rows())
			{
				foreach($query->result() as $row)
				{
					foreach($row as $key => $value)
						$tmp[$key] = $value;
					
					$arr[] = $tmp;
				}

				return $arr;
			}
		}
		
		function deleteRow($table, $id)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);    
			return $this->db->affected_rows(); 
		}
		
		function getRow($table, $id)
		{
			$arr = array();
			$this->db->where('id', $id);
			$query = $this->db->get($table);   
			
			if(0 < $query->num_rows())
			{
				foreach($query->result() as $row)
				{
					foreach($row as $key => $value)
						$tmp[$key] = $value;
					
					$arr[] = $tmp;
				}

				return $arr[0];
			}
		}  
		
		function getRowByKey($table, $key, $value)
		{
			$arr = array();
			$this->db->where($key, $value);
			$query = $this->db->get($table);   
			
			if(0 < $query->num_rows())
			{
				foreach($query->result() as $row)
				{
					foreach($row as $key => $value)
						$tmp[$key] = $value;
					
					$arr[] = $tmp;
				}

				return $arr[0];
			}
		}                      
		
		function updateRow($table, $input, $id)  
		{							                           
			$this->db->where('id', $id);
			$this->db->update($table, $input); 
			return $this->db->affected_rows(); 
		}	
		
		function updateRowById($table, $input, $key, $value)  
		{							                           
			$this->db->where($key, $value);
			$this->db->update($table, $input); 
			return $this->db->affected_rows(); 
		}	
		
		function countRows($table)
		{
			return $this->db->count_all($table);
		}						   
    
}                         
