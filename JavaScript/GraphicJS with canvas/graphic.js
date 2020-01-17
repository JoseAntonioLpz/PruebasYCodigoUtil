(function(){

	var all = document.getElementsByTagName('canvas');

	for(let canvas of all){
		switch(canvas.className){
			case 'graphic_bar':
				graphicBar(canvas);
				break;
			case 'circle':
				circle(canvas);
				break;
			case 'graphic':
				graphic(canvas);
				break;		
		}
	}

}());

function graphic(canvas){
	let cvx = canvas.getContext('2d');

	let cHeight = canvas.height;
	let cWidth = canvas.width;

	let data = JSON.parse(canvas.dataset.json);

	let values = [];
	data.forEach(function(object){
		values.push(object.value);
	});

	let maxVal = Math.max(...values);

	cvx.beginPath();
	cvx.strokeStyle = "black";
	cvx.moveTo(25,10);
	cvx.lineTo(25, cHeight - 15);
	cvx.lineTo(cWidth, cHeight - 15);
	cvx.stroke();

	cvx.beginPath();
	cvx.font = "10px Arial";
	cvx.fillText(maxVal, 0 , 20);

	cvx.beginPath();
	cvx.font = "10px Arial";
	cvx.fillText(maxVal / 2, 0 , (cHeight - 15)/ 2);

	cvx.beginPath();
	cvx.font = "10px Arial";
	cvx.fillText(0, 0 , cHeight - 15);

	cvx.beginPath();
	cvx.fillText(canvas.dataset.title, 30 , 20);

	let x = 25;
	let lx = 25;
	let lh = (cHeight - 15) - (((data[0].value * (cHeight - 15)) / maxVal) - 15);
	data.forEach(function(object){

		let calcPos = (cHeight - 15) - (((object.value * (cHeight - 15)) / maxVal) - 15);

		cvx.beginPath();
		cvx.fillStyle = canvas.dataset.color;
		cvx.arc(x, calcPos, 3, 0, 2 * Math.PI, true);
		cvx.fill();

		cvx.beginPath();
		cvx.strokeStyle = canvas.dataset.color;
		cvx.moveTo(lx,lh);
		cvx.lineTo(x, calcPos);
		cvx.stroke();

		cvx.beginPath();
		cvx.fillStyle = "black";
		cvx.font = "10px Arial";
		cvx.fillText(object.name, x, cHeight);

		lx = x;
		lh = calcPos;
		x += parseInt(canvas.dataset.sep);
	});
}

function circle(canvas){
	let cvx = canvas.getContext('2d');

	let data = JSON.parse(canvas.dataset.json);

	var sum = 0; // La suma de todos lso values es el 100% que corresponde con 2 * Math.PI
	data.forEach(function(object){
		sum += parseInt(object.value);
	});

	let sAngle = 0;
	let eAngle = 0;

	let cont = 1;
	data.forEach(function(object){
		let percent = (( object.value * 100) / sum);
		eAngle += ((percent * 2) / 100) * Math.PI;

		cvx.beginPath();
		cvx.moveTo(canvas.width / 2.5,canvas.height / 2.5);
		cvx.fillStyle = object.color;
		cvx.arc(canvas.width / 2.5,canvas.height / 2.5, canvas.width / 2.5, sAngle, eAngle, false);
		cvx.fill(); 
		cvx.save();

		sAngle = eAngle;

		cvx.beginPath();
		cvx.fillRect(canvas.width - 65, -8 + (12 * cont), 10, 10);
		cvx.fillStyle = "black";
		cvx.font = "10px Arial";
		cvx.fillText(object.name, canvas.width - 50, 0 + (12 * cont));
		cvx.restore();

		cont++;
	});

	cvx.beginPath();
	cvx.fillStyle = "black";
	cvx.font = "10px Arial";
	cvx.fillText(canvas.dataset.title, 0, canvas.height - 20);
}

function graphicBar(canvas){

	let cvx = canvas.getContext('2d');
	
	let cWidth = canvas.width;
	let cHeight = canvas.height;
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

		cvx.fillStyle = canvas.dataset.color;
		cvx.fillRect(possAct, (cHeight - 15)- height, cut, height);

		cvx.fillStyle = "black";
		cvx.font = "10px Arial";
		cvx.fillText(object.name.substring(0,6), possAct , cHeight - 5);

		cvx.fillStyle = canvas.dataset.valcol;
		cvx.font = "10px Arial";
		cvx.fillText(object.value, possAct , cHeight - height);

		possAct = possAct + cut + sep;
	});
}