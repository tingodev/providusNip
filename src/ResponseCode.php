<?php 

namespace TrillzGlobal\ProvidusNip;

class ResponseCode{

    var $message ="";
    var $status ="";

    public function __construct($code)
    {
            
            $array= [
            
                "success"=>[
                    "00"=>"Approved or completed successfully"
                ],
                "pending"=>[
                    "06"=>"Dormant Account",
                    "09"=>"Request Processing In Progress",
                    "11"=>"Reversal Not Successful",
                    "12"=>"Invalid Transaction",
                    "14"=>"Invalid Batch Number",
                    "15"=> "Invalid Session or Record ID",
                    "17"=>"Invalid Channel",
                    "18"=>"Wrong Method Call",
                    "25"=>"Unable to Locate Record",
                    "31"=>"Reserval Success",
                    "34"=>"Suspected Fraud",
                    "35"=>"Contact Sending Bank",
                    "36"=>"Transfer Success",
                    "51"=>"No Sufficeint Funds",
                    "68"=>"Response Received Tool Late",
                    "69"=>"Customer Details no Successfully Validate",
                    "70"=>"Notification not succcessfully received",
                    "8004"=>"Authentication Failed",
                    "8003"=>"No Connection",
                    "909"=>"Unknown_NFPCall_Response",
                    "919"=>"NULL_NFPCall_Response",
                    "999"=>"Loca Defined Timeout",
                    "9999"=>"NIP Authentication Failed",
                    "7706"=>"Invalid Transaction Amount",
                    "8803"=>"No Connection"
                ],
                "failed"=>[
                    "03"=>"Invalid Sender",
                    "05"=>"Do Not Honor",
                    "07"=>"Invalid Account",
                    "08"=>"Account Name Mismatch",
                    "13"=>"Invalid Amount",
                    "16"=>"Unknown Bank Code",
                    "21"=>"No Action Taken",
                    "26"=>"Duplicate Record",
                    "30"=>"Format Error",
                    "32"=>"Transfer Not Successful",
                    "505"=>"Service Unavailable",
                    "57"=>"Transaction Not Permitted To Sender",
                    "58"=>"Transaction Not Permitted To Channel",
                    "61"=>"Transfer Limit Exceeded",
                    "63"=>"Security Violation",
                    "65"=>"Exceed Withdrawal Frequency",
                    "7701"=>"Debit Accounts Is Invalid",
                    "7709"=>"Transaction Reference Exits",
                    "8005"=>"Method Not Allowed",
                    "8888"=>"Credit Account Not Permitted",
                    "91"=>"Beneficiary Bank Not Available",
                    "92"=>"Routing Error",
                    "94"=>"Duplicate Transaction",
                    "96"=>"System Malfunction",
                    "97"=>"Time Out Waiting For Response From Destination",
                    "01"=>"Transaction Does not Exist",
                ]
            ];

            foreach ($array as $key=>$value ) {
               foreach($value as $key2 => $val){
                if($key2 == $code){
                    	$this->status = $key;
                        $this->message = $val;
                        break;
                }
               }
            }
            
         }
    
}