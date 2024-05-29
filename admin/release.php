<?php

function calculateAndInsertLoanSchedule() {
    // Connect to your database (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "1994410Mbuvi@";
    $dbname = "cm_sacco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get loan_id and loan_plan_id from form post
    $loanId = $_POST['loan_id'];
    $loanPlanId = $_POST['loan_plan_id'];

    // Fetch loan amount from loan_list table
    $loanSql = "SELECT * FROM loan_list WHERE id = $loanId";
    $loanResult = $conn->query($loanSql);

    if ($loanResult->num_rows > 0) {
        $loanRow = $loanResult->fetch_assoc();
        $loanAmount = $loanRow['loan_amount'];

        // Fetch loan plan details from the database
        $planSql = "SELECT * FROM loan_plan WHERE id = $loanPlanId";
        $planResult = $conn->query($planSql);

        if ($planResult->num_rows > 0) {
            $planRow = $planResult->fetch_assoc();

            // Extract relevant details
            $interestRate = $planRow['interest_percentage'] / 100;
            $penaltyRate = $planRow['penalty_rate'];
            $months = $planRow['months'];

            // Calculate monthly interest rate
            $monthlyInterestRate = $interestRate / 12;

            // Calculate monthly payment using the loan formula
            $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$months));

            // Initialize variables
            $remainingLoanAmount = $loanAmount;
            $totalPaid = 0;

            // Loop through each month to generate the loan schedule and insert into the loan_schedule table
            for ($month = 1; $month <= $months; $month++) {
                // Calculate interest for the month
                $monthlyInterest = $remainingLoanAmount * $monthlyInterestRate;

                // Calculate principal for the month
                $monthlyPrincipal = $monthlyPayment - $monthlyInterest;

                // Update remaining loan amount
                $remainingLoanAmount -= $monthlyPrincipal;

                // Update total amount paid
                $totalPaid += $monthlyPayment;

                // Insert record into loan_schedule table
                $insertSql = "INSERT INTO loan_schedule (loan_id, loan_plan_id, month, monthly_payment, monthly_interest, monthly_principal, remaining_loan_amount, total_paid)
                              VALUES ($loanId, $loanPlanId, $month, $monthlyPayment, $monthlyInterest, $monthlyPrincipal, $remainingLoanAmount, $totalPaid)";

                if ($conn->query($insertSql) !== TRUE) {
                    echo "Error inserting record: " . $conn->error;
                }
            }

            // Update loan_list table to mark loan as released
            $updateLoanStatusSql = "UPDATE loan_list SET loan_status = 2 WHERE id = $loanId";

            if ($conn->query($updateLoanStatusSql) !== TRUE) {
                echo "Error updating loan status: " . $conn->error;
            }

            echo "Loan schedule generated, inserted, and loan status updated successfully.";

            // Close the database connection
            $conn->close();
        } else {
            echo "Loan plan not found";
        }
    } else {
        echo "Loan not found";
    }

    // Close the database connection
    $conn->close();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    calculateAndInsertLoanSchedule();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Schedule Generator</title>
</head>
<body>
    <h2>Loan Schedule Generator</h2>
    <form method="post">
        <label for="loan_id">Loan ID:</label>
        <input type="text" name="loan_id" required>
        <br>
        <label for="loan_plan_id">Loan Plan ID:</label>
        <input type="text" name="loan_plan_id" required>
        <br>
        <button type="submit">Generate Loan Schedule</button>
    </form>
</body>
</html>
