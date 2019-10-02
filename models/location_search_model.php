<?php 

class location_search_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function location_all()
    {
        return $this->db->selectAll("SELECT * FROM `view_location_all`");
    }
    public function findPermission()//หาว่าแต่ละหมายเลขถูกแชร์ให้ใครบ้าง
    {
        return $this->db->selectAll("SELECT * FROM
        data_owner LEFT JOIN
        (		SELECT data_shared.id_member_owner AS idM, group_concat(data_shared.id_member_shared  SEPARATOR ',') AS ownerSH  , data_shared.accession_number AS shareAcc    
                FROM
                (	SELECT max(data_shared.id_data_shared)AS max_id,data_shared.id_member_owner FROM data_shared 
                        GROUP BY data_shared.accession_number,data_shared.id_member_shared,data_shared.id_member_owner
                ) r 
                LEFT JOIN 
                data_shared ON data_shared.id_data_shared = r.max_id AND data_shared.status_sh!='Unshared'
                GROUP BY  data_shared.accession_number,data_shared.id_member_owner
        )AS R2 ON data_owner.id_member = R2.idM AND data_owner.accession_number = R2.shareAcc
        LEFT JOIN member ON member.id_member = data_owner.id_member");     
    }
    
}


// "SELECT data_shared.id_member_owner, group_concat(data_shared.id_member_shared  SEPARATOR ',') AS id_member_shared       ,data_shared.accession_number,data_shared.id_fact_tomato,data_shared.date_shared
//         ,member.username,member.firstname,member.lastname,member.email
//         FROM
//             (	SELECT max(data_shared.id_data_shared)AS max_id FROM data_shared 
//                  GROUP BY data_shared.accession_number,data_shared.id_member_shared
//             ) r
//             INNER JOIN 
//             data_shared ON data_shared.id_data_shared = r.max_id AND data_shared.status_sh!='Unshared'
//             LEFT JOIN member ON data_shared.id_member_owner = member.id_member
//             GROUP BY accession_number"