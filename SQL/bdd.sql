CREATE DATABASE spacenews;
USE spacenews;

CREATE TABLE users(
   user_id INT AUTO_INCREMENT PRIMARY KEY,
   user_email VARCHAR(100) NOT NULL UNIQUE,
   user_password VARCHAR(255) NOT NULL,
   user_first_name VARCHAR(100) NOT NULL,
   user_last_name VARCHAR(100) NOT NULL,
   user_role VARCHAR(50) NOT NULL DEFAULT 'user',
   user_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   user_updated_at DATETIME,
   user_last_login DATETIME
);

CREATE TABLE systems(
   system_id INT AUTO_INCREMENT PRIMARY KEY,
   system_name VARCHAR(100) NOT NULL UNIQUE,
   system_type VARCHAR(50) NOT NULL,
   system_star_count INT NOT NULL,
   system_description TEXT,
   system_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories(
   category_id INT AUTO_INCREMENT PRIMARY KEY,
   category_name VARCHAR(100) NOT NULL,
   category_description TEXT
);

INSERT INTO categories (category_name, category_description)
VALUES
('Trous noirs', 'Articles liés aux trous noirs et à leurs caractéristiques.'),
('Nébuleuses', 'Articles sur les nébuleuses et la formation d\'étoiles.'),
('Satellites', 'Articles sur les satellites artificiels et naturels.'),
('Premières missions spatiales', 'Articles sur les premières missions spatiales habitées et non habitées.'),
('Planètes', 'Articles sur les planètes de notre système solaire.'),
('Exoplanètes', 'Articles sur les planètes hors du système solaire.'),
('Étoiles', 'Articles sur les étoiles et leurs propriétés.'),
('Galaxies', 'Articles sur les galaxies et leur structure.'),
('Télescopes', 'Articles sur les télescopes et instruments d\'observation.'),
('Exploration spatiale', 'Articles sur l\'exploration de l\'espace et des planètes.'),
('Technologies spatiales', 'Articles sur les technologies utilisées dans l\'espace.'),
('Vie extraterrestre', 'Articles sur la recherche de vie extraterrestre.'),
('Cosmologie', 'Articles sur la cosmologie et l\'évolution de l\'univers.');



CREATE TABLE articles(
   article_id INT AUTO_INCREMENT PRIMARY KEY,
   article_title VARCHAR(200) NOT NULL,
   article_resume VARCHAR(255) NOT NULL,
   article_content TEXT NOT NULL,
   article_image_path VARCHAR(255) NOT NULL,
   article_published_date DATETIME NOT NULL,
   article_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   article_updated_at DATETIME,
   article_status VARCHAR(20) NOT NULL DEFAULT 'draft',
   article_views INT DEFAULT 0,
   article_user_id INT NOT NULL,
   FOREIGN KEY(article_user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE commentary(
   comment_id INT AUTO_INCREMENT PRIMARY KEY,
   comment_content TEXT NOT NULL,
   comment_status VARCHAR(20) DEFAULT 'pending',
   comment_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   comment_updated_at DATETIME,
   comment_parent_id INT,
   comment_article_id INT NOT NULL,
   comment_user_id INT NOT NULL,
   FOREIGN KEY(comment_parent_id) REFERENCES commentary(comment_id) ON DELETE CASCADE,
   FOREIGN KEY(comment_article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
   FOREIGN KEY(comment_user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE forms(
   form_id INT AUTO_INCREMENT PRIMARY KEY,
   form_lastname VARCHAR(50) NOT NULL,
   form_firstname VARCHAR(50) NOT NULL,
   form_email VARCHAR(100) NOT NULL UNIQUE,
   form_tel VARCHAR(20) NOT NULL,
   form_password VARCHAR(255) NOT NULL,
   form_message VARCHAR(250) NOT NULL,
   form_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE planets(
   planet_id INT AUTO_INCREMENT PRIMARY KEY,
   planet_name VARCHAR(100) NOT NULL UNIQUE,
   planet_type VARCHAR(100) NOT NULL,
   planet_diameter DECIMAL(15,2) NOT NULL,
   planet_sun_distance DECIMAL(15,2) NOT NULL,
   planet_mass DECIMAL(20,2) NOT NULL,
   planet_moons_count INT DEFAULT 0,
   planet_image_path VARCHAR(255),
   planet_description TEXT,
   planet_orbital_period DECIMAL(15,2),
   planet_rotation_period DECIMAL(15,2),
   planet_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   planet_updated_at DATETIME,
   system_id INT NOT NULL,
   FOREIGN KEY(system_id) REFERENCES systems(system_id) ON DELETE CASCADE
);

CREATE TABLE article_categories(
   article_id INT,
   category_id INT,
   PRIMARY KEY(article_id, category_id),
   FOREIGN KEY(article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
   FOREIGN KEY(category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);
