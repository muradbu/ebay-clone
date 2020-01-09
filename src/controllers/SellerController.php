<?php

require_once('models/User.php');
require_once('models/Seller.php');

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
        $user = new User($_SESSION['authenticated']);

        $seller->Username = $_SESSION['authenticated']['Username'];

        if ($data['verification'] === 'creditcard') {
            $seller->Creditcard = $data['creditcardnumber'];
            // do creditcard check
            $seller->CheckOptionName = 1;
            $user->Seller = true;
            $_SESSION['authenticated']['Seller'] = true;
        } else {
            $seller->BankName = $data['bank'];
            $seller->BankAccountNumber = $data['bankaccount'];
            $seller->CheckOptionName = 0;
            $secretId = substr(hash('md5', $data['bankaccount']), 0, 5);
            // TODO Maak er een post ding van
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
        $user->put();

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
        $seller = Seller::get($_SESSION['authenticated']['Username']);

        if (substr(hash('md5', $seller->BankAccountNumber), 0, 5) === $code) {
            $seller->CheckOptionName = 1;
            $seller->put();

            $user = new User($_SESSION['authenticated']);
            $user->Seller = true;
            $user->put();

            $_SESSION['authenticated']['Seller'] = true;

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
