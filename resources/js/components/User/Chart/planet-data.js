export const planetChartData = {
    type: "line",
    data: {
        labels: ["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"],
        datasets: [
            {
                label: "Lei",
                data: [1750, 12205, 6520, 8572, 6584, 9875, 1458, 4585, 9987, 10200, 3547, 12445],
                backgroundColor: "rgba(54,73,93,.5)",
                borderColor: "#36495d",
                borderWidth: 3
            },
        ]
    },
    options: {
        responsive: true,
        lineTension: 1,
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        padding: 25
                    }
                }
            ]
        }
    }
};

export default planetChartData;
