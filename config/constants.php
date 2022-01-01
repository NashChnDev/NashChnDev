<?php

return ['dropdowns'=>[
    'readonly'=>['soap_masterurl'=>'SOAP_URL',
                 'soap_username'=>'SOAP_USERNAME',
                 'soap_password'=>'SOAP_PASSWORD'
                ]
    ],
    'options_from_db'=>['Department'=>'Departments','CostCenterCode'=>'Costcenter','CostCenterTitle'=>'Costtitle',
    'MaritalStatus'=>'maritalstatus',
    'BloodGroup'=>'bloodgroup',
    'Education'=>'education',
    'Trade'=>'trade',
    'Designation'=>'designation',
    'Grade'=>'grade',
    'Function'=>'functions'
    ],
    'pagination_for_select'=>5,
    'crud_permissions'=>[['key'=>'Company Master','value'=>'companies'],
    ['key'=>'Plant Master','value'=>'plants'],
    ['key'=>'Department Master','value'=>'departments'],
    ['key'=>'Employee Master','value'=>'employees'],
    ['key'=>'Area Master','value'=>'area'],
    ['key'=>'sub_area Master','value'=>'sub_area'],
    ['key'=>'Users Master','value'=>'users'],
    ['key'=>'Roles Master','value'=>'roles']

// return [
//     'options_from_db'=>['Vendor_Types'=>'Vendor Types',
//                         'Customer_Types'=>'Customer Types',
//                         'Request_Reason'=>'Request Reason',
//                         'Gauge_Statuses'=>'Gauge Statuses',
//                         //'Usage_Types'=>'UsageTypes',
//                         'UOM'=>'UOM',
//                         'devices_description'=>'devices_description',
//                         'Devices_Type'=>'Devices_Type',
//                         'Devices_Catagory'=>'Devices_Catagory',
//                         'Devices_Property'=>'Devices_Property',
//                         'Devices_Mechanism'=>'Devices_Mechanism',
//                         'Usage_Location'=>'Usage_Location',],
//                        // 'Gauge_Req_Location'=>'Gauge_Req_Location'],
// 	'keyvalue'=>['Gauge_Request_Number'],
//     'role_permission_Master'=>[
// ['key'=>'Company Master','value'=>'companies'],['key'=>'Plant Master','value'=>'plants'],
// ['key'=>'Department Master','value'=>'departments'],['key'=>'Employee Master','value'=>'employees'],
// ['key'=>'Area Master','value'=>'area'],
// ['key'=>'sub_area Master','value'=>'sub_area'],
// ['key'=>'Users Master','value'=>'users'],['key'=>'Roles Master','value'=>'roles']
],

        'screen_permissions'=>[
                
            ]
]


// 'role_permission_Transaction'=>[
// ['key'=>'create Device Request','value'=>'create_devReq'],
// ['key'=>'Edit Device Request','value'=>'edit_devReq'],
// ['key'=>'View Device Request','value'=>'view_devReq'],
// ['key'=>'Delete Device Request','value'=>'delete_devReq'],
// ['key'=>'Device Issue','value'=>'devIssue'],
// ['key'=>'Device Return','value'=>'devReturn'],
// ['key'=>'Create Calibration Request','value'=>'create_caliReq'],
// ['key'=>'Edit Calibration Request','value'=>'edit_caliReq'],
// ['key'=>'View Calibration Request','value'=>'view_caliReq'],
// ['key'=>'Delete Calibration Request','value'=>'delete_caliReq'],
// ['key'=>'Calibration Issue','value'=>'caliIssue'],
// ['key'=>'Calibration Receipt','value'=>'caliReceipt'],
// ['key'=>'Calibration Billing','value'=>'caliBilling'],
// ['key'=>'Create Scrap Request','value'=>'create_scrapReq'],
// ['key'=>'Edit Scrap Request','value'=>'edit_scrapReq'],
// ['key'=>'View Scrap Request','value'=>'view_scrapReq'],
// ['key'=>'Delete Scrap Request','value'=>'delete_scrapReq'],
// ['key'=>'Scrap Approval','value'=>'scrapApproval'],
// ['key'=>'Activity Report','value'=>'activityReport'],
// ['key'=>'Log Report','value'=>'logReport']
// ],
// 'role_permission_joininer'=>[
//     ['key'=>'Company Master','value'=>'companies'],
//     ['key'=>'Plant Master','value'=>'plants'],
//     ['key'=>'Department Master','value'=>'departments'],
//     ['key'=>'Employee Master','value'=>'employees'],
//     ['key'=>'Area Master','value'=>'area'],
//     ['key'=>'sub_area Master','value'=>'sub_area'],
//     ['key'=>'Users Master','value'=>'users'],
//     ['key'=>'Roles Master','value'=>'roles']
//     ],
    
// 'mailsms'=>['Alert Mail - To' =>'mailto','Alert Mail - CC' =>'mailcc','Alert Mail - BCC' =>'mailbcc'],
// 'expirealertmail'=>['Escalation Mail - To' =>'escalationmailto','Escalation Mail - CC' =>'escalationmailcc','Escalation Mail - BCC' =>'escalationmailbcc'],
// 'alertsms'=>['Alert SMS No' =>'alertsms'],
// 'expirealertsms'=>['Escalation Alert SMS No' =>'escalationalertsms']
// ];





//,'Gauge_Issue_Number','Gauge_Return_Number','Scrap_Request_Number']];

?>