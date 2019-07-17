`drive` ( `driver_id` int(11) NOT NULL, `identity_id` int(11) NOT NULL COMMENT 'FK id type', `address_id` int(11) NOT NULL COMMENT 'FK id type', `wedge_type` int(11) NOT NULL COMMENT 'FK wedge type', `driver_name` varchar(40) NOT NULL, `driver_number` varchar(15) NOT NULL, `driver_email` varchar(30) NOT NULL, `driver_address` text NOT NULL, `driver_photo` text NOT NULL, `identy_id_no` varchar(30) NOT NULL, `address_id_no` varchar(30) NOT NULL, `identity_link` text NOT NULL, `address_link` text NOT NULL, `salary` int(11) NOT NULL, `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `identity_doc` ( `identity_id` int(11) NOT NULL, `id_name` varchar(40) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

 CREATE TABLE `product_purchase` ( `pp_id` int(11) NOT NULL, `pp_name` varchar(30) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

 CREATE TABLE `trip_status` ( `ts_id` int(11) NOT NULL, `ts_status` varchar(15) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

 CREATE TABLE `tyre_run` ( `tyre_id` int(11) NOT NULL, `vm_id` int(11) NOT NULL, `tyre_run` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

  CREATE TABLE `vehicle` ( `vehicle_id` int(11) NOT NULL, `ts_id` int(11) DEFAULT NULL, `trip_status` int(11) DEFAULT NULL COMMENT 'running, stop', `vehicle_number` varchar(1000) NOT NULL, `vehicle_purchase_year` varchar(1000) NOT NULL, `vehicle_permit` varchar(1000) NOT NULL, `vehicle_tyres` int(11) NOT NULL, `vehicle_current_reading` int(11) NOT NULL, `vehicle_load_capacity` float NOT NULL, `vehicle_chassis_no` varchar(1000) NOT NULL, `vehicle_engine_no` int(11) NOT NULL, `vehicle_type` int(11) NOT NULL, `vehicle_expected_average` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

 CREATE TABLE `vehicle_maintenance` ( `vm_id` int(11) NOT NULL, `vehicle_id` int(11) NOT NULL, `pp_id` int(11) NOT NULL, `vm_date` date NOT NULL, `vm_name` varchar(40) NOT NULL, `vm_km` int(11) NOT NULL COMMENT 'current KM', `vm_bill_no` varchar(40) NOT NULL, `vm_amount` int(11) NOT NULL, `vm_tire_no` varchar(40) DEFAULT NULL COMMENT 'only applicable for tires', `vm_serial_no` varchar(40) DEFAULT NULL COMMENT 'battery only', `vm_warranty` int(11) DEFAULT NULL, `vm_note` text, `vm_expiry_date` date NOT NULL COMMENT 'PUC,Permit' ) ENGINE=InnoDB DEFAULT CHARSET=latin1

 CREATE TABLE `wedge_type` ( `wt_id` int(11) NOT NULL, `wt_name` varchar(40) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1

