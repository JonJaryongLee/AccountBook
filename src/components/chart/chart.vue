<template>
    <div>
        <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
        <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource" ref="fc"></fusioncharts>
    </div>
</template>
<script>
export default {
    data: () => ({
        type: 'pie2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        radioValue: 'none',
        lastActive: 'none',
        dataSource: {
            chart: {
                "caption": "생활비",
                "plottooltext": "$label <b>$value</b>원",
                "showLegend": "0",
                "showPercentValues": "1",
                "useDataPlotColorForLabels": "1",
                "enableMultiSlicing": "0",
                "theme": "fusion",
            },
            data: [
                {
                    "label": "월세",
                    "value": "350000"
                },
                {
                    "label": "식비",
                    "value": "75000"
                },
                {
                    "label": "통신비",
                    "value": "56000"
                },
                {
                    "label": "교통비",
                    "value": "30000"
                },
                {
                    "label": "전기세",
                    "value": "20000"
                }
            ]
        }
    }),
    methods: {

    }
}
</script>
<style>
</style>