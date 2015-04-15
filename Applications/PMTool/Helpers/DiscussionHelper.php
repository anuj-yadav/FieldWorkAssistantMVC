<?php

// Helper functions around Discussion based
// objects: 
// 
// called from
// executeSendMessage/1 (activeTaskController)
namespace Applications\PMTool\Helpers;

// switch to whichever form is needed
// for messaging (currently email)
final class DiscussionMessageSender {
  // return a boolean
  // on whether we could
  // send or not 
  //
  // 
  // TODO needs to add better email support
  // currently use plain-text
  public static function send($to, $subject,$message) {
      $obj = mail($to, $subject, $message);
      return $obj ? true : false;
  }  
}
final class DiscussionHelper {
  // @param user: the sender
  // @param receiver: who receives need to delegate type
  // @param discussion_content has not been inserted (yet)
  public static function SendMessage(\Library\User $user, $taskName, $discussionId, $discussionContentObj) {
      $initialData = array();
      // subject could be the task title 
      // and message
      $subject = sprintf("Task %s: new message [discussion: %s]", $taskName, $discussionId);
      $message = $discussionContentObj->discussion_content_value;
      // we just need one 
      $pmTechnicians = $_SESSION[\Library\Enums\SessionKeys::CurrentPm][\Library\Enums\SessionKeys::PmTechnicians];

      $email = "";
      if ($discussionContentObj->discussion_content_category_type == "technician") {
        foreach  ($pmTechnicians as $technician) {
          if ($discussionContentObj->discussion_content_category_value == $technician['technician_id']) {
            $email = $technician['technician_email'];
          }
        }
      }      
      // add other user types    
      return $email ? \Applications\PMTool\Helpers\DiscussionMessageSender::send(
        $email,
        $subject,
        $message
      ) : false;
  }

  public static function GetMessages($discussionId, $discussionManager, $discussionContentManager, $otherProviders) {
    $discussionObj = new \Applications\PMTool\Models\Dao\Discussion;
    $discussionContentObj = new \Applications\PMTool\Models\Dao\Discussion_content;
    $discussionContentObj->setDiscussion_Id($discussionId);
      
    $initialData = $discussionContentManager->selectMany($discussionContentObj, "discussion_id", false, true);
    foreach ($initialData as $k => $id) {
        // get the user 
        // for this content
      if ($id->discussion_content_category_type == "technician") {
        $pmTechnicians = $_SESSION[\Library\Enums\SessionKeys::CurrentPm][\Library\Enums\SessionKeys::PmTechnicians]; 
        
        foreach ($pmTechnicians as $technician) {
          if ($technician['technician_id'] == $id->discussion_content_category_value) {
            $initialData[$k]->poster_name =  $technician['technician_name'];
            $initialData[$k]->poster_obj =  $technician;
            break;
          }
        }
      } else if ($id->discussion_content_category_type == "service") {
        // TODO 
      }
    }
    // reverse chronological 
    return array_reverse($initialData); 
  }

}
?>
