/* 
    File: AutoTuneDB_Schema.sql
    Author: Christian Morrow
    Co-Author: Blanca Perez
    Project: AutoTune

    Description: 
    This SQL script establishes the schema for the AutoTune database, which includes:
        - User Profiles: Stores user account information with secure password handling.
        - Vehicle Information: Contains details about vehicles linked to users.
        - Service Maintenance: Logs maintenance records and related details.
        - Diagnostics and Tuning: Stores diagnostic data and tuning parameters for vehicles.
        - Audit Logs: Tracks user actions for auditing purposes.
        - Notifications: Manages user notifications and their statuses.
        - Payments: Records transaction details for services.
        - User Settings: Saves customizable settings for user preferences.
        - Service Reminders: Manages reminders for upcoming maintenance.
        - Report Schedule: Handles scheduling of reports for users and vehicles.

    Usage Notes:
    - Ensure the script is executed in an SQL environment compatible with MySQL syntax.
    - Verify that you have the necessary permissions to create databases and tables before execution.
    - The command `DROP DATABASE IF EXISTS AutoTuneDB;` should be used with caution, as it will delete the database if it exists.

    Revision History:
    - 2024-10-09: Initial schema setup based on team and project specifications.
    - 2024-11-02: Changes made include:
        - Improved file identification comments.
        - Renamed Password to HashedPassword in UserProfiles for clarity on encryption.
        - Added Color and LicensePlate fields in VehicleInformation for more detailed vehicle data.
        - Introduced Comments field in ServiceMaintenance for additional service notes.
        - Enhanced AuditLogs with IP_Address and ActionDetails for robust auditing.
        - Included NotificationType in Notifications to classify notifications (e.g., "Service Reminder," "Payment Confirmation").
        - Created indexes on frequently queried fields to boost query performance.
*/

-- Drop the existing database if it exists (optional)
DROP DATABASE IF EXISTS AutoTuneDB;

-- Create a new database for AutoTune
CREATE DATABASE AutoTuneDB;
USE AutoTuneDB;

-- Table for storing user profiles with encrypted password considerations
CREATE TABLE UserProfiles (
    UserID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each user
    Username VARCHAR(255) NOT NULL, -- User's chosen username
    HashedPassword VARCHAR(255) NOT NULL, -- Hashed password for security
    Email VARCHAR(255), -- User's email address
    PhoneNumber VARCHAR(20), -- User's phone number
    Address VARCHAR(255), -- User's address
    RegistrationDate DATETIME DEFAULT NOW(), -- Timestamp of user registration
    LastLoginDate DATETIME -- Timestamp of last login
);

-- Table for storing vehicle information related to users
CREATE TABLE VehicleInformation (
    VehicleID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each vehicle
    UserID INT, -- Reference to the owner user
    Make VARCHAR(50), -- Vehicle manufacturer
    Model VARCHAR(50), -- Vehicle model
    Year INT, -- Year of manufacture
    VIN VARCHAR(50), -- Vehicle Identification Number
    Mileage INT, -- Current mileage of the vehicle
    FuelConsumption DECIMAL(10, 2), -- Vehicle fuel consumption in relevant units
    Color VARCHAR(50), -- Vehicle color (new field)
    LicensePlate VARCHAR(50), -- Vehicle license plate (new field)
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Enforce user-vehicle relationship
);

-- Table for logging service maintenance records
CREATE TABLE ServiceMaintenance (
    ServiceID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each service entry
    VehicleID INT, -- Reference to the serviced vehicle
    ServiceType VARCHAR(100), -- Type of service performed
    ServiceProvider VARCHAR(255), -- Name of the service provider
    ServiceDate DATETIME, -- Date when the service was performed
    Cost DECIMAL(10, 2), -- Cost of the service
    NextMaintenanceDate DATETIME, -- Date for the next scheduled maintenance
    Comments TEXT, -- Additional comments or details about the service (new field)
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE -- Link to vehicle
);

-- Table for diagnostics and tuning records related to vehicles
CREATE TABLE DiagnosticsTuning (
    DiagnosticID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each diagnostic entry
    VehicleID INT, -- Reference to the associated vehicle
    DiagnosticData TEXT, -- Data collected during diagnostics
    TuningParameters TEXT, -- Parameters used for tuning
    Date DATETIME DEFAULT NOW(), -- Timestamp of the diagnostic entry
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE -- Link to vehicle
);

-- Table for managing product features related to the AutoTune service
CREATE TABLE ProductFeatures (
    FeatureID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each feature
    FeatureName VARCHAR(255), -- Name of the product feature
    Description TEXT, -- Description of the product feature
    FeatureStatus ENUM('Active', 'Inactive'), -- Status of the feature
    Pricing DECIMAL(10, 2) -- Pricing information for the feature
);

-- Table for defining roles within the application
CREATE TABLE Roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each role
    RoleDescription VARCHAR(255) -- Description of the role
);

-- Table for mapping users to their respective roles
CREATE TABLE UserRoles (
    UserRoleID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each user-role mapping
    UserID INT, -- Reference to the user
    RoleID INT, -- Reference to the assigned role
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE, -- Link to user
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE -- Link to role
);

-- Table for recording audit logs of user actions
CREATE TABLE AuditLogs (
    LogID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each log entry
    UserID INT, -- Reference to the user who performed the action
    ActionTaken VARCHAR(255), -- Description of the action performed
    ActionDetails TEXT, -- Detailed description of the action (new field)
    IP_Address VARCHAR(45), -- User's IP address (supports IPv4 and IPv6) (new field)
    Timestamp DATETIME DEFAULT NOW(), -- Timestamp of the action
    Status ENUM('Success', 'Failure'), -- Outcome of the action
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Link to user
);

-- Table for managing authentication tokens for session handling
CREATE TABLE AuthTokens (
    TokenID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each token
    UserID INT, -- Reference to the user associated with the token
    Token VARCHAR(255), -- The authentication token
    ExpiryDate DATETIME, -- Expiration date and time for the token
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Link to user
);

-- Table for storing user-specific settings
CREATE TABLE UserSettings (
    SettingID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each setting
    UserID INT, -- Reference to the user
    SettingName VARCHAR(255), -- Name of the setting
    SettingValue VARCHAR(255), -- Value of the setting
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Link to user
);

-- Table for managing user notifications
CREATE TABLE Notifications (
    NotificationID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each notification
    UserID INT, -- Reference to the user receiving the notification
    NotificationContent TEXT, -- Content of the notification
    NotificationType VARCHAR(50), -- Type of notification (new field)
    CreatedAt DATETIME DEFAULT NOW(), -- Timestamp of when the notification was created
    ReadStatus ENUM('Read', 'Unread'), -- Status of the notification
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Link to user
);

-- Table for recording payment transactions
CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each payment
    UserID INT, -- Reference to the user making the payment
    Amount DECIMAL(10, 2), -- Amount of the payment
    PaymentDate DATETIME DEFAULT NOW(), -- Date and time of the payment
    PaymentMethod ENUM('Credit Card', 'Debit Card', 'PayPal'), -- Method of payment
    TransactionStatus ENUM('Success', 'Failed'), -- Outcome of the transaction
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE -- Link to user
);

-- Table for scheduling service reminders for vehicles
CREATE TABLE ServiceReminders (
    ReminderID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each reminder
    VehicleID INT, -- Reference to the vehicle for which the reminder is set
    ReminderDate DATETIME, -- Date when the reminder is triggered
    ServiceType VARCHAR(100), -- Type of service to be reminded about
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE -- Link to vehicle
);

-- Table for scheduling reports based on user and vehicle
CREATE TABLE ReportSchedule (
    ScheduleID INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each report schedule
    UserID INT, -- Reference to the user for whom the report is scheduled
    VehicleID INT, -- Reference to the vehicle related to the report
    ReportType VARCHAR(100), -- Type of report to be generated
    Frequency VARCHAR(50), -- Frequency of report generation
    Email VARCHAR(100), -- Email address for report delivery
    FOREIGN KEY (UserID) REFERENCES UserProfiles(UserID) ON DELETE CASCADE, -- Link to user
    FOREIGN KEY (VehicleID) REFERENCES VehicleInformation(VehicleID) ON DELETE CASCADE -- Link to vehicle
);

-- Create indexes on frequently queried columns to improve performance
CREATE INDEX idx_userid_userprofiles ON UserProfiles(UserID);
CREATE INDEX idx_vehicleid_vehicleinformation ON VehicleInformation(VehicleID);
CREATE INDEX idx_userid_servicemaintenance ON ServiceMaintenance(VehicleID);
CREATE INDEX idx_userid_notifications ON Notifications(UserID);

-- Display all tables to verify successful creation of the schema
SHOW TABLES;

-- Describe the structure of each table to confirm correct setup
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
