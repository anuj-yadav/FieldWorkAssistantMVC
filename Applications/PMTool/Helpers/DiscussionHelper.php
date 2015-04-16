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

  public static function GetTaskDiscussions($user, $taskId, $discussionManager, $discussionContentManager) {
    $discussionObj = new \Applications\PMTool\Models\Dao\Discussion;
    $discussionContentObj = new \Applications\PMTool\Models\Dao\Discussion_content;

    $discussionObj->setTask_Id($taskId);
    $messages = $discussionManager->selectMany($discussionObj, "task_id", true, true);
    $out = array();

    $userType = $user->getUserType();
    $userValue = $user->getUserTypeId();

    // get only the messages
    // we have received by this user
    //
    // reverse of the user types
    $rev = array(
      "technician_id" => "technician"
    );
    foreach ($messages as $m) {
      $discussionContentObj->setDiscussion_Id($m->discussion_id());
      $discussions = $discussionContentManager->selectMany($discussionContentObj, "discussion_id", true, true);
      foreach ($discussions as $disc) {
      /*
        if ($disc->discussion_content_category_value == 
            $userValue
            &&
            $rev[$disc->discussion_content_category_type] == 
            $userType) {
      */
       if (true) {

           $out[] = $disc;
        }
       } 

    }

    return $out;
  }
  // get the discussion
  // title for a class
  // TODO: needs custom approach
  // see issue #
  public static function GetDiscussionTitle($discussionObj, $task) {
    
      $title = sprintf(
        "Discussion: #%s for task  '%s'",
      $discussionObj->discussion_id(), $task->task_name()); 

    return $title;
  }

  // rq1 is singular
  // rq2 is an  array
  public static function GetDiscussionId($rq1, $rq2) {
     if (isset($rq2[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::discussionId])) {
          return $rq2[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::discussionId];
      }
     return $rq1->getData(\Applications\PMTool\Resources\Enums\ViewVariablesKeys::discussionId);
  }

  // from the session make a new discussion
  // object 
  // merge the content
  // and otherj
  public static function GetDiscussionFromSession($sessDiscussion) {
      $discussionContentObj = new \Applications\PMTool\Models\Dao\Discussion_content;
      $discussionObj = new \Applications\PMTool\Models\Dao\Discussion;
      $discussionObj->setDiscussion_Id($sessDiscussion[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::discussionId]);
      $discussionObj->setTask_Id($sessDiscussion[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::taskId]);
      //
      //
      $discussionObj->dcussion_content_category_value= $sessDiscussion['comm_type'];
      $discussionObj->discussion_content_category_type=$sessDiscussion['comm_id'];
      return $discussionObj;
  }

  // session param
  // request param
  //
  public static function GetDiscussionFromDB($discussionId, $discussionObj, $discussionContentObj, $discussionManager, $discussionContentManager) {
    // considering we have an id
    //
    $protoObj = new \stdClass;
    // when we don't have
    // a discussion id as a param
    // no action taken
 
    //  when no result
    // for this we need to cancel
    $discussionObj->setDiscussion_Id($discussionId);
    $discussion = $discussionManager->selectMany($discussionObj, "discussion_id", true,true);
    if (is_array($discussion) && sizeof($discussion)>0) {
      $discussion = $discussion[0];
      $discussionContentObj->setDiscussion_Id($discussionObj->discussion_id());
      $discussionContent = $discussionContentManager->selectOne($discussionContentObj, "discussion_id");
      if (is_array($discussionContent) && sizeof($discussionContent)>0) {

        $discussionContent = $discussionContent[0];   
        
        // we need the 
        // person that is being messages
        //
          
        foreach (get_object_vars($discussionContentObj) as $k => $d) {
          $discussion->$k = $d;
        }
      }
    }
      return $discussion;
  }

   
  public static function GetSessionDiscussion()  {
      return $_SESSION[\Library\Enums\SessionKeys::CurrentDiscussion];
  }
  public static function SetCommInfo($discussionContentObj) {
      //   get who we'ere
      // communiucating with
      // by session
      $disc = \Applications\PMTool\Helpers\DiscussionHelper::GetSessionDiscussion();
    $discussionContentObj->discussion_content_category_type = $disc['comm_type'];
     $discussionContentObj->discussion_content_category_value = $disc['comm_id'];
    return $discussionContentObj;    
  }
    
  // add a new message that
  // is  from either an object
  // currentDiscussion or from the database  
  public static function FormNewMessage($discussionContentObj, $dataPost, $currentDiscussion) {
    $message = isset($dataPost['message']) ? $dataPost['message'] : null;
    if ($currentDiscussion instanceof  \Applications\PMTool\Models\Dao\Discussion) {
      $discussionContentObj->discussion_id = $currentDiscussion->discussion_id();
            
      $discussionContentObj->discussion_content_value = $message;
      // when the current   
      // discussion does not define
      // these search for one
      //
      if (!isset($currentDiscusssion->discussion_content_category_type) && 
        !isset($currentDiscussion->discussion_content_category_value)
      ) {
        $discussionContentObj = \Applications\PMTool\Helpers\DiscussionHelper::SetCommInfo($discussionContentObj);
      } else { 
      
        $discussionContentObj->discussion_content_type = $currentDiscussion->discussion_content_category_type;
        $discussionContentObj->discussion_content_value = $currentDiscussion->discussion_content_category_value;
      }
    }
    return $discussionContentObj;
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
