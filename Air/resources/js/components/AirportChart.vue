<template>
    <div>
        <apexchart
        height=300
            type="donut"
            :options="chartOptions"
            :series="series"
        ></apexchart>
    </div>
</template>
<script>
export default {
    props: ["gndcost", "cities"],
    data: function() {
        return {
            series: this.gndcost,
            chartOptions: {
                labels: this.cities
            }
        };
    }
};
</script>
