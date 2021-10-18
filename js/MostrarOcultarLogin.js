
function Administracion(){
		var contenedor = document.getElementById("Login1");
		contenedor.style.display = "block";	
		document.getElementById("Login2").style.display = "none";	
		return true;	
}

function Empleados(){
		var contenedor = document.getElementById("Login2");
		contenedor.style.display = "block";	
		document.getElementById("Login1").style.display = "none";		
		return true;	
}

