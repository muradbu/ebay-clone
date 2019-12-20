<?php

require_once('models/User.php');

require_once('validators/EmailValidator.php');
require_once('validators/NewUserValidator.php');

class UserController
{

    /**
     *
     * Get a specific user by id
     *
     * @param int $id The id for the user to be retrieved
     *
     * @return User Returns the relevant user from the database
     *
     */
    public static function get($id)
    { }

    /**
     *
     * Get all users
     *
     * @return array Returns a array with all the users in the database
     *
     */
    public static function query()
    {
        return User::query();
    }

    /**
     *
     * Create a new user
     *
     * @param array $data The data to create a new user.
     *
     */
    public static function post($data)
    {
        $isValid = NewUserValidator::validate($data);

        if (is_array($isValid))
            return $isValid;

        $user = new User();

        foreach (array_keys($data) as $value) {
            if (property_exists('User', $value))
                $user->$value = $data[$value];
        }

        $user->post();

        require_once('controllers/UserPhoneController.php');
        if (!UserPhoneController::post(["username" => $data['username'], "phonenumber" => $data['phonenumber']]))
            return ["error" => "Registratie mislukt. Probeer opnieuw."];

        UserController::login($user->username, $user->password);
    }

    /**
     *
     * Edit a specific user
     *
     * @param int $id Id of the user to edit
     * @param array $data The data to edit the relevant user
     *
     */
    public static function put($id, $data)
    { }

    /**
     *
     * Delete a specific user
     *
     * @param int $id Id of the user to delete
     *
     */
    public static function delete($id)
    { }

    /**
     *
     * Send a email with a secretId, set sercretId in session
     *
     * @param string $email The email to send the verfication mail to
     *
     */
    public static function sendEmailVerification($email)
    {
        $isValid = EmailValidator::validate($email);

        if (is_array($isValid)) {
            return $isValid;
        }

        $secretId = strtoupper(substr(uniqid(), -6));

        $_SESSION['emailverification']['email'] = $email;
        $_SESSION['emailverification']['secret'] = $secretId;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $message = "
            <h3>U heeft uw email geregistreerd!</h3>
            <p>
                Hierbij ontvangt u uw verficatie code die u moet invullen op de site. 
                Om het in te vullen moet u de website nog wel open hebben staan.
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
            <small>“Heeft u zich niet geregistreerd op onze website, dan kunt u deze mail negeren.</small>
        ";

        //todo: create a nice email template.
        mail($email, "Verificatie code", $message, $headers);

        redirect("emailbevestigen");
    }

    /**
     *
     * Check entered secretId with secretId in session
     *
     * @param int $code The code to check with the secretId in the session
     *
     */
    public static function emailVerification($code)
    {
        if ($code == $_SESSION['emailverification']['secret']) {
            $_SESSION['emailverification']['verified'] = true;
            redirect("registreren");
        } else {
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
    public static function login($username, $password)
    {
        // $password = encypt($password);
        $user = User::execute("SELECT * FROM [User] WHERE Username = '$username' AND Password = '$password'");

        if (!empty($user)) {
            $_SESSION['authenticated'] = $user[0];
            redirect("/");
        }

        return ["error" => "De inlognaam en wachtwoord combinatie is onjuist."];
    }

    /**
     *
     * Remove authenticated from session
     *
     */
    public static function logout()
    {
        $_SESSION['authenticated'] = null;
        redirect("/");
    }
}
