<?php

require "StudipMobileController.php";
require dirname(__FILE__) . "/../models/mail.php";

use Studip\Mobile\Mail;

/**
 *    get th inbox and outbox, write and send mails
 *    @author Nils Bussmann - nbussman@uos.de
 *    @author Marcus Lunzenauer - mlunzena@uos.de
 *    @author André Klaßen - aklassen@uos.de
 */
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
    
    /**
     * lists mails of inbox
     */
    function index_action($intervall=0, $delId=null )
    {
        //  set intervall for the messages
        $this->intervall = $intervall;
        //  if a message should be deleted
        if ( $delId != null )
        {
                Mail::deleteMessage( $delId, $this->currentUser()->id);
        }
        //  get all messages
        $this->inbox = Mail::findAllByUser($this->currentUser()->id, $intervall, true);
    }
    
    /**
     * lists mails of inbox
     */
    function list_inbox_action($intervall=0, $delId=null )
    {
        //  set intervall for the messages
        $this->intervall = $intervall;

        //  if a message should be deleted
        if ( $delId != null )
        {
                Mail::deleteMessage( $delId, $this->currentUser()->id);
        }
        //  get all messages
        $this->inbox = Mail::findAllByUser($this->currentUser()->id, $intervall, true);
    }
    
    /**
     * lists mails of outbox
     */ 
    function list_outbox_action($intervall=0, $delId=null )
    {
        //  set intervall for the messages
        $this->intervall = $intervall;

        //  if a message should be deleted
        if ( $delId != null )
        {
                 Mail::deleteMessage( $delId, $this->currentUser()->id);
        }
        //  get all messages
        $this->outbox = Mail::findAllByUser($this->currentUser()->id, $intervall, false);
    }
    
    /**
     * show a specific message
     */ 
    function show_msg_action($id, $mark=0)
    {
        $this->mail = Mail::findMsgById($this->currentUser()->id, $id, $mark);
    }
    
    /**
     * preparation for sending a mail
     */
    function write_action ( $empf=null )
    {
        if ($empf == null)
        {
            $this->members  = Mail::findAllInvolvedMembers( $this->currentUser()->id );
        } 
        else
        {
            $this->empfData = User::find($empf)->getData();
        }
    }
    
    /**
     * sends a mail
     */
    function send_action ( $empf )
    {
        $betreff     = $_POST["mail_title"];
        $nachricht   = $_POST["mail_message"];
        $this->sendmessage = Mail::send( $empf, $betreff, $nachricht, $this->currentUser()->id );
    }
}

