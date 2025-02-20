CREATE TABLE comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    id_user INT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id)
);
