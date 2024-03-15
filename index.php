<?php
    require 'TableForm.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Table Input</title>
</head>
<body>
    <form action="post">
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
    </form>
    <script>
        /*Listen for input from table cells to calculate a total for tenure and promotion.*/
        document.addEventListener("input", (e) => {
            if(e.target.classList.contains("tenure-years") || e.target.classList.contains("promotion-years")){
                let tenureYears = document.querySelectorAll(".tenure-years")
                let promotionYears = document.querySelectorAll(".promotion-years")

                const calcTotalYears = (years, totalId) => {
                    let total = 0
                    years.forEach(year => {
                        total += Number(year.value)
                    })
                    document.getElementById(totalId).innerText = total
                }

                calcTotalYears(tenureYears, "tenureYearsTotal")
                calcTotalYears(promotionYears, "promotionYearsTotal")
            }
        })
    </script>
    
    <style>
        * {
            text-align: center;
        }
        th, td {
            border: 1px solid;
            padding: 8px;
        }
        input {
            width: 90%;
            align-self: center;
        }
        input, .tenure-years-total, .promotion-years-total {
            border: none;
            margin: 0;
            padding: 10px;
        }

        .custom-table {
            width: 80%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #ffffff;
            border-style: solid;
            margin: 10px auto;
        }

        table.custom-table thead {
            background-color: #ffffff;
        }
        .total-years-requested {
            background-color: lightgray;
        }
    </style>
</body>
</html>