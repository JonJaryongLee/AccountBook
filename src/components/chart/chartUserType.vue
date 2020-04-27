<template>
    <div>
        <div>
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
export default {
    data: () => ({
        userName:"자룡",
        userAge:"30대",
        userSex:"남성",
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
            data: [{
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
#checkUserType {
    border-top: 1px solid black;
    height: 150px;
    text-align: center;
}
</style>