CREATE TABLE event_reservation (
  
  id INT AUTO_INCREMENT PRIMARY KEY,
  
  full_name VARCHAR(60) NOT NULL,
  
  email_address VARCHAR(50) NOT NULL,
  
  contact_number VARCHAR(11) NOT NULL,
  
  event_type VARCHAR(50) NOT NULL,
  
  event_date DATE NOT NULL,
  
  event_time DATE NOT NULL,
  
  number_of_guests INT NOT NULL,
  
  preffered_venue VARCHAR(50) NOT NULL,

  catering_preference VARCHAR(50) NOT NULL,
  
  special_request TEXT,
  
  eventReservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
);
