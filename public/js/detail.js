const unitPrice = document.querySelector('#price');
const less = document.querySelector("#less");
const num = document.querySelector("#num");
const more = document.querySelector("#more");
const unit = document.querySelector("#product-unit");

let i = 1;
let price = parseInt(unitPrice.innerHTML);

less.addEventListener("click", ()=>{
	if( i > 1) {
		i--;
		i = ( i < 10) ? "0" + i : i;
		num.innerText = i;
		unitPrice.innerText = price * i;
		unit.value = Number(i);
	}
});

more.addEventListener("click", ()=>{
	i++;
	i = ( i < 10) ? "0" + i : i;
	num.innerText = i;
	unitPrice.innerText = price * i;
    unit.value = Number(i);
});