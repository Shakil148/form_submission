<?php 
class Validation {
    public function validator($data){
        $message = "";
        $message .= ( empty($data['amount'])) ? "amount shouldn't be null. " : (is_numeric($data['amount']) ? '' : 'Amount field should be numeric. ');
        $message .= ( empty($data['buyer'])) ? "buyer should not be null. ": (strlen($data['buyer']) > 20 ? 'Buyer field should not be more than 20 chars. ' : '');
        $message .= ( empty($data['receipt_id'])) ? 'receipt id should not be null. ' : '';
        $message .= ( empty($data['items'])) ? 'items should not be null. ' : '';
        $message .= ( empty($data['buyer_email'])) ? 'buyer email should not be null. ' : (filter_var($data['buyer_email'], FILTER_VALIDATE_EMAIL) ? '' : 'Invalid buyer email. ');
        $message .= ( empty($data['note'])) ? 'note should not be null. ' : (str_word_count($data['buyer_email']) > 30 ? 'Note field should not be more than 30 words. ' : '');
        $message .= ( empty($data['city'])) ? "city should not be null. ": (strlen($data['city']) > 20 ? 'City field should not be more than 20 chars. ' : '');
        $message .= ( empty($data['phone'])) ? "phone shouldn't be null. " : (is_numeric($data['phone']) ? '' : 'Phone field should be numeric. ');
        $message .= ( empty($data['entry_by'])) ? "entry by shouldn't be null. " : (is_numeric($data['entry_by']) ? '' : 'Entry by field should be numeric. ');
        
        if(empty($message)){
            return ['resp_code' => 0, 'code'=> 200, 'message' => 'ok'];
        }else{
            return ['resp_code' => 1, 'code'=> 422, 'message' => $message];
        }
    }

    public function searchValidator($data){
        $message = "";
        $message .= (empty($data['from_date'])) ? "From date is required.<br />" : "" ;
        $message .= (empty($data['to_date'])) ? " To date is required. " : "" ;
        $message .= (empty($data['entry_by'])) ? "Entry is required. " : "" ;

        if(empty($message)){
            return ['resp_code' => 0, 'code'=> 422, 'message' => ''];
        }else{
            return ['resp_code' => 1, 'code'=> 200, 'message' => $message];
        }
    }
}