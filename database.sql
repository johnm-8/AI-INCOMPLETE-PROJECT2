-- Modifying the Students table to include a Password column
CREATE TABLE Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL, -- This is the new Password column
    EnrollmentYear INT NOT NULL
);

-- Creating the Instructors table
CREATE TABLE Instructors (
    InstructorID INT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Department VARCHAR(255) NOT NULL
);

-- Creating the Courses table
CREATE TABLE Courses (
    CourseID INT PRIMARY KEY,
    CourseName VARCHAR(255) NOT NULL,
    CourseDescription TEXT,
    InstructorID INT,
    FOREIGN KEY (InstructorID) REFERENCES Instructors(InstructorID)
);

-- Creating the Assignments table
CREATE TABLE Assignments (
    AssignmentID INT PRIMARY KEY,
    CourseID INT,
    AssignmentDescription TEXT NOT NULL,
    DueDate DATE NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
);

-- Creating the StudentAssignments table
CREATE TABLE StudentAssignments (
    StudentAssignmentID INT PRIMARY KEY,
    AssignmentID INT,
    StudentID INT,
    SubmissionDate DATE,
    Grade VARCHAR(10),
    IsComplete BOOLEAN,
    FOREIGN KEY (AssignmentID) REFERENCES Assignments(AssignmentID),
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID)
);

-- Creating the Grades table
CREATE TABLE Grades (
    GradeID INT PRIMARY KEY,
    LetterGrade VARCHAR(5) NOT NULL,
    PercentageRange VARCHAR(50) NOT NULL,
    GradePoint DECIMAL(3, 2)
);


