<?php

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=utf-8");


$targetGoal = $_POST['targetGoal']; // 500,000
$monthlyIncome = $_POST['monthlyIncome']; // 10,000
$duration = $_POST['investmentDuration']; // 36 Months


$annualContribution = $targetGoal / $duration * 12;
$no_years = $duration / 12;

$projected_safe = 0;
$projected_well = 0;

for ($x = 1; $x <= $no_years; $x++) {
    $projected_safe = ($projected_safe + $annualContribution) * 1.04;
    $projected_well = ($projected_well + $annualContribution) * 1.06;
}

$monthlyInvestment = $targetGoal / $duration;

$return = array();

if ($monthlyIncome > $monthlyInvestment) {
    $return['error'] = FALSE;
    $return['projected_payout_safe'] =  $projected_safe;
    $return['projected_payout_well'] = $projected_well;
} else {
    $return['error'] = TRUE;
    $return['message'] = 'Based on your input, you are aiming to save Php ' . number_format($monthlyInvestment, 2) .'/month to reach your goal. This amount is greater than your planned monthly investment. Please review your customized plan.';
}

echo json_encode($return);
exit;








