<template>
    <div>
        <canvas id="planet-chart"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js'
//import planetChartData from './planet-data.js'

export default {
    props: ['angajatSalarii'],
    data() {
        return {
            planetChartDataValues : {
                type: "line",
                data: {

                    // TODO - preluare dinamica a valorilor
                    labels: [],
                    datasets: [
                        {
                            label: "Salariu",
                            data: [],
                            backgroundColor: "rgba(0, 148, 50,0.2)",
                            borderColor: "rgba(15,109,122, 1.0)",
                            borderWidth: 2
                        }
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
        this.setChartData();
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
        },
        setChartData(){
            this.angajatSalarii.forEach(salariu =>{
                this.planetChartDataValues.data.labels.unshift(salariu.salariu_chart_data)
                this.planetChartDataValues.data.datasets[0].data.unshift(salariu.salariu_suma_finala)
            })
        }
    }
}
</script>
