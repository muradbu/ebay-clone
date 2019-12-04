<?php

require_once('models/User.php');
require_once('helpers/DataHelper.php');

require_once('validators/EmailValidator.php');
require_once('validators/NewUserValidator.php');

class UserController {

    /**
     *
     * Get a specific user by id
     *
     * @param int $id The id for the user to be retrieved
     *
     * @return User Returns the relevant user from the database
     *
     */
    public static function get($id){

    }

    /**
     *
     * Get all users
     *
     * @return array Returns a array with all the users in the database
     *
     */
    public static function query(){
        return User::query();
    }

    /**
     *
     * Create a new user
     *
     * @param array $data The data to create a new user.
     *
     */
    public static function post($data){

        $isValid = NewUserValidator::validate($data);

        if(is_array($isValid)){
            return $isValid;
        }

        $user = new User();

        foreach(array_keys($data) as $value){
            $user->$value = $data[$value];
        }

        $user->post();

    }

    /**
     *
     * Edit a specific user
     *
     * @param int $id Id of the user to edit
     * @param array $data The data to edit the relevant user
     *
     */
    public static function put($id, $data){

    }

    /**
     *
     * Delete a specific user
     *
     * @param int $id Id of the user to delete
     *
     */
    public static function delete($id){

    }

    /**
     *
     * Send a email with a secretId, set sercretId in session
     *
     * @param string $email The email to send the verfication mail to
     *
     */
    public static function sendEmailVerification($email){

        $email = DataHelper::convertInput($email);

        $isValid = EmailValidator::validate($email);

        if(is_array($isValid)){
            return $isValid;
        }

        $secretId = strtoupper(substr(uniqid(), -6));

        $_SESSION['emailverification']['email'] = $email;
        $_SESSION['emailverification']['secret'] = $secretId;

        $message = "Uw verificatie code is: $secretId";

        //todo: create a nice email template.
        mail($email,"Verificatie code", $message);

        header("Location: /emailbevestigen");
        die();
    }

    /**
     *
     * Check entered secretId with secretId in session
     *
     * @param int $code The code to check with the secretId in the session
     *
     */
    public static function emailVerification($code){
        if($code == $_SESSION['emailverification']['secret']){
            $_SESSION['emailverification']['verified'] = true;
            header("Location: /registreren");
            die();
        } else{
            return ["code" => "De opgegeven verificatie code is onjuist."];
        }
    }

    /**
     *
     * Check entered secretId with secretId in session
     *
     * @param int $username The username of the user who wants to login
     * @param int $password The password of the user who wants to login
     * @return array If login is successful
     */
    public static function login($username, $password) {
        // $password = encypt($password);
        $user = User::execute("SELECT * FROM [User] WHERE Username = $username AND Password = $password")[0];
        if (!empty($user)) {
            $_SESSION['authenticated'] = $user;
            header("Location: /");
        }
        return ["username" => "De opgegeven gebruiker is onjuist."];
    }

    /**
     *
     * Remove authenticated from session
     *
     */
    public static function logout() {
        $_SESSION['authenticated'] = null;
        header("Location: /");
    }
}


?>
