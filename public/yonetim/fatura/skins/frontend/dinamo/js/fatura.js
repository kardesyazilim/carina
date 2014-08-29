$( document ).ready(function() {


		var randomScalingFactor = function(){ return Math.round(Math.random()*400)};

		var barChartData = {
		labels : ["Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz"],
		datasets : [
			{
				fillColor : "rgba(90,200,200,1)",
				strokeColor : "rgba(90,200,200,1)",
				highlightFill: "rgba(90,200,200,1)",
				highlightStroke: "rgba(90,200,200,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			},
			{
				fillColor : "rgba(65,65,65,1)",
				strokeColor : "rgba(65,65,65,1)",
				highlightFill : "rgba(65,65,65,1)",
				highlightStroke : "rgba(65,65,65,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : false,
			scaleFontFamily : "'Conv_MarianinaCnFY-Bold'",
			scaleFontSize : 8,
			scaleFontStyle: "normal",
			scaleFontColor: "#414141",
			scaleGridLineColor : "rgba(0,0,0,0)",//grid color
			barShowStroke : true,
			scaleShowGridLines : true,
			datasetFill : true,
			showTooltips: false,
			 scaleLabel: "<%=value%>",
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

		});
	}


});