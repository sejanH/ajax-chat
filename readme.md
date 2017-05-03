# Simple chat app

This is a simple chatting interface build with ajax, php and mysql

## Getting Started

Go to your phpmyadmin and create a database named #chat. then in the SQL tab paste these code
```
CREATE TABLE `person` (
  `username` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `DoB` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `person`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);
  
  CREATE TABLE `message` (
  `sender` varchar(20) NOT NULL,
  `reciepient` varchar(20) NOT NULL,
  `msg` varchar(200) NOT NULL,
  `sentAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `message`
  ADD UNIQUE KEY `sentAt` (`sentAt`),
  ADD KEY `sender` (`sender`),
  ADD KEY `reciepient` (`reciepient`) USING BTREE;
ALTER TABLE `message`
  ADD CONSTRAINT `fk_reciepient` FOREIGN KEY (`reciepient`) REFERENCES `person` (`username`),
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender`) REFERENCES `person` (`username`);
```
-- to enable foreign key constraints your database type shuould be InnoDB
N.B: It works even without the foreign key constraints

### Prerequisites

- php v5.6 or higher
- mysql any version
- jQuery v3.1 or any
- Bootstrap css and js (design)

### Installing

Copy the code and paste into your git bash to clone my code

```
https://github.com/sejanH/ajax-chat.git
```


## Author

* **S.M.Mominul Haque** - [sejanH](https://github.com/sejanH)
* Twitter - [sejanH](https://twitter.com/sejanH)

## License

Just don't forget to give credit to the real author
