<?php 
class Kriteria 
	{
		private $IR=array(0,0,	0.58,	0.9,	1.12,	1.24,	1.32,	1.41,	1.45,	1.49);

		function __construct(array $cons)
		{
			$this->name=$cons['name'];
			$this->length=sizeof($cons['values']);
			if (sizeof($cons['values'])==$this->length) {
				$this->values=$cons['values'];
			}
			if (isset($cons['child'])) {
				$this->child=$cons['child'];
			}
		}

		public function setValues(array $value)
		{
			if (sizeof($value)==$this->length) {
				$this->values=$value;
			}
		}

		public function setChild(array $cons)
		{
			foreach ($cons as $key => $value) {
				$this->child[$key]=$value;
			}
		}

		public function getChild()
		{
			return $this->child;
		}

		public function getBobot()
		{
			return array($this->name,$this->values);
		}

		public function getNormalized()
		{
			$sum=array();
			foreach ($this->values as $key => $value) {
				for ($j=0; $j < $this->length; $j++) { 
					if (!isset($sum[$j])) {
						$sum[$j]=$this->values[$key][$j];
					}else{
						$sum[$j]+= $this->values[$key][$j];
					}
				}
			}
			
			foreach ($this->values as $key => $value) { 
				for ($j=0; $j < $this->length; $j++) { 
					$normal[$key][$j]=$this->values[$key][$j]/$sum[$j];
				}
			}
			
			return $normal;
		}

		public function getPV($normalized=null)
		{
			$normalized=(is_null($normalized)) ? $this->getNormalized() : $normalized ;
			$sum=array();
			foreach ($this->values as $key => $value) { 
				for ($j=0; $j < $this->length; $j++) { 
					if (!isset($sum[$key])) {
						$sum[$key]=$normalized[$key][$j];
					}else{
						$sum[$key]+= $normalized[$key][$j];
					}
				}
			}
			$total=array_sum($sum);
			foreach ($sum as $key => $value) {
				$sum[$key]=$value/$total;
			}
			foreach ($sum as $key => $value) {
				$sum1[$this->name[$key]]=$value;
			}
			return $sum1;
		}

		public function MatrixMpy($value=null,$PV=null)
		{
			$value=(is_null($value)) ? $this->values : $value ;
			$PV=(is_null($PV)) ? $this->getPV() : $PV ;
			$hkm=array();
			
			$key=array_keys($PV);
			
			for ($i=0; $i < $this->length; $i++) { 
				for ($j=0; $j < $this->length; $j++) { 
					if (!isset($hkm[$i])) {
						$hkm[$i]=($value[$i][$j]*$PV[$key[$j]]);
					}else{
						$hkm[$i]+=($value[$i][$j]*$PV[$key[$j]]);
					}
				}
			}
			
			foreach ($hkm as $i => $value) {
				$x[$key[$i]]=$value/$PV[$key[$i]];
			}
			return $x;
		}

		public function getLambda($hkm=null)
		{
			$hkm=(is_null($hkm)) ? $this->MatrixMpy() : $hkm ;
			return array_sum($hkm)/sizeof($hkm);
		}

		public function getCI($lambda=null)
		{
			$lambda=(is_null($lambda)) ? $this->getLambda() : $lambda ;
			return ($lambda-$this->length)/($this->length-1);
		}

		public function getCR($CI=null)
		{
			$CI=(is_null($CI)) ? $this->getCI() : $CI ;
			$CR=$CI/$this->IR[$this->length-1];
			$status = ($CR<0.1) ? "Konsisten" : "Tidak Konsisten" ;
			return array("value"=>$CR,"status"=>$status);
		}

		public function getClass()
		{
			foreach ($this->name as $key => $value) {
				$pv[$value]=$this->getPV()[$key];
			}
			return array("Kriteria"=>$this->name,"bobot"=>$this->values,"normal"=>$this->getNormalized(),"PV"=>$pv,"CR"=>$this->getCR());
		}

		public function jsonClass()
		{
			return json_encode($this->getClass());
		}

		
	}
 ?>