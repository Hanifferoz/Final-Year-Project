<template>
    <div>
        <apexchart
        height=150
            type="donut"
            :options="chartOptions"
            :series="series"
        ></apexchart>
    </div>
</template>
<script>
export default {
    props: ["staus"],
    data: function() {
        return {
            series: this.staus,
            chartOptions: {
                labels:['Good','Maintanance']
            }
        };
    }
};
</script>
