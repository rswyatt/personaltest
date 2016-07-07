<?php
/* Process a spin and return results 
 *
 */ 

$db = new mysqli('localhost', 'root', 'WfZLVHEYhZ', 'slotmachineresults'); 
if($db->connect_errno){ 
    die('Could not connect: ' . $db->connect_errno()); 
}


$playerID = $_POST['playerID']; 
$bet = $_POST['bet']; 
$won = $_POST['won']; 
$hash = $_POST['hash']; 


if(is_empty($playerID)){ 
    return "No Player ID provided"; 
}
if(is_empty($bet)){ 
    return "No bet provided"; 
}
if(is_empty($hash)){ 
    return "Hash must be provided"; 
}
if(is_empty($won)){ 
    return "Must provide coins won"; 
}



function validatePlayer($playerID, $hash) { 
    
    $qry = "SELECT credits, name FROM players WHERE playerID = '".$playerID."' AND hash = '".$hash."'"; 
    if($result = $db->query($qry)){ 
        if($result->num_rows === 0){ 
            return false; 
        }
        
        return $result->fetch_assoc(); 
    }
}

function doSpin($playerID, $hash, $bet, $won){ 
    
    if($credits = validatePlayer($playerID, $hash)){
        
        $finalCredits = ($credits['credits'] - $bet) + $won; 
        
        $qry = "UPDATE players SET credits = ".$finalCredits.", lifetime_spins = lifetime_spins-1 WHERE playerID = '".$playerID."'"; 
        $db->query($qry); 
        
    } else { 
        return "Could not validate player"; 
    }
    
   
    
    $qry = "SELECT lifetime_spins FROM players WHERE playerID = '".$playerID."'"; 
    $rslt = $db->query($qry);
    $data = $rslt->fetch_assoc(); 
    $final = array('won'=>$result, 'playerID'=>$playerId, 'name'=>$credits['name'], 'lifetime_spins'=>$data['lifetime_spins']); 
    
    return $final;     
}

return json_encode(doSpin($playerID, $hash, $bet, $won)); 
?>
