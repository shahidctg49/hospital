
INSERT INTO `user` (`id`, `avatar`, `name`, `email`, `password`, `phone`, `roles`, `address`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, NULL, 'Ashab Uddin', 'ashab@gmail.com', '125bce26d032f2034e26cf229da4b52e', '01840088189', 'SUPERADMIN', NULL, '2022-07-06 11:34:56', NULL, NULL, NULL, 1),
(2, NULL, 'Mr. Doctor', 'doctor@gmail.com', 'b714337aa8007c433329ef43c7b8252c', '01744100139', 'DOCTOR', 'Bhola', '2022-07-06 11:40:48', 1, NULL, NULL, 1),
(3, NULL, 'Dr. Tashin Mustafe', 'tasin@gmail.com', 'b714337aa8007c433329ef43c7b8252c', '01717661719', 'DOCTOR', 'chawakbazar', '2022-07-15 05:22:07', 1, NULL, NULL, 1),
(4, NULL, 'Habibur Rohman', 'habibur@gmail.com', 'b714337aa8007c433329ef43c7b8252c', '01739000999', 'DOCTOR', 'Dhaka', '2022-07-21 04:59:18', 1, NULL, NULL, 1);


INSERT INTO `department` (`id`, `name`, `created_by`, `created_at`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Pethology', 1, '2022-07-06 11:41:15', '0000-00-00 00:00:00', NULL, 1),
(2, 'Allergists/Immunologists', 1, '2022-07-06 11:41:34', '0000-00-00 00:00:00', NULL, 1),
(3, 'Anesthesiologists', 1, '2022-07-06 11:41:41', '0000-00-00 00:00:00', NULL, 1),
(4, 'Critical Care Medicine Specialists', 1, '2022-07-21 04:08:35', '0000-00-00 00:00:00', NULL, 1),
(5, 'Hematologists', 1, '2022-07-21 04:08:46', '0000-00-00 00:00:00', NULL, 1),
(6, 'Internists', 1, '2022-07-21 04:08:54', '0000-00-00 00:00:00', NULL, 1),
(7, 'Neurologists', 1, '2022-07-21 04:09:03', '0000-00-00 00:00:00', NULL, 1),
(8, 'Plastic Surgeons', 1, '2022-07-21 04:09:16', '0000-00-00 00:00:00', NULL, 1),
(9, 'Podiatrists', 1, '2022-07-21 04:09:26', '0000-00-00 00:00:00', NULL, 1),
(10, 'Radiologists', 1, '2022-07-21 04:09:46', '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `designation` (`id`, `designation_name`, `base_salary`, `bounus_by_percent`, `total_bounus`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Reciptionist', '32000.00', '0.15', 2, '2022-07-06 11:42:07', 1, '0000-00-00 00:00:00', NULL, 1),
(2, 'Supervisor', '25000.00', '0.15', 2, '2022-07-06 11:42:34', 1, '0000-00-00 00:00:00', NULL, 1),
(3, 'Medical Officer', '25000.00', '0.15', 2, '2022-07-06 11:42:54', 1, '0000-00-00 00:00:00', NULL, 1),
(4, 'Medical Surgent', '50000.00', '0.15', 2, '2022-07-21 04:11:31', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `rate` (`id`, `service_name`, `rate`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'MRI', '4000.00', '2022-07-06 12:01:36', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `room` (`id`, `room_type`, `room_no`, `capacity`, `details`, `floor`, `availability`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'GENERAL-CABIN', '101', '1', '', 'Ground Floor', 'YES', '2022-07-06 11:43:26', 1, '0000-00-00 00:00:00', NULL, 1),
(2, 'CHAMBER', '102', '1', '', 'Ground Floor', 'YES', '2022-07-06 11:43:41', 1, '0000-00-00 00:00:00', NULL, 1),
(3, 'CHAMBER', '103', '1', '', 'Ground Floor', 'YES', '2022-07-06 11:44:01', 1, '0000-00-00 00:00:00', NULL, 1),
(5, 'CHAMBER', '104', '1', '[\"Tv\"]', '1st', 'YES', '2022-07-21 04:13:54', 1, '0000-00-00 00:00:00', NULL, 1),
(6, 'CHAMBER', '106', '1', '', 'Ground Floor', 'YES', '2022-07-21 04:25:45', 1, '0000-00-00 00:00:00', NULL, 1),
(7, 'GENERAL-CABIN', '108', '8', '', 'Ground Floor', 'YES', '2022-07-21 04:26:26', 1, '0000-00-00 00:00:00', NULL, 1),
(8, 'ICU', '401', '8', '[\"AC\",\"Refrigerator\",\"Locker\"]', '4th', 'NO', '2022-07-21 04:51:19', 1, '0000-00-00 00:00:00', NULL, 1),
(9, 'CCU', '301', '4', '[\"AC\",\"Refrigerator\",\"Locker\"]', '3RD FLOOR', 'YES', '2022-07-21 04:27:57', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `service` (`id`, `service_name`, `rate`, `condition_on`, `description`, `duration`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Nebulzer', 300, 'Every Time', '', '', '2022-07-06 12:01:17', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `doctor` (`id`, `user_id`, `father_name`, `mother_name`, `qualification`, `gratuated_from`, `gender`, `date_of_birth`, `shift`, `chamber_id`, `designation_id`, `visit_fee`, `department_id`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 2, 'Father', 'Mother', 'MBBS, FCPS, FCPS-2', 'Chittagong Medical College', 'male', '1987-06-01', 'EVENING', 3, 4, '2000.00', 7, '2022-07-21 04:37:18', 1, '0000-00-00 00:00:00', NULL, 1),
(2, 3, 'Father', 'Mother', 'FCPS', 'Sylhet Osmani Medical College', 'female', '2015-06-10', 'EVENING', 2, 3, '1000.00', 10, '2022-07-21 04:58:06', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `patient` (`id`, `name`, `father_or_husband_name`, `mother_name`, `religious`, `nid`, `blood_group`, `nationality`, `marital_status`, `phone`, `gender`, `age`, `relagius`, `weight`, `present_address`, `permanent_address`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Mr. Rabib Hasan', 'MR,', 'Mrs', NULL, '', 'A+', NULL, 'MARRIED', '01840083454', 'male', '35', NULL, NULL, 'Ctg', 'Bhula', '2022-07-21 03:59:30', 1, '0000-00-00 00:00:00', NULL, 1),
(2, 'Mr Patient', 'Mr ', 'Mrs', NULL, '', '', NULL, 'UNMARRIED', '01845345345', 'male', '56', NULL, NULL, 'ctg', '', '2022-07-21 04:49:01', 1, '0000-00-00 00:00:00', NULL, 1);


INSERT INTO `test` (`id`, `test_name`, `description`, `rate`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'MRI', 'Full Body Scane', '4000.00', '2022-07-06 11:50:36', 1, '0000-00-00 00:00:00', NULL, 1),
(2, 'X-Ray', 'Normal X-ray', '300.00', '2022-07-06 11:57:20', 1, '0000-00-00 00:00:00', NULL, 1),
(3, 'CBC', '', '4000.00', '2022-07-07 04:27:01', 1, '0000-00-00 00:00:00', NULL, 1),
(4, 'Blood Group Test', '', '100.00', '2022-07-07 04:27:46', 1, '0000-00-00 00:00:00', NULL, 1),
(5, 'Hemoglobin Test', '', '2500.00', '2022-07-07 04:28:25', 1, '0000-00-00 00:00:00', NULL, 1),
(6, 'Covid', '', '700.00', '2022-07-21 04:29:13', 1, '0000-00-00 00:00:00', NULL, 1);




INSERT INTO `appointment` (`id`, `name`, `phone`, `patient_id`, `message`, `doctor_id`, `department_id`, `date`, `time`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Mr. Rabib Hasan', '01840083454', 1, '', 1, 7, '2022-07-23', '02:00PM', '2022-07-21 04:37:48', 1, NULL, NULL, 1),
(2, 'Mr. Rabib Hasan', '01840083454', 1, '', 1, 7, '2022-07-22', '01:00PM', '2022-07-21 04:39:44', 1, NULL, NULL, 1);



INSERT INTO `admit` (`id`, `patient_id`, `guardian_name`, `emargency_contact`, `relationship_with_patient`, `refarecne_by`, `patient_of`, `room_id`, `entry_time`, `out_time`, `duration`, `patient_condition`, `roles`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 2, 'Mr Father', '01950034242', 'Father', '', 1, 8, '2022-07-21 00:00:00', NULL, NULL, 'Critical Se', 'ADMITTED', '2022-07-21 04:51:19', 1, '0000-00-00 00:00:00', NULL, 1);



INSERT INTO `invoice_payment` (`id`, `ipid`, `patient_id`, `test_id`, `appointment_id`, `payment_date`, `subtotal`, `tax`, `discount`, `total`, `payment`, `note`, `remark`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'IP2022072106374862d8d81cd0b45', 1, NULL, '1', '2022-07-21 04:37:48', '2000.00', NULL, '0.00', '2000.00', '2000.00', NULL, 'PAID', '2022-07-21 04:37:48', NULL, '0000-00-00 00:00:00', NULL, 1),
(2, 'IP2022072106394462d8d890cb510', 1, NULL, '2', '2022-07-21 04:39:44', '2000.00', NULL, '400.00', '1600.00', '1600.00', NULL, 'PAID', '2022-07-21 04:39:44', NULL, '0000-00-00 00:00:00', NULL, 1),
(3, 'IP22072106493462d8dade5d8af', 2, '[\"5\",\"6\"]', NULL, '2022-07-21 00:49:34', '3200.00', '0', '0.00', '3200.00', '200.00', NULL, 'DUE', '2022-07-21 04:49:34', NULL, '0000-00-00 00:00:00', NULL, 1);




