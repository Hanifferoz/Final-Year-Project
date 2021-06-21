<template>
   <div>
       <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
   </div>
</template>

<script>
export default {
    props:['data','date'],
    data: function() {
      return {
          series: [{
                name: 'Net Cost',
                data: this.data
          }],
          chartOptions: {
            chart: {
              height: 350,
              type: 'area',
              toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                download: true,
                selection: true,
                zoom: true,
                zoomin: true,
                zoomout: true,
                pan: false,
                reset: false,
                },
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth'
            },

            labels: this.date,

          },

      }
    },
    mounted(){
        console.log(this.data);
    }
};
</script>
