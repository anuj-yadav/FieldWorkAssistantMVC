<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>

<?php if (!$discussion_not_found): ?>
  <div class="right-aside main col-lg-10 col-md-10 col-sm-10">
    <h2><?php echo $discussion_title; ?></h2>
    <!-- seperatate -->
    <h2><?php echo $resx['discussion_new_response'];?></h2>
    <textarea id="<?php echo $resx['discussion_content_field']; ?>" style="width:700px;float: left; "id="chat-textarea"></textarea>
    <input id="<?php echo $resx['discussion_id_field']; ?>" type="hidden" value="<?php echo $discussion_id; ?>"></input>
    <button style="width: 100px;float: left; " id="btn_reply_message" class="btn">Send Message</button>
    <div style="clear: both; "></div>
    <!-- non pm only views the history of a communication, also  -->
      
    <ul style="width: 700px;margin-top: 10px; position:relative; ">
        <?php
           require_once($form_modules['communications_listing_module']);
        ?>
    </ul>
  </div>

<? else: ?>

  <h2><?php echo $resx['discussion_not_found']; ?></h2>

<? endif; ?>
