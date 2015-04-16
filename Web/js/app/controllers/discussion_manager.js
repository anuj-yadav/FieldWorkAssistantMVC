// discussion manager helpers
// this should define the following
//
// discussion_manager,
// discussion_ui
$(document).ready(function() {

  // pm only
  // 
  $("#btn_send_message").click(function() {
    var discussionId = discussion_ui.getDiscussionIdIfNeeded();
    var isReceiver = false;
    var msg = $("#discussion_content_field").val();
    discussion_manager.sendMessage(msg, discussionId, isReceiver, function(data) {
        discussion_manager.getMessages(discussionId, function(data) {
            discussion_ui.propagateMessages(data.data, isReceiver);
        });
    });
  });

  // non pm
  $("#btn_reply_message").click(function() {
    var discussionId = discussion_ui.getDiscussionIdIfNeeded();
    var isReceiver = true;
    var msg = $("#discussion_content_field").val();
    discussion_manager.sendMessage(msg, discussionId, isReceiver, function(data) {
        discussion_manager.getMessages(discussionId, function(data) {
           discussion_ui.propagateMessages(data.data, isReceiver);
        });
    });
  });

  // non pm
  if (discussion_ui.isInViewCommunications()) {
    var taskId = discussion_ui.getTaskIdIfNeeded();
    if (taskId) {
       discussion_manager.getAllDiscussions(taskId, function(data) {
          if (data.result) {
            discussion_ui.propagateDiscussions(data.data); 
          }
       });
     }
  };
  // pm only
  if (discussion_ui.isInCommunications()) {
    var discussionId = discussion_ui.getDiscussionIdIfNeeded();
    var taskId = discussion_ui.getTaskIdIfNeeded();
    if (discussionId) {
      discussion_manager.getMessages(discussionId,function(data) {
        if ( data.result) {
          discussion_ui.propagateMessages(data.data);
        }
      });
    } 
  }; 
});

(function (discussion_ui) {

  discussion_ui.taskId = null;
  discussion_ui.discussionId = null;
  discussion_ui.isInCommunications = function() {
    return document.location.href.match(/communications/);
  };
  discussion_ui.isInViewCommunications = function() {
    return document.location.href.match(/viewTaskCommunications/);
  };

  discussion_ui.propagateMessages = function(data, isReceiver) {
      // add messagesj
      // isReceiver should be a simple
      // switch over what context to use
      // ( from me ) vs ( to me )
      var cont = $("#discussion_messages");
      cont.innerHTML = "";//
      cont.get()[0].innerHTML="";
      if (data.length === 0) {
        var h2  = document.createElement("h2");
        h2.innerHTML = "No messages at this moment";
      } else {
        for (var i in data) {
          var li = document.createElement("li");
          var message = document.createElement("div");
          message.innerHTML = data[i].discussion_content_value;
   
          li.appendChild(message); 

          $(cont).append(li);
        }
      }
  };

  discussion_ui.getDiscussionTitle = function(discussion, task) {
      return "Discussion #" + discussion.discussion_id + " for task '" + task.task_name + "'";
  };

  discussion_ui.getViewLink = function(slice) {
    return "./viewTaskCommunication?discussion_id="  + slice.discussion_id + "&task_id=" + slice.task_id;
  };

  discussion_ui.propagateDiscussions = function(data) {
    var cont = $("#discussion_discussions");
    cont.get()[0].innerHTML ="";

    if (data.length === 0) {

      var h2 = document.createElement("h2");
      h2.innerHTML = "No discussions at this moment";
      $("#discussion_discussions").append(h2);  
    } else {
      for (var i in data) {
        var li = document.createElement("li");
        var title = document.createElement("div");
        // add a link
        //
        var a = document.createElement("a");
        var link = discussion_ui.getViewLink (data[i]);
        a.innerHTML = "temp";
        a.setAttribute("href", link);
        li.appendChild(a);
        $("#discussion_discussions").append(li);
      }
    }
  };
  discussion_ui.getDiscussionIdIfNeeded = function() {
     var el = $("#discussion_id_field").get();
     if (el.length > 0 && discussion_ui.discussionId == null) {
        discussion_ui.discussionId = $(el).val(); 
     } 
     return discussion_ui.discussionId;
  };
  // todo maybe needs a better approach
  discussion_ui.getTaskIdIfNeeded = function() {
    var m = document.location.href.match(/task_id=([\w\d]+)/);
    if (m && discussion_ui.taskId == null) {
       discussion_ui.taskId = m[1]; 
    }
    return discussion_ui.taskId;
  };

})((window.discussion_ui = window.discussion_ui || {}));

(function (discussion_manager) {
  // non pm
  discussion_manager.getAllDiscussions = function(taskId, callback) {
    datacx.post("activetask/getTaskCommunications",{
      "task_id": taskId
    }).then(function(data) {
        if (!data.result) {
          toastr.error(data.message);
        } else {
          callback(data); 
        }
    });
   }
  discussion_manager.getMessages = function(discussionId, callback) {
     datacx.post("activetask/getMessages", {
        //"task_id": taskId,
        "discussion_id" : discussionId
     }).then(function(reply) {
        if (!reply.result) {
          toastr.error(reply.message);
        } else {
           callback(reply);
        }
  
     });
  };

  discussion_manager.sendMessage = function(message, discussionId, isReceiver, callback) {
    datacx.post("activetask/sendMessage", {
      "message": message,
      "isReceiver": isReceiver,
      "discussion_id": discussionId
    }).then(function(reply) {
      if (!reply.result) {
        toastr.error(reply.message);
      } else {
        // warn the user
        // of the success
        toastr.success(reply.message);
        callback(reply);
      }
    });
  };

})((window.discussion_manager = window.discusssion_manager || {}));
