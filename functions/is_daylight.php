<?php
/* 	values are offset in hhmm (not seconds!) relative to GMT
	case The first value is for standard, and the second value is for daylight
*/
function is_daylight($time, $timezone){
	global $tz_array, $summary;
	# default to std time, overwrite if daylight.
	$dlst = 0;
	# Subtract the offset for std time.  This will be slightly off in some cases, but will be closer than using nothing (?).
	$time = $time - calcOffset($tz_array[$timezone][0]);
	$year = date("Y", $time);
	$month = date("m",$time);
	$day = date("d",$time);
	$hour = date("H",$time);
	
	if(isset($tz_array[$timezone]['dt_start'][$year]) && isset($tz_array[$timezone]['st_start'][$year])){
		$start	= $tz_array[$timezone]['dt_start'][$year];
		$end 	= $tz_array[$timezone]['st_start'][$year];	
	}else{
		switch ($timezone){
			case 'US/Samoa':                     # array('-1100', '-1100');
			case 'America/Adak':                 # array('-1000', '-0900');
			case 'America/Atka':    
			case 'US/Aleutian':
			case 'America/Anchorage':      	     # array('-0900', '-0800');
			case 'America/Nome':      
			case 'US/Alaska':        
			case 'America/Juneau':   
			case 'America/Yakutat':  
			case 'America/Dawson':               # array('-0800', '-0700');
			case 'America/Los_Angeles':
			case 'America/Vancouver': 
			case 'America/Whitehorse':
			case 'Canada/Pacific':   
			case 'Canada/Yukon':     
			case 'PST8PDT':          
			case 'US/Pacific':
			case 'America/Boise': 	    		# array('-0700', '-0600');
			case 'America/Cambridge_Bay':   
			case 'America/Denver':          
			case 'America/Edmonton':        
			case 'America/Inuvik':          
			case 'America/Shiprock':        
			case 'America/Yellowknife':     
			case 'Canada/Mountain':         
			case 'MST7MDT':                 
			case 'Navajo':                  
			case 'US/Mountain':             	
			case 'America/Chicago':       		# array('-0600', '-0500');     
			case 'America/Menominee':       
			case 'America/Merida':          
			case 'America/Rainy_River':     
			case 'America/Rankin_Inlet':    
			case 'America/Winnipeg':        
			case 'Canada/Central':          
			case 'CST6CDT':                 
			case 'US/Central':              
			case 'America/Detroit':              # array('-0500', '-0400');
			case 'America/Grand_Turk':      
			case 'America/Iqaluit':         
			case 'America/Kentucky/Louisville':
			case 'America/Kentucky/Monticello':
			case 'America/Louisville':      
			case 'America/Montreal':       
			case 'America/Nassau':         
			case 'America/New_York':       
			case 'America/Nipigon':        
			case 'America/Pangnirtung':    
			case 'America/Thunder_Bay':    
			case 'Canada/Eastern':         
			case 'EST5EDT':                
			case 'US/Eastern':
			case 'US/Michigan':
			case 'America/Glace_Bay':            # array('-0400', '-0300');
			case 'America/Goose_Bay':    
			case 'America/Halifax':    
			case 'America/Thule':      
			case 'Canada/Atlantic':    
			case 'America/St_Johns':             # array('-0330', '-0230');
			case 'Canada/Newfoundland':
			case 'America/Godthab':              # array('-0300', '-0200');
			case 'America/Miquelon':   
				if ($year < 2007){
					$start 	= strtotime("+1 Sun",strtotime($year."0331"));
					$end 	= strtotime("-1 Sun",strtotime($year."1101"));
				}else{
					$start 	= strtotime("+2 Sun",strtotime($year."0300"));
					$end 	= strtotime("+1 Sun",strtotime($year."1031"));
				}
				break;
			case 'America/Havana':          
			case 'Cuba':                   
				$start 	= strtotime("+3 Sun",strtotime($year."0300"));
				$end 	= strtotime("-1 Sun",strtotime($year."1101"));	
				break;
			case 'America/Cancun':     
			case 'America/Chihuahua':       
			case 'America/Ensenada':   
			case 'America/Tijuana':   
			case 'America/Mexico_City':     
			case 'America/Monterrey':       
			case 'Atlantic/Bermuda':   
			case 'Mexico/BajaSur':          
			case 'Mexico/BajaNorte': 
			case 'Mexico/General':          
			case 'America/Mazatlan':        
				$start 	= strtotime("+1 Sun",strtotime($year."0331"));
				$end 	= strtotime("-1 Sun",strtotime($year."1101"));
				break;
			case 'Chile/EasterIsland':           # array('-0500', '-0600');
			case 'Pacific/Easter':        
		
				break;
			case 'America/Asuncion':        	 # array('-0300', '-0400');
			case 'America/Cuiaba':      
			case 'America/Santiago':    
			case 'Antarctica/Palmer':   
			case 'Atlantic/Stanley':    
			case 'Chile/Continental':   
		
				break;
			case 'America/Araguaina':       	 # array('-0200', '-0300');
			case 'America/Sao_Paulo':  
			case 'Brazil/East':        
		
				break;
			case 'America/Scoresbysund':         # array('-0100', '+0000');
			case 'Atlantic/Azores':    
		
				break;
			case 'Atlantic/Canary':              # array('+0000', '+0100');
			case 'Atlantic/Faeroe':    
			case 'Atlantic/Madeira':   
			case 'Eire':
			case 'Europe/Belfast':     
			case 'Europe/Dublin':      
			case 'Europe/Lisbon':      
			case 'Europe/London':      
			case 'GB-Eire':            
			case 'GB':                 
			case 'Portugal':           
			case 'WET':                
			case 'Africa/Ceuta': 	             # array('+0100', '+0200'); 
			case 'Arctic/Longyearbyen':
			case 'CET':                 
			case 'Europe/Amsterdam':    
			case 'Europe/Andorra':      
			case 'Europe/Belgrade':     
			case 'Europe/Berlin':       
			case 'Europe/Bratislava':   
			case 'Europe/Brussels':     
			case 'Europe/Budapest':     
			case 'Europe/Copenhagen':   
			case 'Europe/Gibraltar':    
			case 'Europe/Ljubljana':    
			case 'Europe/Luxembourg':   
			case 'Europe/Madrid':       
			case 'Europe/Malta':        
			case 'Europe/Monaco':       
			case 'Europe/Oslo':         
			case 'Europe/Paris':        
			case 'Europe/Prague':       
			case 'Europe/Rome':         
			case 'Europe/San_Marino':   
			case 'Europe/Sarajevo':     
			case 'Europe/Skopje':       
			case 'Europe/Stockholm':    
			case 'Europe/Tirane':       
			case 'Europe/Vaduz':        
			case 'Europe/Vatican':      
			case 'Europe/Vienna':       
			case 'Europe/Warsaw':       
			case 'Europe/Zagreb':         
			case 'Europe/Zurich':         
			case 'MET':                   
			case 'Poland':                
			case 'Europe/Athens':     
			case 'Europe/Bucharest':  
			case 'Europe/Chisinau':   
			case 'Europe/Helsinki':   
			case 'Europe/Istanbul':   
			case 'Europe/Kaliningrad':
			case 'Europe/Kiev':       
			case 'Europe/Minsk':      
			case 'Europe/Nicosia':    
			case 'Europe/Riga':       
			case 'Europe/Simferopol': 
			case 'Europe/Sofia':      
			case 'Europe/Tiraspol':   
			case 'Europe/Uzhgorod':   
			case 'Europe/Zaporozhye': 
			case 'EET':               
				$start 	= strtotime("-1 Sun",strtotime($year."0401"));
				$end 	= strtotime("-1 Sun",strtotime($year."1101"));	
				break;
			case 'Africa/Windhoek':       	     # array('+0200', '+0100');
		
				break;
			case 'Asia/Amman':                   # array('+0200', '+0300');
			case 'Asia/Beirut':          
			case 'Asia/Damascus':     
			case 'Asia/Gaza':         
			case 'Asia/Istanbul':        
			case 'Asia/Jerusalem':       
			case 'Asia/Nicosia':      
			case 'Asia/Tel_Aviv':     
			case 'Egypt':             
			case 'Israel':            
			case 'Turkey':            
		
				break;
			case 'Asia/Baghdad':                 # array('+0300', '+0400');
			case 'Europe/Moscow':
			case 'W-SU':                 
		
				break;
			case 'Asia/Tehran':                  # array('+0330', '+0430');
			case 'Iran':       
		
				break;
			case 'Asia/Aqtau':                   # array('+0400', '+0500');
			case 'Asia/Baku':            
			case 'Asia/Tbilisi':         
			case 'Asia/Yerevan':         
			case 'Europe/Samara':
		
				break;
			case 'Asia/Aqtobe':                  # array('+0500', '+0600');
			case 'Asia/Bishkek':         
			case 'Asia/Yekaterinburg':   
		
				break;
			case 'Asia/Almaty':                  # array('+0600', '+0700');
			case 'Asia/Novosibirsk':     
			case 'Asia/Omsk':            
		
				break;
			case 'Asia/Krasnoyarsk':             # array('+0700', '+0800');
		
				break;
			case 'Asia/Irkutsk':                 # array('+0800', '+0900');
		
				break;
			case 'Asia/Yakutsk':                 # array('+0900', '+1000');
			
			
				break;
			case 'Asia/Vladivostok':             # array('+1000', '+1100');
			case 'Australia/ACT':        
			case 'Australia/Melbourne':  
			case 'Australia/NSW':        
			case 'Australia/Sydney':     
			case 'Australia/Tasmania':   
			case 'Australia/Victoria':   
		
				break;
			case 'Australia/Adelaide':           # array('+1030', '+0930');
			case 'Australia/Broken_Hill':
			case 'Australia/South':      
			case 'Australia/Yancowinna': 
		
				break;
			case 'Asia/Magadan':                 # array('+1100', '+1200');
		
				break;
			case 'Australia/LHI':                # array('+1100', '+1030');
			case 'Australia/Lord_Howe':  
		
				break;
			case 'Australia/Canberra':           # array('+1100', '+1000');
			case 'Australia/Hobart':     
		
				break;
			case 'Asia/Anadyr':                  # array('+1200', '+1300');
			case 'Asia/Kamchatka':       
		
				break;
			case 'Antarctica/McMurdo':
			case 'Antarctica/South_Pole':
			case 'NZ':                           # array('+1300', '+1200');
			case 'Pacific/Auckland':  
				break;	
			case 'NZ-CHAT':           
			case 'Pacific/Chatham':              # array('+1345', '+1245');
				break;
			default:
				$dlst = date('I', $time);
		}
	}
	if (isset($start,$end) && $time >= $start && $time < $end) $dlst = 1;
	#echo "$summary $dlst <br>";

	return $dlst;

}
?>