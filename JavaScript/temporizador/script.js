(function(){
    var hora = document.getElementById('hora');
    var minutos = document.getElementById('minuto');
    var segundos = document.getElementById('segundos');
    var parar = false;
    var ultimoMinuto = true;
    
    function cuentaAtras(){
        var valorSegundos = parseInt(segundos.textContent);
        var valorMinutos = parseInt(minutos.textContent);
        var valorHora = parseInt(hora.textContent);
        var menosHora = false;
        var menosMinutos = false;
        
        if(valorSegundos !== 0){
            valorSegundos--;
            segundos.innerText = valorSegundos;
        }else if(valorHora !== 0 || valorMinutos !== 0){
            valorSegundos = 59;
            segundos.innerText = valorSegundos;
            menosMinutos = true;
        }
        
        if(valorSegundos === 0){
            if(valorMinutos !== 0){
                valorMinutos--;
                minutos.innerText = valorMinutos;
            }else if(valorHora !== 0){
                valorMinutos = 59;
                minutos.innerText = valorMinutos;
                menosHora = true;
            }
            if(menosHora === true){
                if(valorHora !== 0){
                    valorHora--;
                    hora.innerText = valorHora;
                }   
            }
        }
        
        if((valorHora === 0 && valorMinutos === 0) && ultimoMinuto === true){
            valorSegundos = 59;
            segundos.innerText = valorSegundos;
            ultimoMinuto = false;
        }
        
        if(valorHora === 0 && valorMinutos === 0 && valorSegundos === 0){
            alert('Time out!');
            parar = true;
            clearInterval(intervalo);
        }
    }
    
    var intervalo = setInterval(cuentaAtras, 1000);
}())