<div class="px-5 py-4">
    <div class="bg-white px-3 py-2 col-12 container shadow-sm">
        <div>
            <span class="h3">Emergency Service Order</span>
        </div>
        <div class="d-flex py-3">
            <div class="col-4 pe-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">Pending</span>
                    </div>
                    <div>
                        <span class="h5">{{ $e_pending }}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 px-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">On The Way</span>
                    </div>
                    <div>
                        <span class="h5">{{ $e_otw }}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 ps-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">Completed</span>
                    </div>
                    <div>
                        <span class="h5">{{ $e_completed }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white px-3 py-2 my-3 col-12 container shadow-sm">
        <div>
            <span class="h3">Product Order</span>
        </div>
        <div class="d-flex py-3">
            <div class="col-4 pe-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">Pending</span>
                    </div>
                    <div>
                        <span class="h5">{{ $p_pending }}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 px-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">Processing</span>
                    </div>
                    <div>
                        <span class="h5">{{ $p_processing }}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 ps-3">
                <div class="bg-light py-3 text-center shadow-sm">
                    <div>
                        <span class="h4">Completed</span>
                    </div>
                    <div>
                        <span class="h5">{{ $p_completed }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3 container d-flex">
        <div class="col-6 pe-3">
            <div id="emergency" style="height: 500px" class="col-12 bg-white p-3"></div>
        </div>
        <div class="col-6 ps-3">
            <div id="product" style="height: 500px" class="col-12 bg-white p-3"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    <script>
        let chartDom = document.getElementById('emergency');
        let chartDom2 = document.getElementById('product');
        let myChart = echarts.init(chartDom);
        let myChart2 = echarts.init(chartDom2);
        let option;
        let option2;

        option = {
            title: {
                text: 'Emergency Services',
                subtext: 'Previous Week Order'
            },
            xAxis: {
                type: 'category',
                data: [
                    @foreach($week_e_orders as $date => $order)
                        '{{ $date }}',
                    @endforeach
                ]
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    data: [
                        @foreach($week_e_orders as $date => $order)
                            '{{ $order }}',
                        @endforeach
                    ],
                    type: 'bar'
                }
            ]
        };

        option2 = {
            title: {
                text: 'Products',
                subtext: 'Previous Week Order'
            },
            xAxis: {
                type: 'category',
                data: [
                    @foreach($week_p_orders as $date => $order)
                        '{{ $date }}',
                    @endforeach
                ]
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    data: [
                        @foreach($week_p_orders as $date => $order)
                            '{{ $order }}',
                        @endforeach
                    ],
                    type: 'bar'
                }
            ]
        };

        option && myChart.setOption(option);
        option2 && myChart2.setOption(option2);
    </script>
</div>
