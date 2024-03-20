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