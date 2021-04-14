<template>
    <div>
        <canvas id="planet-chart"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js'
//import planetChartData from './planet-data.js'

export default {
    data() {
        return {
            planetChartDataValues : {
                type: "line",
                data: {

                    // TODO - preluare dinamica a valorilor
                    labels: ["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"],
                    datasets: [
                        {
                            label: "Salariu",
                            data: [1750, 12205, 6520, 8572, 6584, 9875, 1458, 4585, 9987, 10200, 3547, 12445],
                            backgroundColor: "rgb(56,173,169, 0.4)",
                            borderColor: "rgba(39, 60, 117,1.0)",
                            borderWidth: 1
                        },
                        {
                            label: "Bonusuri",
                            data: [150, 300, 200, 450, 600, 360, 120, 80, 75, 500, 650, 100],
                            backgroundColor: "rgba(116, 185, 255,1.0)",
                            borderColor: "rgba(39, 60, 117,1.0)",
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    responsive: true,
                    lineTension: 2,
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
            },

            planetChartData: this.planetChartDataValues
        }
    },
    created() {
        this.createChart();
    },
    mounted() {
        const ctx = document.getElementById('planet-chart');
        new Chart(ctx, this.planetChartDataValues);
    },
    methods:{
        createChart(){
            const ctx = document.getElementById('example');
            const exampleChart = new Chart(ctx, {
                type: '',
                data: [],
                options: {},
            });
        }
    }
}
</script>
