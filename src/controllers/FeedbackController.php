<?php

require_once('models/Feedback.php');

class FeedbackController
{
    /**
     *
     * Post a new seller
     * @param array Post data
     *
     */
    public static function post($data){
        $feedback = new Feedback();
       
        $feedback->ProductId = $data['ProductId'];
        $feedback->UserType = "Koper";
        $feedback->FeedbackTypeName = $data['Stars'];
        $feedback->Date = date("Y/m/d");
        $feedback->Time = date("H:i:s");
        $feedback->Comment = $data['Comment'];

        $feedback->post();
        redirect("/gebruiker/biedingen/0");
    }

    public static function get($id, $column)
    {
        return Feedback::get($id, $column);
    }
}

?>