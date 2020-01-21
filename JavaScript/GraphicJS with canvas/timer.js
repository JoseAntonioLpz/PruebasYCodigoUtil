(function(){
	function index(){
		var all = document.getElementsByTagName('canvas');

		for(let canvas of all){
			switch(canvas.className){
				case 'timer_lpz':
					timer(canvas);
					break;		
			}
		}
	}
	setInterval(index,1000);
}());

function timer(canvas){

	cvx = canvas.getContext('2d');
	
	let cWidth = canvas.width;
	let cHeight =  canvas.height; 
	let date = Date.parse(canvas.dataset.time);
	let now = Date.now();
	let diff = date - now;


	let seg = Math.floor(diff/1000);
	let min = Math.floor(seg/(60));
	seg = seg % 60;
	let horas = Math.floor(min/60);
	min = min % 60;
	let dias = Math.floor(horas/24);
	horas = horas % 24;

	seg = (seg.toString().length >= 2) ? seg : '0' + seg.toString();
	min = (min.toString().length >= 2) ? min : '0' + min.toString();
	horas = (horas.toString().length >= 2) ? horas : '0' + horas.toString();

	cvx.clearRect(0, 0, cWidth, cHeight);

	/*cvx.beginPath();
	cvx.rect(0,0,cWidth,cHeight);
	cvx.stroke();*/

	cvx.beginPath();
	cvx.font = '10px Arial';
	cvx.textBaseline = 'middle';
	cvx.textAlign = 'center';
	cvx.fillText(dias + ' dias ' + horas + ':' + min + ':' + seg, cWidth / 2 , cHeight / 2);
}
