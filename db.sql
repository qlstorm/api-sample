CREATE TABLE IF NOT EXISTS `requests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50),
	`email` VARCHAR(50),
	`status` ENUM('Active','Resolved') NULL DEFAULT 'Active',
	`message` TEXT,
	`comment` TEXT,
	`created_at` TIMESTAMP NULL DEFAULT (now()),
	`updated_at`  TIMESTAMP NULL DEFAULT (now()),
	PRIMARY KEY (`id`) USING BTREE
);
