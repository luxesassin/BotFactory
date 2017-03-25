-- COMP4711 Team Durian
-- BotFactory schema

-- Bots table
DROP TABLE IF EXISTS Bots;
CREATE TABLE IF NOT EXISTS Bots (
    id          INT AUTO_INCREMENT,
    model       CHAR(1) NOT NULL,     -- A, B, C
    composition VARCHAR(30) NOT NULL, -- parts ca
    image       VARCHAR(30),          -- a.jpg
    isValid     CHAR(1) DEFAULT '1',
    PRIMARY KEY(id)
);

-- Parts table
DROP TABLE IF EXISTS Parts;
CREATE TABLE IF NOT EXISTS Parts (
    id          INT AUTO_INCREMENT,
    code        CHAR(2) NOT NULL,    -- A2, B1, C3
    ca          VARCHAR(8) NOT NULL, -- CA5001
    builtAt     VARCHAR(30),         -- BotFactory
    builtDate   DATETIME,            -- 2017-03-09 10:10:01
    image       VARCHAR(30),         -- b2.jpg
    isValid     CHAR(1) DEFAULT '1',
    PRIMARY KEY(id)
);

-- History table
DROP TABLE IF EXISTS History;
CREATE TABLE IF NOT EXISTS History (
    id          INT AUTO_INCREMENT,
    transId     CHAR(10),            -- T171234567
    transDate   DATETIME,            -- 2017-10-09 10:02:01
    type        CHAR(1),             -- 0-purchase, 1-shipment, 2-return
    amount      FLOAT(8,2),          -- 100.50
    detail      VARCHAR(100),
    isValid     CHAR(1) DEFAULT '1',
    PRIMARY KEY(id)
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

