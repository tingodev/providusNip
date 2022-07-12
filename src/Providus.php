<?php
namespace TrillzGlobal\ProvidusNip;
use TrillzGlobal\ProvidusNip\ResponseCode as Response;

class Providus extends Response{
    
    var $base_url = "";
    var $username = "";
    var $password = "";
	var $load;

    public function __construct($base_url, $username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->base_url = $base_url;
    }

    private function api_call($data, $endpoint){
        $payload = json_encode($data);
	$this->load = $payload;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url.$endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        if(!empty($data)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);
        
       
	    return $response;
    }

    public function verifyAccount($data){
        $endpoint = "GetNIPAccount";
        $payload = ["accountNumber"=>$data["accountNumber"], 
                    "beneficiaryBank"=>$data["bankCode"], 
                    "userName"=>$this->username,
                    "password"=>$this->password];
                
        return $this->api_call($payload, $endpoint);
        
    }

    public function getBankList(){
        $endpoint = "GetNIPBanks";
        
        return $this->api_call("", $endpoint);
    }

    public function transferFund($data){
        $endpoint = "NIPFundTransfer";
        $payload = ["beneficiaryAccountNumber"=>$data['accountNumber'], 
                    "beneficiaryBank"=>$data['bankCode'], 
                    "beneficiaryAccountName"=>$data["name"],
                    "transactionAmount"=>$data["amount"],
                    "narration"=>$data["narration"],
                    "sourceAccountName"=>$data["sourceAccountName"],
                    "transactionReference"=>$data["ref"],
                    "currencyCode"=>"NGN",
                    "userName"=>$this->username,
                    "password"=>$this->password];
        
        $response = $this->api_call($payload, $endpoint);
        $response = json_decode($response, true);
        if(is_array($response)){
            $responseCode =  new Response($response["responseCode"]);
            if($responseCode->status){
                $response["status"] = $responseCode->status;
                $response["message"] = $responseCode->message;
            }
           
        }
        $response["status"] = "pending";
        $response["message"] = "Response not Certain";
        $output = json_encode($response);
        return $output;
    }

    public function accountBalance($data){
        $endpoint = "GetProvidusAccount";
        $payload = ["AccountNumber"=>$data["accountNumber"],
                    "userName"=>$this->username,
                    "password"=>$this->password];
        return $this->api_call($payload, $endpoint);
    }

    public function confirmTransaction($data){
        $endpoint = "GetProvidusTransactionStatus";
        $payload = ["transactionReference"=>$data["reference"], 
                    "userName"=>$this->username,
                    "password"=>$this->password];
        return $this->api_call($payload, $endpoint);

    }
}