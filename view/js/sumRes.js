function incrementCounter(index){
    let cont = document.getElementsByClassName('contador');
    let maxIndex = cont[index].getAttribute('max');
    let contText = cont[index].innerText;
    let contInt = parseInt(contText);
    let newValue = contInt + 1;
    if (newValue <= maxIndex) {
        cont[index].innerText = newValue;
    }

}

function decrementCounter(index){
    let cont = document.getElementsByClassName('contador');
    let contText = cont[index].innerText;
    let contInt = parseInt(contText);
    let newValue = contInt - 1;
    if (newValue >= 1) {
        cont[index].innerText = newValue;
    }
}

function incrementCounterCart(){
    
}