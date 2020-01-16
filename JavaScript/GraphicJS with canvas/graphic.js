(function(){

	var all = document.getElementsByTagName('canvas');

	for(let canvas of all){
		switch(canvas.className){
			case 'graphic':
				graphic(canvas);
				break;
			case 'circle':
				circle(canvas);
				break;	
		}
	}

}());

function circle(canvas){
	let cvx = canvas.getContext('2d');

	let data = JSON.parse(canvas.dataset.json);

	var sum = 0; // La suma de todos lso values es el 100% que corresponde con 2 * Math.PI
	data.forEach(function(object){
		sum += parseInt(object.value);
	});

	let sAngle = 0;
	let eAngle = 0;

	data.forEach(function(object){
		let percent = (( object.value * 100) / sum);
		eAngle += ((percent * 2) / 100) * Math.PI;

		cvx.beginPath();
		cvx.moveTo(canvas.width / 2,canvas.height / 2);
		cvx.fillStyle = object.color;
		cvx.arc(canvas.width / 2,canvas.height / 2, canvas.width / 2, sAngle, eAngle, false);
		cvx.fill(); 

		sAngle = eAngle;
	});
}

function graphic(canvas){

	let cvx = canvas.getContext('2d');
	
	let cWidth = canvas.width;
	let cHeight = canvas.height;

	cvx.beginPath();
	cvx.fillStyle = "black";
	cvx.font = "10px Arial";
	cvx.fillText(canvas.dataset.title, 10 , 10);

	cvx.beginPath();
	cvx.moveTo(0,0);
	cvx.lineTo(0, cHeight - 15);
	cvx.lineTo(cWidth, cHeight - 15);
	cvx.stroke();

	let data = JSON.parse(canvas.dataset.json);
	let values = [];

	data.forEach(function(object){
		values.push(object.value);
	});

	let sep = parseInt(canvas.dataset.sep);
	let maxVal = Math.max(...values);
	let cut = ((cWidth - (sep * (data.length + 1))) / data.length);

	if(canvas.dataset.min > cut){
		cut = parseInt(canvas.dataset.min);
	}else if(canvas.dataset.max < cut){
		cut = parseInt(canvas.dataset.max);
	};

	let possAct = sep;

	data.forEach(function(object){
		let height = (object.value * (cHeight - 15)) / maxVal;

		cvx.beginPath();
		cvx.fillStyle = canvas.dataset.color;
		cvx.fillRect(possAct, (cHeight - 15)- height, cut, height);
		
		cvx.beginPath();
		cvx.fillStyle = "black";
		cvx.font = "10px Arial";
		cvx.fillText(object.name.substring(0,6), possAct , cHeight - 5);

		cvx.beginPath();
		cvx.fillStyle = canvas.dataset.valcol;
		cvx.font = "10px Arial";
		cvx.fillText(object.value, possAct , cHeight - height);

		possAct = possAct + cut + sep;
	});
}