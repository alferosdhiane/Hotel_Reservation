CREATE TABLE bookings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    guest_name VARCHAR(100) NOT NULL,

    guest_email VARCHAR(100) NOT NULL,

    room_type VARCHAR(50) NOT NULL,

    check_in DATE NOT NULL,

    check_out DATE NOT NULL,

    guests INT NOT NULL,

    message TEXT,

    total_amount DECIMAL(10,2),

    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);