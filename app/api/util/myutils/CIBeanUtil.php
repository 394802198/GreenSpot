<?php

/**
 * 
 * @author Steven
 *
 */
class CIBeanUtil {

    private $This;
    private $config;
    private $input;
    private $super_fields = array('This','config','input','super_fields');
    
    function __construct($input, $This, $config=NULL) {
        
        $this->input = $input;
        $this->This = $This;
	    $this->config = $config;
	    
        $configParams = array(
            'auto_increment','irrelevant_fields',
            'kindeditor_content','editor_pics','int_fields','float_fields','bool_fields'
        );
        
	    foreach ($configParams as $configParam) {
	        if(!array_key_exists($configParam, $this->config)){
	            $this->config[$configParam]=NULL;
	        }
	    }
	    
	    if($this->input!=NULL){
	    
	       $this->getPostData();
	        
	    }
	    
    }
    
    /**
     * Get Data 4 AJAX Callback
     * @return multitype:
     */
    function getAllData(){
        
        $objArr = array();
        foreach($this->This as $key => $val) {
            if(!in_array($key, $this->super_fields)){
                $objArr = array_merge($objArr, array($key=>$val));
            }
        }
        return $objArr;
        
    }
    
    /**
     * Get Not Null Data 4 Merge
     * @return multitype:
     */
    function getAllNotNullData(){
        
        $objArr = array();
        foreach($this->This as $key => $val) {
            if(($val!=NULL || $val===0) &&!in_array($key, $this->super_fields)){
                $objArr = array_merge($objArr, array($key=>$val));
            }
        }
        return $objArr;
        
    }
    
    /**
     * Get Data 4 Insert
     * @return multitype:
     */
    function getInsertableData(){
        
        $objArr = array();
        foreach($this->This as $key => $val) {
            if(($val!=NULL || $val===0) && !in_array($key, $this->super_fields)
            && ($this->config['irrelevant_fields']==NULL || !in_array($key, $this->config['irrelevant_fields']))){
                $objArr = array_merge($objArr, array($key=>$val));
            }
        }
        return $objArr;
        
    }
    
    /**
     * Get Data 4 Edit
     * @return multitype:
     */
    function getEditableData(){
        
        $objArr = array();
        foreach($this as $key => $val) {
            if(($val!=NULL || $val===0) && !in_array($key, $this->config['auto_increment'])
            && !in_array($key, $this->super_fields)
            && ($this->config['irrelevant_fields']==NULL || !in_array($key, $this->config['irrelevant_fields']))){
                $objArr = array_merge($objArr, array($key=>$val));
            }
        }
        return $objArr;
        
    }
    
    /**
     * Get Initial Data
     * @return multitype:
     */
    function getPostData()
    {
        $objArr = array();
        foreach($this->This as $key => $value)
        {
            $val = $this->input->post($key);
            // If is array or (not empty or not undefined) 
            if($this->config['kindeditor_content']!=NULL && in_array($key, $this->config['kindeditor_content']))
            {
                $val = $this->input->post($key);
                if($val=='') $val = ' ';
                
                // Get all img tag
                $imgCount = preg_match_all('/<img\s.*?>/', rawurldecode('"'.$val.'"'), $match);
                $list = array();
                for($i=0; $i<$imgCount; $i++)
                {	// Get all attr
                    $c2 = preg_match_all('/(\w+)\s*=\s*(?:(?:(["\'])(.*?)(?=\2))|([^\/\s]*))/', $match[0][$i], $match2);
                    for($j=0; $j<$c2; $j++)
                    {	// Reconstruct matched result
                        $list[$i][$match2[1][$j]] = !empty($match2[4][$j]) ? $match2[4][$j] : $match2[3][$j];
                    }
                }
                // Combine all src path
                $editor_pics = '';
                $listCount = count($list);
                for ($i=0; $i<$listCount; $i++)
                {
                    $editor_pics .= $list[$i]['src'];
                    if($i<$listCount - 1)
                    {
                        $editor_pics .= ',';
                    }
                }
                $editor_pics_filed = $this->config['editor_pics'][0];
                if($editor_pics=='') $editor_pics = ' ';
                $this->This->$editor_pics_filed = $editor_pics;
        
            }
            if($val==='0' || is_array($val) || (trim($val) && trim($val)!='undefined') || ($this->config['kindeditor_content']!=NULL && in_array($key, $this->config['kindeditor_content'])))
            {
                if($this->config['int_fields']!=NULL && in_array($key, $this->config['int_fields']))
                {
                    $val = is_numeric($val) ? (int)$val : $val;
                }
                else if($this->config['float_fields']!=NULL && in_array($key, $this->config['float_fields']))
                {
                    $val = is_numeric($val) ? (float)$val : $val;
                }
                else if($this->config['bool_fields']!=NULL && in_array($key, $this->config['bool_fields']))
                {
                    if($val=='true')
                    {
                        $val = true;
                    }
                    else
                    {
                        $val = false;
                    }
                } else if($this->config['editor_pics']!=NULL && in_array($key, $this->config['editor_pics']))
                {
                    if(trim($this->This->$key)=='')
                    {
                        continue;
                    }
                    $val = $this->This->$key;  // Prevent $val rewrite
                }
                $this->This->$key = isset($this->This->$key) ? $this->This->$key : $val;
                $value = $val;
                $objArr = array_merge($objArr, array($key=>$value));
//                 print "$key => ".gettype($value).": $value\n";
            }
        }
        return $objArr;
        
    }
    
    /**
     * e.g.: 'file_path'
     * @param string $file
     */
    function delete_file($file){
        
        if(file_exists($file)){
            unlink($file);
        }
        
    }
    
    /**
     * e.g.: 'file_path1,file_path2,file_path3'
     * @param string $editor_pics
     */
    function delete_editor_pics($editor_pics, $current_editor_pics){

        $editor_pics_arr = explode(",",$editor_pics);
        foreach ($editor_pics_arr as $editor_pics) {
            // Delete editor pics, release some spaces
            $editor_pics = substr($editor_pics, 1);
            if(file_exists($editor_pics) && !strpos($current_editor_pics, $editor_pics)){
                unlink($editor_pics);
            }
        }
        
    }
    
    function __get($property_name) {
        if (isset($this->$property_name)) {
            return ($this->$property_name);
        } else {
            return NULL;
        }
    }

    function __set($property_name, $value) {
        $this->$property_name = $value;
    }
    
}