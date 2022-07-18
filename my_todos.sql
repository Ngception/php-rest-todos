CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `assigned_to` varchar(255),
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `todos` (`id`, `body`, `status`, `assigned_to`) VALUES
(1, 'Update the company website', 'in progress', 'Jane Doe'),
(2, 'Reorder out-of-stock inventory', 'in progress', 'John Smith'),
(3, 'Print new company flyers', 'to do', 'Joe Richards'),
(4, 'Schedule all-hands meeting', 'to do', 'Jessica Franz'),
(5, 'Host new hire orientation', 'complete', 'Jane Doe'),
(6, 'Submit budget for approval', 'complete', 'Jane Doe'),
(7, 'Complete security audit', 'in progress', 'Joe Richards'),
(8, 'Decommission unused equipment', 'to do', 'John Smith');
