<template>
    <div>
        <div v-if="chartShow">
            <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource" ref="fc"></fusioncharts>
        </div>
        <div id="checkUserType">
            <br>
            <div>
                {{userName}}님의 소비진단
            </div>
            <br>
            <div>
                {{userAge}} {{userSex}} 평균 식비에서 2%절약
            </div>
            <div>
                {{userAge}} {{userSex}} 평균 교통비에서 0%절약
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    props: ['thisMonth'],
    data: () => ({
        chartShow: false,
        userName: "자룡",
        userAge: "30대",
        userSex: "남성",
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
        }
    }),
    created() {
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