-- GLR Collabs Database Schema
-- Created: 2025-10-16

-- Create database
CREATE DATABASE IF NOT EXISTS glr_collabs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE glr_collabs;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
);

-- Categories table (GLR courses)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL UNIQUE,
    description TEXT,
    color_class VARCHAR(50) DEFAULT 'gray',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert categories: GLR courses
INSERT INTO categories (name, description, color_class) VALUES
('Mediavormgeven', 'Creatief ontwerpen van media-uitingen zoals websites, animaties, apps en magazines.', 'blue'),
('AV-specialist', 'Audiovisuele producties maken: camera, geluid, montage, van social media tot bedrijfsvideo en film.', 'purple'),
('Fotografie', 'Professioneel fotograferen in studio en op locatie, ontwikkeling van eigen stijl en portfolio.', 'pink'),
('Mediamanager', 'Leidinggeven, organiseren en managen van mediaprojecten en mediateams.', 'green'),
('Redactiemedewerker', 'Schrijven, redigeren en publiceren van content voor media en communicatie, online en print.', 'yellow'),
('Creative Software Developer', 'Ontwikkelen van creatieve softwaretoepassingen, websites en digitale ervaringen.', 'indigo'),
('Immersive Experience', 'Creëren van meeslepende multimedia-ervaringen zoals VR en interactieve installaties.', 'orange'),
('ICT & Mediatechnologie', 'Ondersteunen en beheren van ICT-infrastructuren gericht op de mediasector.', 'red'),
('Mediamaker', 'Breed inzetbare mediavakman: ontwerp, video, audio, fotografie en meer.', 'cyan'),
('Allround Mediamaker', 'Verkennen en combineren van meerdere mediavakgebieden in projecten.', 'teal'),
('Medewerker Sign', 'Realiseren van visuele communicatie in signbranche, interieur en exterieur.', 'brown'),
('Podium- en Evenemententechniek', 'Technisch ondersteunen van evenementen, licht, geluid en podiumbouw.', 'black');

-- Projects/Requests table
CREATE TABLE collaboration_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(120) DEFAULT 'general',
    status ENUM('active', 'in_progress', 'completed', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deadline DATE NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
);

-- Responses to requests table
CREATE TABLE collaboration_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    responder_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'accepted') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES collaboration_requests(id) ON DELETE CASCADE,
    FOREIGN KEY (responder_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_request_id (request_id),
    INDEX idx_responder_id (responder_id),
    INDEX idx_status (status),
    UNIQUE KEY unique_response (request_id, responder_id)
);

-- User skills table (for future expansion)
CREATE TABLE user_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_name VARCHAR(100) NOT NULL,
    proficiency_level ENUM('beginner', 'intermediate', 'advanced', 'expert') DEFAULT 'intermediate',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_skill_name (skill_name),
    UNIQUE KEY unique_user_skill (user_id, skill_name)
);

-- Sample test user (password is 'password123')
INSERT INTO users (full_name, email, password) VALUES
('Test User', 'test@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample requests
INSERT INTO collaboration_requests (user_id, title, description, category) VALUES
(1,'Mediavormgeven portfolio feedback', 'Kan iemand mijn magazine-ontwerp beoordelen vanuit een professionalsblik?', 'Mediavormgeven'),
(1, 'AV-specialist gezocht voor event video', 'Wij zoeken extra handen voor een livestream en aftermovie montage.', 'AV-specialist');

-- Performance indexes
CREATE INDEX idx_requests_category_status ON collaboration_requests(category, status);
CREATE INDEX idx_responses_created_at ON collaboration_responses(created_at);
CREATE INDEX idx_users_last_login ON users(last_login);

-- Useful views
CREATE VIEW active_requests AS
SELECT 
    cr.id,
    cr.title,
    cr.description,
    cr.category,
    cr.created_at,
    cr.deadline,
    u.full_name as author_name,
    u.email as author_email,
    (SELECT COUNT(*) FROM collaboration_responses WHERE request_id = cr.id) as response_count
FROM collaboration_requests cr
JOIN users u ON cr.user_id = u.id
WHERE cr.status = 'active' AND u.is_active = TRUE
ORDER BY cr.created_at DESC;

CREATE VIEW user_stats AS
SELECT 
    u.id,
    u.full_name,
    u.email,
    COUNT(DISTINCT cr.id) as requests_posted,
    COUNT(DISTINCT resp.id) as responses_given,
    u.created_at as joined_date,
    u.last_login
FROM users u
LEFT JOIN collaboration_requests cr ON u.id = cr.user_id
LEFT JOIN collaboration_responses resp ON u.id = resp.responder_id
WHERE u.is_active = TRUE
GROUP BY u.id;

-- Success message
SELECT 'Database setup completed successfully!' as message;
