<template>
    <div>
        <div v-if="chartShow">
            <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource" ref="fc"></fusioncharts>
        </div>
        <div id="checkUserType" v-if="detailShow">
            <br>
            <div>{{receivedText[0]}}</div>
            <div>{{receivedText[1]}}</div>
            <div>{{receivedText[2]}}</div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    props: ['thisMonth'],
    data: () => ({
        chartShow: false,
        type: 'pie2d',
        width: '100%',
        height: '300',
        dataFormat: 'json',
        dataSource: {
            chart: {
                "plottooltext": "$label <b>$value</b>원",
                "showLegend": "0",
                "showPercentValues": "1",
                "useDataPlotColorForLabels": "1",
                "enableMultiSlicing": "0",
                "theme": "fusion",
            },
            data: []
        },
        detailShow: false
    }),
    created() {
        axios.get('/php/getUserSpendCheck.php').then(response => {
                    this.receivedText = response.data;
                    this.detailShow = true;
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                });
        axios.post('/php/getSpendChartData.php', {
                'month': this.thisMonth,
                'tag': '생활비'
            }).then(response => {
                this.dataSource.data = response.data;
                this.chartShow = true;
            })
            .catch(error => {
                if (error)
                    console.log("실패!");
            });
    },
    methods: {

    }
}
</script>
<style>
#checkUserType {
    border-top: 1px solid black;
    height: 150px;
    text-align: center;
}
</style>