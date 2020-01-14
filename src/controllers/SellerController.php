<?php

require_once('models/Seller.php');
require_once('controllers/UserController.php');
require_once('validators/SellerCreditcardValidator.php');
require_once('validators/SellerBankValidator.php');

class SellerController
{

    /**
     *
     * Get a specific seller
     *
     * @param int $id Of the product
     * 
     * @return Seller Returns the relevant seller from the database
     *
     */
    public static function get($id, $column = "", $top = '9223372036854775807')
    {
        return Seller::get($id, $column, $top);
    }

    /**
     *
     * Post a new seller
     * @param array Post data
     *
     */
    public static function post($data)
    {
        $seller = new Seller();

        $seller->Username = $_SESSION['authenticated']['Username'];

        if ($data['verification'] === 'creditcard') {

            $errors = SellerCreditcardValidator::validate($data['CreditCardNumber']);
            
            if (count($errors) > 0)
                return $errors;
            
            $seller->Creditcard = $data['CreditCardNumber'];
            $seller->CheckOptionName = 1;
            UserController::put($_SESSION['authenticated']['Username'], ['Seller' => 1]);
        } else {

            $errors = SellerBankValidator::validate($data);

            if (count($errors) > 0)
                return $errors;

            $seller->BankName = $data['Bank'];
            $seller->BankAccountNumber = $data['BankAccount'];
            $seller->CheckOptionName = 0;
            $secretId = substr(hash('md5', $data['BankAccount']), 0, 5);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $message = "
            <h3>U heeft uw verkopers account geregistreerd!</h3>
            <p>
                Hierbij ontvangt u uw verficatie code die u moet invullen op de site. 
                Om het in te vullen moet u naar de verkopers registratie pagina gaan.
            </p>
            <br/>
            <p>
                Uw verificatie code is: $secretId
            </p><br/>
            <p>
                Met vriendelijke groet,<br/>
                <br/>
                EenmaalAndermaal
            </p><br/>
            <small>Heeft u zich niet geregistreerd op onze website, dan kunt u deze mail negeren.</small>
        ";

            mail($_SESSION['authenticated']['Email'], "Verkoper code", $message, $headers);
        }

        $seller->post();

        redirect('/');
    }

    /*
     *
     * Check the code the user got in the mail
     * @param string The code that is to be validated
     * @return array return errors or redirect
     *
     */
    public static function checkCode($code)
    {
        $seller = new Seller (Seller::get($_SESSION['authenticated']['Username']));

        if (substr(hash('md5', $seller->BankAccountNumber), 0, 5) === $code) {
            $seller->CheckOptionName = 1;
            $seller->put();

            UserController::put($_SESSION['authenticated']['Username'], ['Seller' => true]);

            redirect('/');
        }

        return ['code' => 'Code incorrect'];
    }

    /*
     *
     * Reset mail verification
     *
     */
    public static function resetCode()
    {
        $seller = SellerController::get($_SESSION['authenticated']['Username'], "Username");

        $seller = new Seller($seller);

        $seller->delete();

        redirect('/registrerenverkoper');
    }
}
