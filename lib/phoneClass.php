<?php 
	/**
	* 
	*/include_once '../lib/fonoApi/fonoApi.php';
	class phoneClass 
	{
		
		function __construct(stdClass $device)
		{
			
			$this->DeviceName=(!empty($device->DeviceName)) ? $device->DeviceName : "Unknown";
			$this->Brand=(!empty($device->Brand)) ? $device->Brand : "Unknown";
			$this->announced=(!empty($device->announced)) ? $device->announced : "Unknown";
			$this->status=(!empty($device->status)) ? $device->status : "Unknown";
			$this->dimensions=(!empty($device->dimensions)) ? $device->dimensions : "Unknown";
			$this->weight=(!empty($device->weight)) ? $device->weight : "Unknown";
			$this->type=(!empty($device->type)) ? $device->type : "Unknown";
			$this->size=(!empty($device->size)) ? $device->size : "Unknown";
			$this->resolution=(!empty($device->resolution)) ? $device->resolution : "Unknown";
			$this->wlan=(!empty($device->wlan)) ? $device->wlan : "Unknown";
			$this->bluetooth=(!empty($device->bluetooth)) ? $device->bluetooth : "Unknown";
			$this->usb=(!empty($device->usb)) ? $device->usb : "Unknown";
			$this->features_c=(!empty($device->features_c)) ? $device->features_c : "Unknown";
			$this->battery_c=(!empty($device->battery_c)) ? $device->battery_c : "Unknown";
			$this->stand_by=(!empty($device->stand_by)) ? $device->stand_by : "Unknown";
			$this->talk_time=(!empty($device->talk_time)) ? $device->talk_time : "Unknown";
			$this->colors=(!empty($device->colors)) ? $device->colors : "Unknown";
			$this->cpu=(!empty($device->cpu)) ? $device->cpu : "Unknown";
			$this->internal=(!empty($device->internal)) ? $device->internal : "Unknown";
			$this->os=(!empty($device->os)) ? $device->os : "Unknown";
			$this->primary_=(!empty($device->primary_)) ? $device->primary_ : "Unknown";
			$this->video=(!empty($device->video)) ? $device->video : "Unknown";
			$this->secondary=(!empty($device->secondary)) ? $device->secondary : "Unknown";
			$this->speed=(!empty($device->speed)) ? $device->speed : "Unknown";
			$this->chipset=(!empty($device->chipset)) ? $device->chipset : "Unknown";
			$this->features=(!empty($device->features)) ? $device->features : "Unknown";
			$this->gpu=(!empty($device->gpu)) ? $device->gpu : "Unknown";
			//$this->performance=$device->performance;
			
			$this->specs=array('Info'=> array("Announced"=>$this->announced,"Status"=>$this->status,"Dimension"=>$this->dimensions,"Weight"=>$this->weight,"Colors"=>$this->colors,"OS"=>$this->os),'Display'=> array("Type"=>$this->type,"Size"=>$this->size,"Resolution"=>$this->resolution),'Connectivity'=> array("Wlan"=>$this->wlan,"Bluetooth"=>$this->bluetooth,"USB"=>$this->usb,"Speed"=>$this->speed,"Extra"=>$this->features_c),'Battery'=> array("Battery Size"=>$this->battery_c,"Stand By"=>$this->stand_by,"Talk Time"=>$this->talk_time),'Internals'=> array("CPU"=>$this->cpu,"Memory"=>$this->internal,"GPU"=>$this->gpu,"Chipset"=>$this->chipset),'Camera'=> array("Primary"=>$this->primary_,"Video"=>$this->video,"Secondary"=>$this->secondary,"Extra"=>$this->features));
		}
	}

 ?>