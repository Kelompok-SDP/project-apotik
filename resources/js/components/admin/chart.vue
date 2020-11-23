<script>
  //Importing Line class from the vue-chartjs wrapper
  import { Bar,mixins} from 'vue-chartjs'

  const { reactiveProp } = mixins

  //Exporting this so it can be used in other components
  export default {
    mixins: [ reactiveProp ],
    extends: Bar,
    name: "chart",

    data () {
      return {
        //Chart.js options that control the appearance of the chart
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
    mounted () {
      //renderChart function renders the chart with the datacollection and options object.
      // console.log(this.labelChart);

      this.renderChart(this.datacollection, this.options);

    }
  }
</script>
