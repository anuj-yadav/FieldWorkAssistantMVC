-- Update for 2015-04-17
-- > table discussion update

USE `baiken_fwm_1`;

ALTER TABLE `discussion` 
ADD COLUMN `discussion_start_timestamp` TIMESTAMP NULL AFTER `task_id`;
