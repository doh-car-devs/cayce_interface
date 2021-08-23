@extends('_interface.layouts.dashboard')

@section('content')
    @include('_interface.cards.glance')
	<div class="row">
		<div class="col-md-6">
            @include('_interface.cards.myTime')
		</div>
		<div class="col-md-6">
            @include('_interface.cards.announcements')

            <div class="card">
				<div class="card-header">
					<h5 class="card-title">Create New Request</h5>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<a href="{{route('pt.pr.create')}}" class="btn btn-block btn-success"><i class="fas fa-plus mr-4"></i>Purchase Request</a>
						</div>
						<div class="col-md-6">
							<a href="{{route('item.requests')}}" class="btn btn-block btn-success"><i class="fas fa-plus mr-4"></i>Item Request</a>
						</div>
					</div>
				</div>
            </div>
        </div>
	</div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('plugins/knob.js')}}"></script>
    <script>
        $(function() {
            $(".dial").knob({
                'readOnly': true,
                'width': 100,
                'height': 100,
                'fgColor': '#409fff',
            });
        });
    </script>
    <script>
        $(document).ready(function () {




            var twgitems = $('#twg_items').DataTable({
                "info": true,
                "scrollX": true,
                "lengthMenu": [[5, 10, 25, 50,100, -1], [5, 10, 25, 50,100, "All"]],
                "displayLength": 5,
                "order": [[2, "desc" ]],
                // dom: 'Bfrtip',
                // "buttons": [
                //     'copy'
                // ],
            });


            var times = {!! json_encode($data['time']) !!};
            var data = [

            ]
            // var dm = new Date()
            var currentTime = new Date()
            var n = currentTime.getMonth() + 1;
            var y = currentTime.getFullYear();
            // console.log(new Date().getFullYear())
            for (let index = 0; index < times.time.length; index++) {
                const element = times.time[index];
                var type = element
                // console.log(type.checktype)
                var time = element.checktime
                var newtime = time.replace(/\s/g, '!')
                var title =  newtime.substring(newtime.indexOf('!')+1)

                var date = newtime.substr(0, newtime.indexOf('!'))
                var color = 'black'
                if (type.checktype == 'I') {
                    color = 'green';
                }
                if (type.checktype == 'O') {
                    color = '#2877f7';
                }
                data.push({
                    // title: type.checktype+' - ' + title,
                    title: title +' - '+ type.checktype ,
                    start: date,
                    checktype: type.checktype,
                    color: color
                })
            }
            // console.log(data)

            $('#calendar').fullCalendar({
                plugins: ['list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,list'
                },
                defaultDate: y+'-'+n,
                defaultView: 'month',
                eventSources: [
                    {
                        events: data,
                        textColor: 'white',
                    }
                ]
            });
        });
        //-----------------------
        //- MONTHLY SALES CHART -
        //-----------------------

        // Get context with jQuery - using jQuery's .get() method.
        // var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

        // var salesChartData = {
        //     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        //     datasets: [{
        //             label: 'Digital Goods',
        //             backgroundColor: 'rgba(60,141,188,0.9)',
        //             borderColor: 'rgba(60,141,188,0.8)',
        //             pointRadius: false,
        //             pointColor: '#3b8bba',
        //             pointStrokeColor: 'rgba(60,141,188,1)',
        //             pointHighlightFill: '#fff',
        //             pointHighlightStroke: 'rgba(60,141,188,1)',
        //             data: [28, 48, 40, 19, 86, 27, 90]
        //         },
        //         {
        //             label: 'Electronics',
        //             backgroundColor: 'rgba(210, 214, 222, 1)',
        //             borderColor: 'rgba(210, 214, 222, 1)',
        //             pointRadius: false,
        //             pointColor: 'rgba(210, 214, 222, 1)',
        //             pointStrokeColor: '#c1c7d1',
        //             pointHighlightFill: '#fff',
        //             pointHighlightStroke: 'rgba(220,220,220,1)',
        //             data: [65, 59, 80, 81, 56, 55, 40]
        //         },
        //     ]
        // }

        // var salesChartOptions = {
        //     maintainAspectRatio: false,
        //     responsive: true,
        //     legend: {
        //         display: false
        //     },
        //     scales: {
        //         xAxes: [{
        //             gridLines: {
        //                 display: false,
        //             }
        //         }],
        //         yAxes: [{
        //             gridLines: {
        //                 display: false,
        //             }
        //         }]
        //     }
        // }

        // // This will get the first returned node in the jQuery collection.
        // var salesChart = new Chart(salesChartCanvas, {
        //     type: 'line',
        //     data: salesChartData,
        //     options: salesChartOptions
        // })

        //---------------------------
        //- END MONTHLY SALES CHART -
		//---------------------------

        var Divisions = [ 'GAA', 'SAA'];
		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [ 300, 66, 22, 32],
					backgroundColor: [ '#FF7E55', '#B3887B', '#6B88FF', '#7BB346'],
					label: 'Dataset 1'
				}],
				labels: Divisions
			},
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'DOH-CHD-CAR Employees'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
        };
        // BAR CHART
        // BAR CHART
        // BAR CHART

		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var color = Chart.helpers.color;
        var horizontalBarChartData = {
			labels: Divisions,
			datasets: [{
				label: 'Allocated Budget',
				backgroundColor: color('#FF7E55').alpha(0.5).rgbString(),
				borderColor: '#FF7E55',
            borderWidth: 1,
				data: [

				]
			}, {
				label: 'Utilized Budget',
				backgroundColor: color('#6B88FF').alpha(0.5).rgbString(),
				borderColor: '#6B88FF',
				data: [
                    {!!json_encode($data['programBudget']['GAA'])!!},
                    {!!json_encode($data['programBudget']['SAA'])!!},
                    {!!json_encode($data['programBudget']['GAA'])!!},
                    {!!json_encode($data['programBudget']['SAA'])!!},
				]
			}]

		};

		window.onload = function() {
            // First CHARTJS
			var ctx = document.getElementById('users').getContext('2d');
			window.myDoughnut = new Chart(ctx, config);

            // Second CHARTJS
			var barChart = document.getElementById('canvas').getContext('2d');
			window.myHorizontalBar = new Chart(barChart, {
				type: 'horizontalBar',
				data: horizontalBarChartData,
				options: {
					// Elements options apply to all of the options unless overridden in a dataset
					// In this case, we are setting the border of each horizontal bar to be 2px wide
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Fund Status'
					}
				}
			});

		};
    </script>
@endsection
