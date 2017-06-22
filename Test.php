<?php

	//read the text from textbox and split the text into words 
	$text = $_POST["ta1"];	
	
	$word_array = preg_split("/[\s,-?.!']+/",$text);
	
	//@Test: To verify the array contains the text required
	//print_r($word_array);
 
	//calculate the number of words by finding unique words in array
	
		//further processing for ensuring that all special characters are removed
		//first, loop through all the item in the first array
	
	$cleanse_array = array();
	foreach($word_array as $key){
		//use regular expression to replace the word 
		$cleanse_word = preg_replace('/[().?!-]/','',$key); 
		//then add in all the item that have been stripped of special characters into a new array (cleanse_array)
		array_push($cleanse_array, $cleanse_word);
	}
	//@Test: Ensure that each item in array has removed all special characters
	//print_r($cleanse_array);	
			
	//do loop to calculate the number of occurence in each word appear in array
		//first need to sort out unique keyword and populate the unique keyword array
	$unique_keyword = array();
	foreach($cleanse_array as $key){
		//need to ensure that the item retrieved from array has a word or character
		if(strlen($key) >0){

			//verify from unique_keyword array if there is any similar keyword
			//create a new array item if the keyword does not exist in unique_keyword array 
			//else increase the counter by one to show that the word has number of occurence			
			if(!array_key_exists($key, $unique_keyword)){
				$unique_keyword[$key] = 0;	
			}else{
				$unique_keyword[$key] += 1;
			}				
			
		}		
		
	}
		
	//print_r($unique_keyword);
	
	
	//display the text in result for top 10 words used in the text
	
	//first remove all words that have 0 reoccurence
	foreach($unique_keyword as $key => $value){
		if($value == 0){
			unset($unique_keyword[$key]);
		}	
	}	
	
	//@Test: Verify if the unique_keyword array has been properly removed of zeroes
	//print_r($unique_keyword);	

	//sort the array according to highest value to lowest value
    arsort($unique_keyword);


    echo "Top 10 most-used words <br />";
    $counter = 0;
    foreach($unique_keyword as $key => $value){
        echo "'$key' "."has occur $value time/s <br/>";

        $counter = $counter + 1;
        if($counter == 10){
            break;
        }
    }

?>