CREATE TABLE `admit` (
  `id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `message` text,
  `doctor_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `base_salary` decimal(10,2) NOT NULL,
  `bounus_by_percent` decimal(5,0) DEFAULT NULL,
  `total_bounus` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `father_name` varchar(40) NOT NULL,
  `mother_name` varchar(40) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `shift` enum('MORNING','EVENING','NIGHT') DEFAULT NULL,
  `chamber_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `visit_fee` decimal(7,2) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `father_name` varchar(40) NOT NULL,
  `mother_name` varchar(40) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `shift` enum('MORNING','EVENING','NIGHT') DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `base_salary` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employeehistory`
--

CREATE TABLE `employeehistory` (
  `id` int(11) NOT NULL,
  `emplopyee_id` int(11) DEFAULT NULL,
  `joined_date` date NOT NULL,
  `leave_date` date NOT NULL,
  `atentance` int(11) DEFAULT NULL,
  `absense` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` varchar(3) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment`
--

CREATE TABLE `invoice_payment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `net` int(11) DEFAULT NULL,
  `advance` int(11) DEFAULT NULL,
  `due` int(11) DEFAULT NULL,
  `remark` enum('DUE','RECIVED','PRCESSCING') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `patient_id` int(20) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `printed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `condition_on` varchar(255) DEFAULT NULL,
  `issues_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_type` enum('GENERAL-CABIN','VIP-CABIN','CHAMBER','OT','GUEST-ROOM') DEFAULT 'GENERAL-CABIN',
  `room_no` varchar(30) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `floor` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `_id` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(20) DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `condition_on` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test_name` varchar(20) NOT NULL,
  `delivary` date NOT NULL,
  `description` text,
  `time` varchar(10) DEFAULT '7:00PM',
  `rate` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` char(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `last_service` date DEFAULT NULL,
  `roles` enum('SUPERADMIN','ADMIN','DOCTOR','EMPLOYEE') DEFAULT 'EMPLOYEE',
  `address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admit`
--
ALTER TABLE `admit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `designation_id` (`designation_id`),
  ADD KEY `chamber_id` (`chamber_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `employeehistory`
--
ALTER TABLE `employeehistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emplopyee_id` (`emplopyee_id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `issues_by` (`issues_by`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_id` (`_id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_name` (`test_name`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admit`
--
ALTER TABLE `admit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeehistory`
--
ALTER TABLE `employeehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admit`
--
ALTER TABLE `admit`
  ADD CONSTRAINT `admit_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `admit_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `designation`
--
ALTER TABLE `designation`
  ADD CONSTRAINT `designation_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `designation_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `doctor_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `doctor_ibfk_4` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`),
  ADD CONSTRAINT `doctor_ibfk_5` FOREIGN KEY (`chamber_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `doctor_ibfk_6` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`);

--
-- Constraints for table `employeehistory`
--
ALTER TABLE `employeehistory`
  ADD CONSTRAINT `employeehistory_ibfk_1` FOREIGN KEY (`emplopyee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `employeehistory_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `employeehistory_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `invoice_payment`
  ADD CONSTRAINT `invoice_payment_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `invoice_payment_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `invoice_payment_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`issues_by`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`);
COMMIT;

