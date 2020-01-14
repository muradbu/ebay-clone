<?php

require_once('models/User.php');
require_once('models/Seller.php');

require_once('validators/EmailValidator.php');
require_once('validators/NewUserValidator.php');


class UserController
{

    /**
     *
     * Get a specific user by username
     *
     * @param string $username The username for the user to be retrieved
     *
     * @return User Returns the relevant user from the database
     *
     */
    public static function get($username, $column = "")
    {
        return User::get($username, $column);
    }

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

        if (count($isValid) > 0)
            return $isValid;

        $user = new User($data);
        $user->Password = md5($user->Password);
        $user->post();

        require_once('controllers/UserPhoneController.php');
        if (!UserPhoneController::post(["username" => $data['Username'], "phonenumber" => $data['PhoneNumber']]))
            return ["error" => "Registratie mislukt. Probeer opnieuw."];

        UserController::login($user->Username, $user->Password);
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
    {
        $user = new User(UserController::get($id));
        foreach ($data as $key => $value)
            if (property_exists('User', $key))
                $user->$key = $value ?? $user->$key;

        $user->put();

        $_SESSION['authenticated'] = UserController::get($user->Username);
    }

    /**
     *
     * Delete a specific user
     *
     * @param int $id Id of the user to delete
     *
     */
    public static function delete($id)
    {
    }

    /**
     *
     * Reset a user password
     *
     * @param int $id Id of the user to delete
     *
     */
    public static function resetPassword($username, $data)
    {
        require_once('validators/ResetUserPasswordValidator.php');

        $errors = ResetUserPasswordValidator::validate($data);

        if (count($errors) > 0)
            return $errors;

        UserController::put($username, ["Password" => md5($data['newpassword'])]);

        redirect("/inloggen");
    }

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

        if (count($isValid) > 0) {
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
            <small>Heeft u zich niet geregistreerd op onze website, dan kunt u deze mail negeren.</small>
        ";

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
     * Send an email with a custom message.
     *
     * @param string $email The email to send the verfication mail to
     * @param string $message The body to send within the mail
     * @param string $product The corresponding product 
     *
     */
    public static function sendContactMail($seller, $message, $product)
    {
        $isValid = ContactValidator::validate($message);

        if (count($isValid) > 0)
            return $isValid;


        $fromUsername = $_SESSION['authenticated']['Username'];
        $fromEmail = $_SESSION['authenticated']['Email'];
        $message = "
        <h3>U heeft een bericht ontvangen</h3>
        <address>
        Naam: $fromUsername<br/>
        Email: $fromEmail<br />
        Betreft product: <a href='http://iproject1.icasites.nl/veiling/$product[1]'>$product[0]</a>
        </address><br />
        <p>$message</p>
        ";

        $user = UserController::get($seller);

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($user['Email'], "EenmaalAndermaal - Bericht ontvangen van $fromUsername", $message, $headers, "-f $fromEmail");
        redirect("/");
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
        $password = md5($password);
        $user = User::execute("SELECT * FROM [User] WHERE Username = '$username' AND Password = '$password'");

        if (!empty($user)) {
            $_SESSION['authenticated'] = $user[0];
            redirect("/");
        }

        return ["error" => "De inlognaam en wachtwoord combinatie is onjuist."];
    }


    /**
     *
     * Gets the feedback from the given user
     *
     * @param int $username The username of the user who wants his feedback
     * @return array with all feedback rating and all feedback count
     */
    public static function getFeedbackCount($username)
    {
        return User::execute("SELECT SUM(feedback.feedbacktypename) AS 'allFeedbackRating',COUNT(feedback.productid) AS 'allFeedbackCount' FROM [product] LEFT JOIN [feedback]
        ON feedback.productid = product.productid WHERE product.seller = '$username';")[0];
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
