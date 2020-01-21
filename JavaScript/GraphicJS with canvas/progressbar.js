(function(){

	var all = document.getElementsByTagName('canvas');

	for(let canvas of all){
		switch(canvas.className){
			case 'progress_bar_lpz':
				progressBar(canvas);
				break;

			case 'progress_circle_lpz':
				progressCircle(canvas);
				break;	
		}
	}

}());

function progressCircle(canvas){

	let cvx = canvas.getContext('2d');
	let cHeight = canvas.height;
	let cWidth = canvas.width;
	let text = canvas.dataset.text;
	let percent = canvas.dataset.percent;
	let color = canvas. dataset.color;
	let font = canvas.dataset.font;
	let bulk = canvas.dataset.bulk;
	let mostrate = canvas.dataset.mostrate;

	cvx.beginPath();
	cvx.lineWidth = bulk;
	cvx.strokeStyle = color;
	cvx.arc(cWidth / 2, ((cHeight + parseInt(bulk)) - 10) / 2,(cWidth - 15)/ 2, 0, ((percent * 2) / 100) * Math.PI, false);
	cvx.stroke();

	switch(mostrate){
		case '0':
			text += " " + percent + "%";
			break;
		case '1':
			text = percent + "%";
			break;
		case '2':
			break;
		case '3':
			text = "";
			break;	
		default:
			text += " " + percent + "%";
			console.error('data-mostrate is incorrect. The default value is 0. The value must be 0, 1, 2, 3');
			break; 
	}

	cvx.beginPath();
	cvx.font = font;
	cvx.textAlign = 'center';
	cvx.textBaseline = 'middle';
	cvx.fillText(text, cWidth / 2, cHeight / 2);
}

function progressBar(canvas){

	let cvx = canvas.getContext('2d');
	let cHeight = canvas.height;
	let cWidth = canvas.width;
	let text = canvas.dataset.text;
	let percent = canvas.dataset.percent;
	let color = canvas. dataset.color;
	let ctext = canvas.dataset.ctext;
	let cpercent = canvas.dataset.cpercent;
	let font = canvas.dataset.font;

	cvx.moveTo(0,0);

	cvx.beginPath();
	cvx.rect(0,0,cWidth,cHeight);
	cvx.stroke();

	cvx.beginPath();
	cvx.fillStyle = color;
	cvx.fillRect(0,0, cWidth * (percent / 100), cHeight);

	cvx.beginPath();
	cvx.font = font;
	cvx.fillStyle = ctext;
	cvx.fillText(text, 10, (cHeight + 10) / 2);

	cvx.beginPath();
	cvx.font = font;
	cvx.fillStyle = cpercent;
	cvx.fillText(percent + '%', cWidth - 30, (cHeight + 10) / 2);
}