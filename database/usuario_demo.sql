USE campusbook;
INSERT INTO users (name,email,password_hash,role) VALUES ('Estudiante Demo','estudiante@campusbook.local','$2y$12$8t4lotPYqJSBKPaKDbVmJ.bbvTNgUixN4ntCRjTU/lMT8sV9WohJ6','student') ON DUPLICATE KEY UPDATE name=VALUES(name);
