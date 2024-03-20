<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Form Table Input</title>
</head>
<body>
    <?php
        require 'TableForm.php';
    ?>
    <!-- <form action="post">
        <table class="custom-table">
            <thead>
                <tr>
                    <th scope="col" rowspan="2" colspan="1">Prior Institution</th>
                    <th scope="col" rowspan="2">Appt. Years</th>
                    <th scope="col" rowspan="2">Last Appt. Rank</th>
                    <th scope="col" rowspan="2">Years in Rank</th>
                    <th scope="colgroup" rowspan="1" colspan="2" id="yearsReq">Years Requested</th>
                </tr>
                <tr>
                    <th scope="col" headers="yearsReq" id="tenureHeader">Tenure</th>
                    <th scope="col" headers="yearsReq" id="promotionHeader">Promotion</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    for($i = 0; $i < 4; ++$i){ ?>
                        <tr>
                            <td><input aria-label="prior institution" name="priorInstitutionInput" type="text"></td>
                            <td><input aria-label="appointed years" name="appointedYearsInput" min="0" type="number"></td>
                            <td><input aria-label="last appointed rank" name="lastAppointedRankInput" type="text"></td>
                            <td><input aria-label="years in rank" name="yearsInRankInput" min="0" type="number"></td>
                            <td><input aria-label="requested tenure years" name="requestedTenureYearsInput" class="tenure-years" min="0" type="number" headers="tenureHeader"></td>
                            <td><input aria-label="requested promotion years" name="requestedPromotionYearsInput" class="promotion-years" min="0" type="number" headers="promotionHeader"></td>
                        </tr><?php
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">University policy limits requests to 2 years.</td>
                    <th id="totalYearsRequested" class="total-years-requested">Total:</th>
                    <td id="tenureYearsTotal" headers="tenureHeader totalYearsRequested">0</td>
                    <td id="promotionYearsTotal" headers="promotionHeader totalYearsRequested">0</td>
                </tr>
            </tfoot>
        </table>
    </form> -->
    <script src="./TableEvents.js"></script>
</body>
</html>