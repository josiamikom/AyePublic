function updateInverse(x){
	document.getElementById(x.split("").reverse().join("")).value=(1/Number(document.getElementById(x).value)).toFixed(2);
}
function updateName(x) {
	document.getElementById(x.split("").reverse().join("")).innerHTML=document.getElementById(x).value;
}
function deleteRowCol(index) {
	if (document.getElementById("bobot").rows.length<=4) {
		alert("Minimal Kriteria adalah 3");
	} else {
		document.getElementById("bobot").deleteRow(index);
		for (var i = 0; i < document.getElementById("bobot").rows.length; i++) {
			document.getElementById("bobot").rows[i].deleteCell(index);
		}
	}
	
}
function addColumn() {
	var length=document.getElementById("bobot").rows.length;
	var a=document.getElementById("bobot").insertRow(length);
			
		for (var i = 0; i < document.getElementById("bobot").rows.length; i++) {
			var cell=a.insertCell(i);
			if (i==0) {
				cell.id=length-1+"x";
			}else{
				if (i==document.getElementById("bobot").rows.length-1) {
				cell.innerHTML='<input id="'+(length-1)+"-"+(i-1)+'" class="form-control" type="text" name="value['+(i-1)+'][]" value="1" readonly>';
				}else {
					
					cell.innerHTML='<input id="'+(length-1)+"-"+(i-1)+'" class="form-control" type="text" name="value['+(length-1)+'][]" onKeyUp="updateInverse(\''+(length-1)+"-"+(i-1)+'\')">';
				}
			}
			

		}
		for (var i = 0; i < document.getElementById("bobot").rows.length-1; i++) {
			var cell=document.getElementById("bobot").rows[i].insertCell();
			var aid="x"+(length-1);
			console.log(aid);
			if (i==0) {
				cell.innerHTML='<td><div class="col-lg-9"><input id="'+aid+'" class="form-control" type="text" name="name[]" value="" onkeyup="updateName(\''+aid+'\')"></div><div class="col-lg-1"><button onclick="deleteRowCol('+length+')" type="button" class="btn btn-danger">-</button></div></td>';
			}else{
				cell.innerHTML='<input id="'+(i-1)+'-'+(length-1)+'" class="form-control" type="text" name="value['+(i-1)+'][]" onkeyup="updateInverse(\''+(i-1)+'-'+(length-1)+'\')" >';
			}
		}
}
