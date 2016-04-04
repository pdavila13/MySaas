//import Chart from 'chart.js';
import Vue from 'vue';
import Graph from './components/Graph'

//var ctx = document.getElementById("barChartDailySales").getContext("2d");
//var data = {
//    labels: ["day1","day2","day3","day4",],
//    datasets: [ {
//        data: [65,45,32,89],
//        label: "Daily Sales",
//        fillColor: "rgba(220, 220, 220, 0.5)",
//        strokeColor: "rgba(220, 220, 220, 0.8)",
//        pointHighlightFill: "rgba(220, 220, 220, 0.75)",
//        pointHighlightStroke: "rgba(220,220,220,1)",
//    }]
//}
//
//var myBarChart = new Chart(ctx).Bar(data);

new Vue({
    el: 'body',
    ready() {
        //alert("Vue funciona!!");
    },
    components: {Graph}
})