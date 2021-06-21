<template>
   <div>
       <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
   </div>
</template>

<script>
export default {
    props:['data','datax'],
    data: function() {
      return {
          series: [{
                name: 'Net Cost',
                data: []
          },{
                name: 'Recieved',
                data: []
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

            labels: Object.keys(this.data),
            // xaxis: {
            //   type: 'datetime',
            //   categories: []
            // },

          },

      }
    },
    mounted(){
            for(var i in this.data){
                var key = i;
                var total=0;
                var val = this.data[i];
                for(var j in val){
                    var x=val[j]
                    total+=parseInt(x['netcost']);
                }
                this.series[0].data.push(total)

                var total=0;
                var val = this.datax[i];
                for(var j in val){
                    var x=val[j]
                    total+=parseInt(x['recieved']);
                }
                this.series[1].data.push(total)
            }

            console.log(this.series);
    }
};
</script>
