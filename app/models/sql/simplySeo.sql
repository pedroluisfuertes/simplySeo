

CREATE TABLE `sites` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `domain` VARCHAR(100) NOT NULL,
  `gitRepo` VARCHAR(100) NOT NULL,
  `googleAnalytics` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uq_domain` (`domain` ASC)
);

CREATE TABLE `post` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `siteId` BIGINT NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `metaTitle` VARCHAR(100) NOT NULL,
  `link` VARCHAR(100) NOT NULL,
  `metaDescription` VARCHAR(100) NULL,
  `content` TEXT NULL DEFAULT NULL,
  `published` TINYINT(1) NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `publishedAt` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uq_link` (`link` ASC),
  INDEX `idx_siteId` (`siteId` ASC),
  CONSTRAINT `fk_siteId` FOREIGN KEY (`siteId`) REFERENCES `sites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION);