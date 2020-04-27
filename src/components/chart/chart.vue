<template>
    <div>
        <div id="chartContainerInChart">
            <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource" ref="fc" @dataPlotClick="onSliceClick"></fusioncharts>
        </div>
        <div class="chartListInChart" v-for="(expenseList, index) in expenseLists" :key="index">
            <div class="dateInChartListInChart">{{expenseList[0]}}</div>
            <div class="contentInChartListInChart">{{expenseList[1]}}</div>
            <div class="moneyInChartListInChart">{{expenseList[2]}}</div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        type: 'pie2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
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
        },
        expenseLists: [
            ["4/13", "택시", "4,700원"],
            ["4/22", "버스", "1,500원"]
        ]
    }),
    methods: {
        onSliceClick(e) {
            let label = e.data.categoryLabel;
            console.log(label);
            // 해당 태그에 해당되는 내역만 출력한다.
        }
    }
}
</script>
<style>
#chartContainerInChart{
    border-bottom: 2px solid gray;
}

.chartListInChart {
    border-bottom: 1px solid grey;
    text-align: center;
}

.dateInChartListInChart,
.contentInChartListInChart,
.moneyInChartListInChart {
    display: inline-block;
    vertical-align: top;
    width: 33.33%;
    font-size: 1.2rem;
}
</style>