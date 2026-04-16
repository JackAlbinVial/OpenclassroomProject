-- Suppression de la base de données pour pouvoir relancer le script en cas de problème sur les données
DROP DATABASE gestion_contacts;

-- Création de la base de données (si elle n'existe pas déjà)
CREATE DATABASE IF NOT EXISTS gestion_contacts;
USE gestion_contacts;

-- Création de la table 'contact'
CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL
);

-- Insertion de contacts de test
INSERT INTO contact (name, email, phone_number) VALUES 
('Alice Martin', 'alice.martin@email.com', '0601020304'),
('Jean Dupont', 'jean.dupont@email.com', '0708091011'),
('Sylvie Bonnet', 'sylvie.bonnet@email.com', '0789101112');