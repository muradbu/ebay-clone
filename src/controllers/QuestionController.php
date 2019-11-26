<?php

require_once('models/Question.php');

class QuestionController {

    /**
     *
     * Get a specific question by id
     *
     * @param int $id The id for the question to be retrieved
     * 
     * @return Question
     *
     */
    public static function get($id){

    }

    /**
     *
     * Get all questions
     *
     * @return array Return a array with all the questions from the database
     *
     */
    public static function query(){
        //Question::query();
        //test values for front
        return array(
            0 => array(
                "questionId"=>"1",
                "question"=>"Wat is je eerste huisdier?"
            ),
            1 => array(
                "questionId"=>"2",
                "question"=>"Wat vind je van IProject?"
            )
        );
    }
    
    /**
     *
     * Ceate a new question
     *
     * @param array $data The data to create a new question.
     *
     */
    public static function post($data){
        
    }
   
    /**
     *
     * Edit a specific user
     *
     * @param int $id Id of the question to edit
     * @param array $data The data to edit the relevant question
     *
     */
    public static function put($id){

    }
    
    /**
     *
     * Delete a question
     *
     * @param int $id the id of the question to delete
     */
    public static function delete($id){
        
    }
}