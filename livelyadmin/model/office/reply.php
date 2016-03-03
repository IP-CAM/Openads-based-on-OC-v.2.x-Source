<?php
class ModelOfficeReply extends Model {
    public function addReply($data) {
        $fields = array(     
            'date'          => $data['date'],
            'time'          => $data['time'],
            'work_content'  => $data['work_content'],
            'office_id'     => $this->user->getOfficeId(),
            'note'          => strip_tags($data['note']),
            'date_added'    => date('Y-m-d H:i:s')
        );

        return $this->db->insert("office_reply", $fields);
    }
    public function editReply($reply_id, $data) {
        $fields = array(     
            'date'          => $data['date'],
            'time'          => $data['time'],
            'work_content'  => $data['work_content'],
            'office_id'       => $this->user->getOfficeId(),
            'note'          => strip_tags($data['note']),
            'date_added'    => date('Y-m-d H:i:s')
        );

        $this->db->update("office_reply", array('reply_id' => (int)$reply_id),$fields);
        return $reply_id;
    }

    public function deleteReply($reply_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "office_reply WHERE reply_id = '" . (int)$reply_id . "'");
    }

    public function getReply($reply_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "office_reply WHERE reply_id = '" . (int)$reply_id . "'");

        return $query->row;
    }

    public function getReplies($data = array()) {
        $sql = "SELECT o_r.*,u.nickname user FROM " . DB_PREFIX . "office_reply o_r LEFT JOIN ".DB_PREFIX."office_user u ON u.office_id = o_r.office_id ";

        $sort_data = array(
            'o_r.date',
            'o_r.time',
            'o_r.office_id',
            'o_r.date_added',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY o_r.date_added";
        }
        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sql .= " ASC";
        } else {
            $sql .= " DESC";
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

    public function getTotalReplies() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "office_reply");

        return $query->row['total'];
    }
}