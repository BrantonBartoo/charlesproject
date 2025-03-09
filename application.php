<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];

    $financial_need = $_POST["financial_need"];
    $funding_sources = $_POST["funding_sources"];
    $bursary_impact = $_POST["bursary_impact"];
    
    $academic_achievements = $_POST["academic_achievements"];
    $academic_challenges = $_POST["academic_challenges"];
    $academic_goals = $_POST["academic_goals"];
    
    $personal_circumstances = $_POST["personal_circumstances"];
    $study_balance = $_POST["study_balance"];
    $support_systems = $_POST["support_systems"];
    
    $career_aspirations = $_POST["career_aspirations"];
    $community_contribution = $_POST["community_contribution"];
    $skills_experience = $_POST["skills_experience"];
    
    $study_motivation = $_POST["study_motivation"];
    $resilience_example = $_POST["resilience_example"];
    $engagement_plan = $_POST["engagement_plan"];
    
    $extracurricular = $_POST["extracurricular"];
    $unique_qualities = $_POST["unique_qualities"];
    $additional_info = $_POST["additional_info"];

    // Status of application (default: Pending)
    $status = "Pending"; 

    // Ensure the number of fields matches the columns in your database
    $sql = "INSERT INTO bursary_applications 
            (user_id, financial_situation, funding_sources, bursary_impact, 
            academic_achievements, academic_challenges, academic_goals, 
            personal_circumstances, study_balance, support_systems, 
            career_aspirations, community_contribution, skills_experiences, 
            motivation, resilience_example, engagement_plan, 
            extracurriculars, unique_qualities, additional_info, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters (ensure correct data types)
    $stmt->bind_param("isssssssssssssssssss", 
        $user_id, $financial_need, $funding_sources, $bursary_impact, 
        $academic_achievements, $academic_challenges, $academic_goals, 
        $personal_circumstances, $study_balance, $support_systems, 
        $career_aspirations, $community_contribution, $skills_experience, 
        $study_motivation, $resilience_example, $engagement_plan, 
        $extracurricular, $unique_qualities, $additional_info, $status
    );

    if ($stmt->execute()) {
        // Redirect to profile.php after successful submission
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursary Application</title>
    <style>
        /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right,rgb(237, 239, 241),rgb(114, 192, 252));
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    flex-direction: column;
}

/* Title Section */
.title-container {
    width: 100%;
    text-align: center;
    background: linear-gradient(135deg, #ffffff, #007bff);
    color: #004080;
    padding: 20px 0;
    font-size: 28px;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    position: fixed;
    top: 0;
    left: 0;
}

/* Main Form Container */
.container {
    width: 90%;
    max-width: 750px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    margin-top: 100px;
}

/* Form Heading */
h2 {
    text-align: center;
    color: #007bff;
    font-size: 22px;
    margin-bottom: 10px;
    font-weight: 600;
}

h3 {
    color: #495057;
    font-size: 18px;
    margin-top: 20px;
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 5px;
}

/* Labels */
label {
    font-weight: 600;
    display: block;
    margin: 10px 0 5px;
    font-size: 14px;
    color: #495057;
}

/* Input & Textarea Fields */
textarea, input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 14px;
    background: #f8f9fa;
    transition: 0.3s ease-in-out;
}

textarea:focus, input:focus {
    border-color: #007bff;
    background: #ffffff;
    outline: none;
}

/* Submit Button */
button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #007bff, #004080);
    border: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s ease-in-out;
    margin-top: 15px;
}

button:hover {
    background: linear-gradient(135deg, #004080, #007bff);
}

    </style>
</head>
<body>
    <h2>Bursary Application Form</h2>
    <form action="application.php" method="POST">
        <h3>Financial Need</h3>
        <label>Explain your financial situation:</label><br>
        <textarea name="financial_need" required></textarea><br>
        <label>Other sources of funding:</label><br>
        <textarea name="funding_sources" required></textarea><br>
        <label>Impact of this bursary:</label><br>
        <textarea name="bursary_impact" required></textarea><br>
        
        <h3>Academic Performance</h3>
        <label>Academic achievements:</label><br>
        <textarea name="academic_achievements" required></textarea><br>
        <label>Challenges faced academically:</label><br>
        <textarea name="academic_challenges" required></textarea><br>
        <label>Academic goals:</label><br>
        <textarea name="academic_goals" required></textarea><br>
        
        <h3>Personal Circumstances</h3>
        <label>Personal circumstances influencing education:</label><br>
        <textarea name="personal_circumstances" required></textarea><br>
        <label>Balancing studies with other responsibilities:</label><br>
        <textarea name="study_balance" required></textarea><br>
        <label>Support systems available:</label><br>
        <textarea name="support_systems" required></textarea><br>
        
        <h3>Future Goals</h3>
        <label>Career aspirations:</label><br>
        <textarea name="career_aspirations" required></textarea><br>
        <label>How will you give back to the community?:</label><br>
        <textarea name="community_contribution" required></textarea><br>
        <label>Skills or experiences you hope to gain:</label><br>
        <textarea name="skills_experience" required></textarea><br>
        
        <h3>Commitment and Motivation</h3>
        <label>What motivates your studies?:</label><br>
        <textarea name="study_motivation" required></textarea><br>
        <label>Example of resilience:</label><br>
        <textarea name="resilience_example" required></textarea><br>
        <label>Plan for engagement in education:</label><br>
        <textarea name="engagement_plan" required></textarea><br>
        
        <h3>Additional Considerations</h3>
        <label>Extracurricular activities:</label><br>
        <textarea name="extracurricular" required></textarea><br>
        <label>What sets you apart?:</label><br>
        <textarea name="unique_qualities" required></textarea><br>
        <label>Anything else you want to share?:</label><br>
        <textarea name="additional_info" required></textarea><br>
        
        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
