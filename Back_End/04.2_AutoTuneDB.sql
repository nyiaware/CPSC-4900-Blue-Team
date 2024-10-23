-- Drop the database if it exists (optional)
DROP DATABASE IF EXISTS AutoTuneDB;

-- Create the database
CREATE DATABASE AutoTuneDB;
USE AutoTuneDB;
CREATE TABLE UserProfiles (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(255),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(255),
    RegistrationDate DATETIME DEFAULT NOW(),
    LastLoginDate DATETIME
);
CREATE TABLE VehicleInformation (
    VehicleID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Make VARCHAR(50),
    Model VARCHAR(50),
    Year INT,
    VIN VARCHAR(50),
    Mileage INT,
    FuelConsumption DECIMAL(10, 2),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE ServiceMaintenance (
    ServiceID INT AUTO_INCREMENT PRIMARY KEY,
    VehicleID INT,
    ServiceType VARCHAR(100),
    ServiceProvider VARCHAR(255),
    ServiceDate DATETIME,
    Cost DECIMAL(10, 2),
    NextMaintenanceDate DATETIME,
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE
);
CREATE TABLE DiagnosticsTuning (
    DiagnosticID INT AUTO_INCREMENT PRIMARY KEY,
    VehicleID INT,
    DiagnosticData TEXT,
    TuningParameters TEXT,
    Date DATETIME DEFAULT NOW(),
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE
);
CREATE TABLE ProductFeatures (
    FeatureID INT AUTO_INCREMENT PRIMARY KEY,
    FeatureName VARCHAR(255),
    Description TEXT,
    FeatureStatus ENUM('Active', 'Inactive'),
    Pricing DECIMAL(10, 2)
);
CREATE TABLE Roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,
    RoleDescription VARCHAR(255)
);
CREATE TABLE UserRoles (
    UserRoleID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    RoleID INT,
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE,
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE
);
CREATE TABLE AuditLogs (
    LogID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    ActionTaken VARCHAR(255),
    Timestamp DATETIME DEFAULT NOW(),
    Status ENUM('Success', 'Failure'),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE AuthTokens (
    TokenID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Token VARCHAR(255),
    ExpiryDate DATETIME,
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE UserSettings (
    SettingID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    SettingName VARCHAR(255),
    SettingValue VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE Notifications (
    NotificationID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    NotificationContent TEXT,
    CreatedAt DATETIME DEFAULT NOW(),
    ReadStatus ENUM('Read', 'Unread'),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Amount DECIMAL(10, 2),
    PaymentDate DATETIME DEFAULT NOW(),
    PaymentMethod ENUM('Credit Card', 'Debit Card', 'PayPal'),
    TransactionStatus ENUM('Success', 'Failed'),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE
);
CREATE TABLE ServiceReminders (
    ReminderID INT AUTO_INCREMENT PRIMARY KEY,
    VehicleID INT,
    ReminderDate DATETIME,
    ServiceType VARCHAR(100),
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE
);
CREATE TABLE ReportSchedule (

    ScheduleID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    VehicleID INT,
    ReportType VARCHAR(100),
    Frequency VARCHAR(50),
    Email VARCHAR(100),
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE,
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE
);
-- Show All Tables
SHOW TABLES;
-- Describe Tables
DESCRIBE UserProfiles;
DESCRIBE VehicleInformation;
DESCRIBE ServiceMaintenance;
DESCRIBE DiagnosticsTuning;
DESCRIBE ProductFeatures;
DESCRIBE Roles;
DESCRIBE UserRoles;
DESCRIBE AuditLogs;
DESCRIBE AuthTokens;
DESCRIBE UserSettings;
DESCRIBE Notifications;
DESCRIBE Payments;
DESCRIBE ServiceReminders;
DESCRIBE ReportSchedule;