
DROP DATABASE IF EXISTS laravel;
CREATE DATABASE IF NOT EXISTS laravel;
USE laravel;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-06:00";

-- ************************************************************************* --
-- * Framework Laravel
-- ************************************************************************* --
DROP TABLE IF EXISTS failed_jobs;
CREATE TABLE failed_jobs
(
    id         BIGINT       UNSIGNED                   NOT NULL AUTO_INCREMENT,
    uuid       VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    connection TEXT         COLLATE utf8mb4_unicode_ci NOT NULL,
    queue      TEXT         COLLATE utf8mb4_unicode_ci NOT NULL,
    payload    TEXT         COLLATE utf8mb4_unicode_ci NOT NULL,
    exception  TEXT         COLLATE utf8mb4_unicode_ci NOT NULL,
    failed_at  TIMESTAMP                               NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkFailedJob  PRIMARY KEY (id),
    CONSTRAINT ukFailedJob  UNIQUE KEY  (uuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS migrations;
CREATE TABLE migrations
(
    id         INT          UNSIGNED                   NOT NULL AUTO_INCREMENT,
    migration  VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    batch      INT                                     NOT NULL,
    CONSTRAINT pkMigration  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS password_reset_tokens;
CREATE TABLE password_reset_tokens
(
    email      VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    token      VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at TIMESTAMP                                   NULL DEFAULT NULL,
    CONSTRAINT pkPasswordResetToken PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS personal_access_tokens;
CREATE TABLE personal_access_tokens
(
    id             BIGINT       UNSIGNED                   NOT NULL AUTO_INCREMENT,
    tokenable_type VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    tokenable_id   BIGINT       UNSIGNED                   NOT NULL,
    name           VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    token          VARCHAR(64)  COLLATE utf8mb4_unicode_ci NOT NULL,
    abilities      TEXT         COLLATE utf8mb4_unicode_ci,
    last_used_at   TIMESTAMP                                    NULL DEFAULT NULL,
    expires_at     TIMESTAMP                                    NULL DEFAULT NULL,
    created_at     TIMESTAMP                                    NULL DEFAULT NULL,
    updated_at     TIMESTAMP                                    NULL DEFAULT NULL,
    CONSTRAINT     pkPersonalAccessToken PRIMARY KEY (id),
    CONSTRAINT     pkPersonalAccessToken UNIQUE KEY  (token),
    KEY personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type,tokenable_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id                BIGINT       UNSIGNED                   NOT NULL AUTO_INCREMENT,
    name              VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    email             VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    password          VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    status            VARCHAR(20)  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
    email_verified_at TIMESTAMP                                   NULL DEFAULT NULL,
    remember_token    VARCHAR(100) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    created_at        TIMESTAMP                                   NULL DEFAULT NULL,
    updated_at        TIMESTAMP                                   NULL DEFAULT NULL,
    deleted_at        TIMESTAMP                                   NULL DEFAULT NULL,
    CONSTRAINT        pkUser PRIMARY KEY (id),
    CONSTRAINT        pkUser UNIQUE KEY  (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ************************************************************************* --
-- * Development App
-- ************************************************************************* --
DROP TABLE IF EXISTS brands;
CREATE TABLE IF NOT EXISTS brands
(
    id          INT         UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id     INT         UNSIGNED                       NULL DEFAULT 1,
    description VARCHAR(65) COLLATE utf8mb4_unicode_ci     NULL,
    status      CHAR(15)    COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at  TIMESTAMP   COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    updated_at  TIMESTAMP   COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    deleted_at  TIMESTAMP   COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT  pkBrand     PRIMARY KEY(id),
    CONSTRAINT  ukBrand     UNIQUE(description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS printers;
CREATE TABLE IF NOT EXISTS printers
(
    id          INT          UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id     INT          UNSIGNED                       NULL DEFAULT 1,
    brand_id    INT          UNSIGNED                       NULL DEFAULT 1,
    serial      VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL,
    model       VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    description VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    image       VARCHAR(255) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    location    VARCHAR(225) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    observation TEXT         COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    cost        DOUBLE                                      NULL DEFAULT 0,
    status      CHAR(15)     COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    updated_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    deleted_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT  pkPrinter    PRIMARY KEY(id),
    CONSTRAINT  ukPrinter    UNIQUE(serial)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS cartridges;
CREATE TABLE IF NOT EXISTS cartridges
(
    id          INT          UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id     INT          UNSIGNED                       NULL DEFAULT 1,
    printer_id  INT          UNSIGNED                       NULL DEFAULT 1,
    brand_id    INT          UNSIGNED                       NULL DEFAULT 1,
    model       VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    image       VARCHAR(255) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    description VARCHAR(255) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    color       VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status      CHAR(15)     COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    updated_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    deleted_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT  pkCartridge  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS files;
CREATE TABLE IF NOT EXISTS files
(
    id          INT          UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id     INT          UNSIGNED                       NULL DEFAULT 1,
    printer_id  INT          UNSIGNED                       NULL DEFAULT 1,
    title       VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    filename    VARCHAR(65)  COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    observation TEXT         COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status      CHAR(15)     COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    updated_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    deleted_at  TIMESTAMP    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT  pkFile       PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS stock;
CREATE TABLE IF NOT EXISTS stock
(
    id           INT      UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id      INT      UNSIGNED                       NULL DEFAULT 1,
    cartridge_id INT      UNSIGNED                       NULL DEFAULT 1,
    quantity     DOUBLE                                  NULL DEFAULT 0,
    _quantity    DOUBLE                                  NULL DEFAULT 0,      -- Calculo de existencia
    cost         DOUBLE                                  NULL DEFAULT 0,
    type         SMALLINT                                NULL DEFAULT 1,      -- 0 - Salida del almacén || 1 - Entrada al almacén
    observation  TEXT     COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status       CHAR(15) COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at   DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    updated_at   DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    deleted_at   DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT   pkStock PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS maintenances;
CREATE TABLE IF NOT EXISTS maintenances
(
    id                 INT         UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id            INT         UNSIGNED                       NULL DEFAULT 1,
    printer_id         INT         UNSIGNED                       NULL DEFAULT 1,
    internal           BOOLEAN                                    NULL DEFAULT FALSE,
    date_init          DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    date_finish        DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    date_cancel        DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    user_name          VARCHAR(65) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    cost               DOUBLE                                     NULL DEFAULT 0,
    observation_init   TEXT        COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    observation_finish TEXT        COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    observation_cancel TEXT        COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status             CHAR(30)    COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at         DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    updated_at         DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NOW(),
    deleted_at         DATETIME    COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT         pkMaintenance PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS archives;
CREATE TABLE IF NOT EXISTS archives
(
    id             INT          UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id        INT          UNSIGNED                       NULL DEFAULT 1,
    maintenance_id INT          UNSIGNED                       NULL DEFAULT 1,
    title          VARCHAR(255) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    file           VARCHAR(255) COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    observation    TEXT         COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status         CHAR(15)     COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at     DATETIME     COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    updated_at     DATETIME     COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    deleted_at     DATETIME     COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT     pkStock PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS follows;
CREATE TABLE IF NOT EXISTS follows
(
    id             INT      UNSIGNED                   NOT NULL AUTO_INCREMENT,
    user_id        INT      UNSIGNED                       NULL DEFAULT 1,
    maintenance_id INT      UNSIGNED                       NULL DEFAULT 1,
    observation    TEXT     COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    status         CHAR(15) COLLATE utf8mb4_unicode_ci     NULL DEFAULT "Activo",
    created_at     DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    updated_at     DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    deleted_at     DATETIME COLLATE utf8mb4_unicode_ci     NULL DEFAULT NULL,
    CONSTRAINT     pkStock PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ************************************************************************* --
-- * Insert
-- ************************************************************************* --
INSERT INTO users(id, name, email, password, status, created_at) VALUES
    (001, 'demo', 'demo@demo.com', '$2y$12$.WqbqlNf54WrTfAl2Qe.Zuea13qUZ9dK75pKHHp.RIfvau1qpEbAu', 'Activo', NOW()); -- Password#321

INSERT INTO brands (id, description, status, created_at, updated_at, deleted_at) VALUES
    (001, '(NINGUNO)', 'Active', '2024-01-01 00:00:00', '2024-01-01 00:00:00', NULL);

INSERT INTO cartridges (id, printer_id, model, image, description, color, status, created_at, updated_at, deleted_at) VALUES
    (001, 001, '(Ninguno)'        , NULL, '(Ninguno)'                                                    , '(Ninguno)', 'Active', '2024-01-01 00:00:00', '2024-01-01 00:00:00', NULL);

INSERT INTO printers (id, brand_id, serial, model, description, image, location, observation, status, created_at, updated_at, deleted_at) VALUES
    (001, 001, '(NINGUNO)'       , '(NINGUNO)'  , '(NINGUNO)'                                , NULL, '(NINGUNO)'                             , NULL           , 'Active', '2024-01-01 00:00:00', '2024-01-01 00:00:00', NULL);

DROP VIEW IF EXISTS _stock;
CREATE VIEW IF NOT EXISTS _stock AS
SELECT cartridge_id, SUM(_quantity) AS quantity
FROM stock
WHERE 1=1
	AND status = 'Active'
GROUP BY cartridge_id;
