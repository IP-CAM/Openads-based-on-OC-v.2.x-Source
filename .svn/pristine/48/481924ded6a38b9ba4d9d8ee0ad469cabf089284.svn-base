<?php
class ModelOfficeMonitor extends Model {

    public function editMonitor($monitor_id, $data) {
        $fields = array(            
            'time_name' => $data['time_name'],
            'price'     => $data['price'],
            'work_hours' => (float)$data['work_hours'],
            'confirm'   => $data['confirm'],
            'user_id'   => $this->user->getId(),
            'note'      => strip_tags($data['note']),
            'date_modified'     => date('Y-m-d H:i:s')
        );
        if(isset($data['work_content_a'])){
            $fields['work_content_a'] = strip_tags($data['work_content_a']);
        }
        if(isset($data['work_content_b'])){
            $fields['work_content_b'] = strip_tags($data['work_content_b']);
        }
        if(isset($data['date'])){
            $fields['date'] = $data['date'];
        }
        $this->db->update("office_monitor", array('monitor_id' => (int)$monitor_id),$fields);
    }

    public function deleteMonitor($monitor_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "office_monitor WHERE monitor_id = '" . (int)$monitor_id . "'");
    }

    public function getMonitor($monitor_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "office_monitor WHERE monitor_id = '" . (int)$monitor_id . "'");

        return $query->row;
    }

    public function getMonitors($data = array()) {
        $sql = "SELECT om.*,ou.nickname office,u.nickname user,(om.price * om.work_hours) AS amount FROM " . DB_PREFIX . "office_monitor om LEFT JOIN ".DB_PREFIX."office_user ou ON ou.office_id = om.office_id LEFT JOIN ".DB_PREFIX."user u ON u.user_id = om.user_id WHERE 1 ";
        $where = array();
        if(isset($data['filter_date_start'])){
            $where[] = " AND DATE(om.date) >= DATE('".$data['filter_date_start']."')";
        }
        if(isset($data['filter_date_end'])){
            $where[] = " AND DATE(om.date) <= DATE('".$data['filter_date_end']."')";
        }
        if(isset($data['filter_time'])){
            $where[] = " AND om.time_id = '".(int)$data['filter_time']."'";
        }
        if(isset($data['filter_office'])){
            $where[] = " AND om.office_id = '".(int)$data['filter_office']."'";
        }
        if(isset($data['filter_user'])){
            $where[] = " AND om.user_id = '".(int)$data['filter_user']."'";
        }
        if(isset($data['filter_confirm'])){
            $where[] = " AND om.confirm = '".(int)$data['filter_confirm']."'";
        }
        if(isset($data['filter_hours'])){
            $where[] = " AND om.work_hours = '".(float)$data['filter_hours']."'";
        }
        if($where){
            $sql .= implode(" ", $where);
        }
        $sort_data = array(
            'date',
            'time_name',
            'office_id',
            'user_id',
            'work_hours',
            'amount',
            'date_added',
            'date_modified',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY date_added";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;

    }

    public function getTotalMonitors($data=array()) {
        $sql = "SELECT COUNT(om.monitor_id) AS total FROM " . DB_PREFIX . "office_monitor om LEFT JOIN ".DB_PREFIX."office_user ou ON ou.office_id = om.office_id LEFT JOIN ".DB_PREFIX."user u ON u.user_id = om.user_id WHERE 1 ";
        $where = array();
        if(isset($data['filter_date_start'])){
            $where[] = " AND DATE(om.date) >= DATE('".$data['filter_date_start']."')";
        }
        if(isset($data['filter_date_end'])){
            $where[] = " AND DATE(om.date) <= DATE('".$data['filter_date_end']."')";
        }
        if(isset($data['filter_time'])){
            $where[] = " AND om.time_id = '".(int)$data['filter_time']."'";
        }
        if(isset($data['filter_office'])){
            $where[] = " AND om.office_id = '".(int)$data['filter_office']."'";
        }
        if(isset($data['filter_user'])){
            $where[] = " AND om.user_id = '".(int)$data['filter_user']."'";
        }
        if(isset($data['filter_confirm'])){
            $where[] = " AND om.confirm = '".(int)$data['filter_confirm']."'";
        }
        if(isset($data['filter_hours'])){
            $where[] = " AND om.work_hours = '".(float)$data['filter_hours']."'";
        }
        if($where){
            $sql .= implode(" ", $where);
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }
}