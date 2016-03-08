<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Model extends CI_Model {
      
    // Count all record of table "contact_info" in database.
        public function record_count() 
        {
            return $this->db->count_all("pasien");
        }
    
    // Fetch data according to per_page limit.
    public function fetch_data($limit, $id_pasien) {
        $this->db->limit($limit);
        $this->db->where('id_pasien', $id_pasien);
        $query = $this->db->get("pasien");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
         
            return $data;
        }
        return false;
   }
}
?>