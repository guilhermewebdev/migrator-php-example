CREATE TABLE tasks (
    id              BIGINT AUTO_INCREMENT NOT NULL,
    title           TINYTEXT DEFAULT "",
    description     MEDIUMTEXT DEFAULT "",
    due_date        DATETIME DEFAULT NULL,
    is_completed    BOOLEAN DEFAULT 0,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
);