# Real-Time Chat Application

## Project Overview

This project is a real-time chat web application that I initially found as a source code. I undertook this project to enhance my skills in front-end development and practice working collaboratively with ChatGPT to implement new features and improve existing functionalities.

## Project Features

1. **Real-Time Messaging**: Allows users to send and receive messages instantly.
2. **User Authentication**: Secure user login and registration.
3. **Profile Management**: Users can update their profiles, including profile pictures, first name, last name, and password.
4. **Search Functionality**: Users can search for other users to chat with.
5. **Admin Functionality**: Admins can view user details, delete user accounts, and block users from sending messages.
6. **File Sharing**: Users can send images and other files in the chat.
7. **Chat Management**: Users can delete their chat history.
8. **User Blocking**: Users can block other users from sending them messages.

## My Contributions

- **Front-End Development**: I updated the front-end of the application on my own, which helped me practice and enhance my skills in HTML, CSS, and JavaScript.
- **New Functionality**: I worked with ChatGPT to add new features such as admin functionality, user blocking, and chat management.

## How the Project Works

### 1. User Registration and Login

- Users can register with their email, password, and profile information.
- Users can log in with their credentials to access the chat application.

### 2. Real-Time Messaging

- Users can search for other users and start a chat.
- Messages are sent and received in real-time using AJAX and PHP.

### 3. Profile Management

- Users can update their profile information from the profile settings page.
- Users can upload a profile picture, change their first name, last name, and password.

### 4. Admin Functionality

- Admins can view all user details and have the ability to delete user accounts.
- Admins can block users from sending messages to others.

### 5. File Sharing

- Users can attach and send images or other files in their chats.
- The chosen file name is displayed beside the attachment icon.

### 6. Chat Management

- Users can delete their chat history, removing all messages shared with a particular user.

### 7. User Blocking

- Users can block other users from sending them messages.
- Blocked users are stored in a separate table to prevent them from sending messages to the blocker.

## Database Structure

### Users Table

```sql
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `ProfileName` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4;
```

### Messages Table

```sql
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `iv` varchar(255) NOT NULL,
  PRIMARY KEY (`msg_id`),
  FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`unique_id`),
  FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
```

### MessageImages Table

```sql
CREATE TABLE `message_images` (
  `msg_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  FOREIGN KEY (`msg_id`) REFERENCES `messages` (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### BlockedUsers Table

```sql
CREATE TABLE `blocked_users` (
  `blocker_id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL,
  PRIMARY KEY (`blocker_id`, `blocked_id`),
  FOREIGN KEY (`blocker_id`) REFERENCES `users` (`unique_id`),
  FOREIGN KEY (`blocked_id`) REFERENCES `users` (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Getting Started

### Prerequisites

- Web server (e.g., Apache, Nginx)
- PHP
- MySQL
- Web browser (for accessing the application)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/da-nielh/real-time-chat-app.git
   ```
2. Import the database:

   - Create a database named `chatapp`.
   - Import the `chatapp.sql` file located in the project directory.

3. Configure the database connection:

   - Open `php/config.php` and update the database connection details.

4. Start the web server and access the application in your browser:
   ```bash
   http://localhost/real-time-chat-app
   ```

## Conclusion

This real-time chat application project has been a valuable learning experience. By updating the front-end independently, I honed my skills in web development. Working with ChatGPT allowed me to practice writing effective prompts and collaboratively implement new features, enhancing my overall programming abilities.

Feel free to explore the project and contribute to its improvement. Thank you for your interest!

---

Daniel H.

da-nielh
