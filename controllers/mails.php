<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/mail.php";

use Studip\Mobile\Mail;


class MailsController extends StudipMobileController
{
        /**
         * custom before filter (see StudipMobileController#before_filter)
         */
        function before()
        {
                # require a logged in User or else redirect to session/new
                $this->requireUser();
        }
        
        function index_action($intervall=0, $delId=null )
        {
                    $this->intervall = $intervall;
                    if ( $delId != null )
                    {
                            Mail::deleteMessage( $delId, $this->currentUser()->id);
                    }
                    $this->inbox = Mail::findAllByUser($this->currentUser()->id, $intervall, true);
        }
        
        function list_inbox_action($intervall=0, $delId=null )
        {
                    $this->intervall = $intervall;
                    if ( $delId != null )
                    {
                             Mail::deleteMessage( $delId, $this->currentUser()->id);
                    }
                    $this->inbox = Mail::findAllByUser($this->currentUser()->id, $intervall, true);
        }
        
        function list_outbox_action($intervall=0, $delId=null )
        {
                    $this->intervall = $intervall;
                    if ( $delId != null )
                    {
                             Mail::deleteMessage( $delId, $this->currentUser()->id);
                    }
                    $this->outbox = Mail::findAllByUser($this->currentUser()->id, $intervall, false);
        }
        
        function show_msg_action($id = null, $mark=0)
        {
                    $this->mail = Mail::findMsgById($this->currentUser()->id, $id, $mark);
        }
}

