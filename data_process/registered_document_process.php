<?php
include("../../config.php");

include("../common_function.php");

$sql = "SELECT reg_id, timestamp, token, owner_name, owner_mobile, owner_dob , alt_owner_name, alt_owner_mobile, alt_owner_dob, tenant_name, tenant_mobile, tenant_dob, alt_tenant_name, alt_tenant_mobile, alt_tenant_dob, agreement_start_date,  agreement_end_date, r1.location AS location, delivery_status, record_status, labels, total_amt, received_amt, (`received_amt` - `total_amt`) AS `amount`, challan_amt, DATEDIFF(`agreement_end_date`, CURDATE()) AS `date_diff`, a1.agent_name AS aname, a1.mobile_no AS amobileno, s1.name AS sname, r1.upload_1, r1.upload_2, r1.upload_3, r1.upload_4, r1.upload_5 FROM registered_document AS r1, staff AS s1, agent AS a1 WHERE r1.`agent_name` = a1.agent_id AND r1.`staff_name` = s1.sid ";

if(isset($_GET['status']) && $_GET['status']){
    $sql = $sql . " AND r1.record_status = '{$_GET['status']}' ";
}

if(isset($_GET['labels']) && $_GET['labels']){
    $sql = $sql . " AND r1.labels = '{$_GET['labels']}' ";
}

if(isset($_GET['staff']) && $_GET['staff']){
    $sql = $sql . " AND r1.staff_name = '{$_GET['staff']}' ";
}

if(isset($_GET['start']) && $_GET['start'] && isset($_GET['end']) && $_GET['end']){
    $start = date("Y-m-d", strtotime($_GET['start']));
    $end = date("Y-m-d", strtotime($_GET['end']));
    $sql = $sql . " AND timestamp between '{$start}' AND '{$end}' ";
}

if(isset($_GET['amt']) && $_GET['amt']){
    if($_GET['amt'] == 'Paid'){
        $sql = $sql . " AND total_amt > 0 HAVING  amount = '0' ";
    } elseif ($_GET['amt'] == 'Balance') {
        $sql = $sql . " AND total_amt > 0 AND received_amt > 0 HAVING  amount > '0' ";
    } else{
        $sql = $sql . " AND total_amt > 0 HAVING  received_amt <= '0' ";
    }
}
$sql = $sql . " ORDER BY `date_diff` ASC, FIELD(`record_status`, 'Active', 'Inactive'), `agreement_end_date` ASC ";

$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
$data = array();
$excelData = array();
$i = 1;
$excelColumns = [
    'sr_no' => 'Sr.No.', 
    'timestamp' => 'Entry Date', 
    'token' => 'Token', 
    'owner_name' => 'Owner Name', 
    'owner_mobile' => 'Owner Mobile', 
    'owner_dob' => 'Owner Birthdate', 
    'alt_owner_name' => 'Alternate Owner Name', 
    'alt_owner_mobile' => 'Alternate Owner Mobile', 
    'alt_owner_dob' => 'Alternate Owner Birthdate', 
    'tenant_name' => 'Tenant Name', 
    'tenant_mobile' => 'Tenant Mobile', 
    'tenant_dob' => 'Tenant Birthdate', 
    'alt_tenant_name' => 'Alternate Tenant Name', 
    'alt_tenant_mobile' => 'Alternate Tenant Mobile', 
    'alt_tenant_dob' => 'Alternate Tenant Birthdate', 
    'sname' => 'Staff Name', 
    'aname' => 'Agent Name', 
    'agreement_start_date' => 'Agreement Start Date', 
    'agreement_end_date' => 'Agreement End Date', 
    'location' => 'Location', 
    'delivery_status' => 'Delivery Status', 
    'record_status' => 'Record Status', 
    'labels' => 'Labels'
];
while( $rows = mysqli_fetch_assoc($resultset) ) {
    $reg_id = $rows['reg_id'];
    $rows['actions'] = "
                        <a href=\"upd_register_document.php?rid={$reg_id}\" class=\"btn btn-sm btn-success\" target=\"_blank\">
                            <i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
                        </a>
                        <a href=\"#\" rid=\"{$reg_id}\" onclick=\"deleteregister($(this).attr('rid'));\" class=\"btn btn-sm btn-danger\" target=\"_blank\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                        </a>";
    $rows['sr_no'] = $i;
    
    $total_amt = $rows['total_amt'];
    $received_amt = $rows['received_amt'];
    $amount = $rows['amount'];

    if(!empty($rows['owner_mobile'])){
        $owner_mobile = $rows['owner_mobile'];
        $rows['owner_mobile'] = "<a href=\"tel:+91{$owner_mobile}\" class=\"\">+91 $owner_mobile</a>
                                 <a target=\"_blank\" href=\"https://wa.me/91{$owner_mobile}\" class=\"text-success\" style=\"vertical-align:middle; text-decoration:none;\"><i class=\"la la-2x la-whatsapp\"></i></a>";
    }

    if(!empty($rows['tenant_mobile'])){
        $tenant_mobile = $rows['tenant_mobile'];
        $rows['tenant_mobile'] = "<a href=\"tel:+91{$tenant_mobile}\" class=\"\">+91 $tenant_mobile</a>
                                  <a target=\"_blank\" href=\"https://wa.me/91{$tenant_mobile}\" class=\"text-success\" style=\"vertical-align:middle; text-decoration:none;\"><i class=\"la la-2x la-whatsapp\"></i></a>";
    }
    
    if(isset($rows['aname']) && $rows['aname']!=''){
        $agent_mobile = $rows['amobileno'];
        $rows['aname'] = "<a href=\"tel:+91{$agent_mobile}\" class=\"\">{$rows['aname']}</a>
                                  <a target=\"_blank\" href=\"https://wa.me/91{$agent_mobile}\" class=\"text-success\" style=\"vertical-align:middle; text-decoration:none;\"><i class=\"la la-2x la-whatsapp\"></i></a>";
    }
    
    /*if($total_amt > 0){
        if($rows['amount'] == 0){
            $rows['amount'] = "<span class=\"badge badge-success\" style=\"font-size: 14px;\">{$total_amt}</span>";
        } elseif ($rows['amount'] > 0 && $received_amt > 0) {
            $rows['amount'] = "<span class=\"badge badge-danger\" style=\"font-size: 14px;\">-{$amount}</span>";
        } else {
            $rows['amount'] = "<span class=\"badge badge-primary\" style=\"font-size: 14px;\">{$amount}</span>";
        }
    } else {
        $rows['amount'] = null;
    }*/
    $rows['amount'] = showProfitBal($rows['amount']);
    $data[] = $rows;

    foreach ($excelColumns as $key => $value) {
        $excelData[$i][$value] = (string)$rows[$key];
    }
    $i++;
}

session_start();
$_SESSION["registered_document_export_columns"] = $excelColumns;
$_SESSION["registered_document_export_data"] = $excelData;
$_SESSION["registered_document_table_data"] = $data;
unset($excelColumns);
unset($excelData);
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData"=>$data
 );
echo json_encode($results);