<?php
/**
 * Student Information Script
 * Author: Abdelrahman Hassan AbdelAAl
 * Date: 2025-07-31
 * Description:
 *   This PHP script stores student data in an array
 *   and displays their information in a clean HTML table.
 */

// ====================
// 1. Define Student Data
// ====================
$students = [
    ["name" => "Ali Ahmed", "age" => 20, "gpa" => 3.5, "year" => "Sophomore"],
    ["name" => "Sara Mohamed", "age" => 21, "gpa" => 3.8, "year" => "Junior"],
    ["name" => "Omar Hassan", "age" => 19, "gpa" => 3.2, "year" => "Freshman"],
    ["name" => "Mona Samir", "age" => 22, "gpa" => 3.9, "year" => "Senior"]
];

// ====================
// 2. Function to Display Table
// ====================
function displayStudents($studentsArray) {
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #f2f2f2;'>
            <th>Name</th>
            <th>Age</th>
            <th>GPA</th>
            <th>Year</th>
          </tr>";

    foreach ($studentsArray as $student) {
        echo "<tr>
                <td>{$student['name']}</td>
                <td>{$student['age']}</td>
                <td>{$student['gpa']}</td>
                <td>{$student['year']}</td>
              </tr>";
    }
    echo "</table>";
}

// ====================
// 3. Output to Browser
// ====================
echo "<h1>Student Information</h1>";
displayStudents($students);

// ====================
// 4. Additional Feature: Find Top Student
// ====================
function getTopStudent($studentsArray) {
    $top = $studentsArray[0];
    foreach ($studentsArray as $student) {
        if ($student["gpa"] > $top["gpa"]) {
            $top = $student;
        }
    }
    return $top;
}

$topStudent = getTopStudent($students);
echo "<p><strong>Top Student:</strong> {$topStudent['name']} with GPA {$topStudent['gpa']}</p>";
?>
