-- COMP4711 Team Durian
-- BotFactory schema

-- bots table
DROP TABLE IF EXISTS `bots`;
CREATE TABLE IF NOT EXISTS `bots` (
    `id`          INT AUTO_INCREMENT,
    `model`       CHAR(1) NOT NULL,     -- a, b, c
    `pieces`      VARCHAR(30) NOT NULL, -- parts
    `isValid`     CHAR(1) DEFAULT '1',
    PRIMARY KEY(`id`)
);

-- parts table
DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
    `id`          VARCHAR(8) NOT  NULL,-- ca code
    `model`       CHAR(1) NOT NULL,    -- a, b, c
    `piece`       CHAR(1) NOT NULL,    -- 1, 2, 3
    `plant`       VARCHAR(30),         -- plant
    `stamp`       DATETIME,            -- 2017-03-09 10:10:01
    PRIMARY KEY(`id`)
);

-- history table
DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
    `id`          INT AUTO_INCREMENT,
    `transId`     CHAR(10),            -- T171234567
    `transDate`   DATETIME,            -- 2017-10-09 10:02:01
    `type`        CHAR(1),             -- 0-purchase, 1-sell/shipment, 2-return
    `amount`      FLOAT(8,2),          -- 100.50
    `detail`      VARCHAR(100),
    `isValid`     CHAR(1) DEFAULT '1',
    PRIMARY KEY(`id`)
);

-- unit price table
DROP TABLE IF EXISTS `unitprice`;
CREATE TABLE IF NOT EXISTS `unitprice` (
    `type`      CHAR(1) NOT NULL,      -- 0-purchase/build, 1-sell/shipment, 2-return
    `price`     FLOAT(8,2) NOT NULL    -- 20.00
);

-- Session table
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id`          VARCHAR(128) NOT NULL,
    `ip_address`  VARCHAR(45) NOT NULL,
    `timestamp`   INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    `data`        BLOB NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`),
    PRIMARY KEY(`id`)
);

-- properties table
DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
    `id`    VARCHAR(16) NOT NULL,
    `value` VARCHAR(256) NOT NULL,
    PRIMARY KEY(`id`)
);


