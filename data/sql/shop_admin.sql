DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE IF NOT EXISTS `shop_admin`(
    `admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `admin_user` VARCHAR(32) NOT NULL DEFAULT '',
    `admin_pass` CHAR(32) NOT NULL DEFAULT '',
    `admin_email` VARCHAR(50) NOT NULL DEFAULT '',
    `login_time` INT UNSIGNED NOT NULL DEFAULT 0,
    `login_ip` BIGINT NOT NULL DEFAULT 0,
    `create_time` INT NOT NULL DEFAULT 0,
    PRIMARY KEY(`admin_id`),
    UNIQUE shop_admin_user_pass(`admin_user`, `admin_pass`),
    UNIQUE shop_admin_user_email(`admin_user`, `admin_email`)
)ENGINE = InnoDB DEFAULT charset = utf8;

INSERT INTO `shop_admin` (admin_user, admin_pass, admin_email, login_time, create_time) VALUES ('admin', md5('123'), 'test@test.test', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());