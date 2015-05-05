INSERT INTO `topic` (`id`, `name`) VALUES 
(3, 'Rheumatoid Arthritis'), 
(4, 'Spondyloarthritis'),
(5, 'Axial spondyloarthritis'),
(6, 'Psoriatic Arthritis'),
(7, 'General Immunology'),
(8, 'Epilepsy'),
(9, 'Parkinson’s Disease'),
(10, 'General Neurology');


INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('1', '3');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('1', '4');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('1', '5');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('1', '6');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('1', '7');

INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('2', '3');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('2', '4');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('2', '5');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('2', '6');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('2', '7');

INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('3', '8');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('3', '9');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('3', '10');

INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('4', '8');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('4', '9');
INSERT INTO `topics_msls` (`msl_id`, `topic_id`) VALUES ('4', '10');

DELETE FROM `topic` WHERE `topic`.`id` = 1;
DELETE FROM `topic` WHERE `topic`.`id` = 2;