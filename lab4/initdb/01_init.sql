CREATE DATABASE IF NOT EXISTS secsite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE secsite;

CREATE TABLE IF NOT EXISTS administrators (
  adminID INT NOT NULL AUTO_INCREMENT,
  emailAddress VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  firstName VARCHAR(60),
  lastName VARCHAR(60),
  PRIMARY KEY (adminID)
);

-- Demo login: admin@example.com / s3sam3
INSERT INTO administrators (emailAddress, password, firstName, lastName)
VALUES (
  'admin@example.com',
  '$2y$10$xIqN2cVy8HVuKNKUwxFQR.xRP9oRj.FF8r52spVc.XCaEFy7iLHmu',
  'Admin', 'Demo'
);
