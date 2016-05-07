<?php

/**
 * 
 * @author Steven
 * @version 1.0.1
 *
 */
/*
 * Example:
 */
// try {
//     $jsonAlert->append_batch(array(
//         'model'=>$customer,
//         'check_empty'=>array(
//         ),
//         'check_numeric'=>array(
//         ),
//         'check_differ'=>array(
//             'field1|field2'
//         ),
//         'check_size'=>array(
//         ),
//         'check_email'=>array(
//         ),
//         'check_one_not_empty'=>array(
//              'field1|field2|fieldN...'
//         ),
/**
 *  check_empty_on_other
 *  field 1 value: If this value matched then check whether field 2 is empty
 */
//         'check_empty_on_other'=>array(
//              'field1=field1 value|field2'
//         ),
//         'is_error'=>TRUE // TRUE by default
//     ));
// } catch(Exception $e) {
//     echo 'Message: ' .$e->getMessage();
// }

class JSONAlert {

    private $alertMap = '';
    private $mapContent = array();
    private $hasErrors = false;
    private $model = NULL;
    
    function __construct() {}
    
    function append($msgArr, $hasErrors=false)
    {
        $this->mapContent = array_merge($this->mapContent, $msgArr);
        $this->hasErrors = $hasErrors;
    }
    
    function append_batch($batch)
    {
        $arr_keys = array(
            'model',
            'check_empty', 'check_numeric', 'check_negative', 'check_differ', 'check_size', 'check_email', 'check_one_not_empty',
            'check_empty_on_other',
            'is_error'
        );
        foreach ($arr_keys as $arr_key)
        {
            if(!array_key_exists($arr_key, $batch))
            {
                if($arr_key=='is_error'){
                    $batch[$arr_key] = TRUE;
                } else {
                    $batch[$arr_key] = NULL;
                }
            }
        }
        $model = $batch['model'];
        $check_empty = $batch['check_empty'];
        $check_numeric = $batch['check_numeric'];
        $check_negative = $batch['check_negative'];
        $check_differ = $batch['check_differ'];
        $check_size = $batch['check_size'];
        $check_email = $batch['check_email'];
        $check_one_not_empty = $batch['check_one_not_empty'];
        $check_empty_on_other = $batch['check_empty_on_other'];
        $is_error = $batch['is_error'];
        
        if($model==NULL)
        {
            throw new Exception("Must specify an object to model key");
        }
        $error_keys = array();
        if($check_empty!=NULL)
        {
            foreach ($check_empty as $key=>$val)
            {
                if($model->$key=='' || $model->$key==NULL)
                {
                    $this->append(array(
                        $key=>$val
                    ), $is_error);
                    array_push($error_keys, $key);
                }
            }
        }
        if($check_numeric!=NULL)
        {
            foreach ($check_numeric as $key=>$val)
            {
                if(in_array($key, $error_keys))
                {
                    continue;
                }
                if(($model->$key!='' || $model->$key!=NULL) && !is_numeric($model->$key))
                {
                    $this->append(array(
                        $key=>$val
                    ), $is_error);
                    array_push($error_keys, $key);
                }
            }
        }
        if($check_negative!=NULL)
        {
            foreach ($check_negative as $key=>$val)
            {
                if(in_array($key, $error_keys))
                {
                    continue;
                }
                
                if(($model->$key!='' || $model->$key!=NULL) && $model->$key <= 0)
                {
                    $this->append(array(
                        $key=>$val
                    ), $is_error);
                    array_push($error_keys, $key);
                }
            }
        }
        if($check_differ!=NULL)
        {
            foreach ($check_differ as $key=>$val)
            {
                $key_arrs = explode('|', $key);
                $previous_key=null;
                $has_differ = false;
                foreach ($key_arrs as $key_arr)
                {
                    if(in_array($key_arr, $error_keys))
                    {
                        continue;
                    }
                    if($previous_key==NULL)
                    {
                        $previous_key = $key_arr;
                    }
                    elseif($model->$previous_key!=$model->$key_arr)
                    {
                        $previous_key=$key_arr;
                        $has_differ = TRUE;
                        array_push($error_keys, $key_arr);
                    }
                    else
                    {
                        $previous_key=$key_arr;
                    }
                }
                if($has_differ)
                {
                    $this->append(array(
                        $previous_key=>$val
                    ), $is_error);
                }
            }
        }
        if($check_size!=NULL)
        {
            foreach ($check_size as $key=>$val)
            {
                if(in_array($key, $error_keys))
                {
                    continue;
                }
                if($key!='size' && mb_strlen($model->$key)>$check_size['size']) {
                    $this->append(array(
                        $key=>$val
                    ), $is_error);
                    array_push($error_keys, $key);
                }
            }
        }
        if($check_email!=NULL)
        {
            foreach ($check_email as $key=>$val)
            {
                if(in_array($key, $error_keys))
                {
                    continue;
                }
                if(!filter_var($model->$key, FILTER_VALIDATE_EMAIL)) {
                    $this->append(array(
                        $key=>$val
                    ), $is_error);
                    array_push($error_keys, $key);
                }
            }
        }
        if($check_one_not_empty!=NULL)
        {
            foreach ($check_one_not_empty as $key=>$val)
            {
                $key_arrs = explode('|', $key);
                $is_all_empty = true;
                foreach ($key_arrs as $key_arr)
                {
                    if($model->$key_arr!='' && $model->$key_arr!=NULL)
                    {
                        $is_all_empty = false;
                    }
                    if(in_array($key_arr, $error_keys))
                    {
                        continue;
                    }
                }
                if($is_all_empty)
                {
                    $this->append(array(
                        'errorMsg'=>$val
                    ), $is_error);
                }
            }
        }
        if($check_empty_on_other!=NULL)
        {
            foreach ($check_empty_on_other as $key=>$val)
            {
                $key_arrs = explode('|', $key);
                $field1 = explode('=', $key_arrs[0]);
                if($model->$field1[0] === $field1[1])
                {
                    if($model->$key_arrs[1]=='' || $model->$key_arrs[1]==NULL)
                    {
                        $this->append(array(
                            $key_arrs[1]=>$val
                        ), $is_error);
                        array_push($error_keys, $key_arrs[1]);
                    }
                }
            }
        }
    }
    
    function result()
    {
        $this->alertMap = $this->hasErrors ? 'errorMap' : 'successMap';
        $result_arr = array(
            'model'=>$this->model,
            $this->alertMap=>$this->mapContent,
            'hasErrors'=>$this->hasErrors
        );
        return json_encode($result_arr);
    }

    function __get($property_name)
    {
        if (isset($this->$property_name))
        {
            return ($this->$property_name);
        }
        else
        {
            return NULL;
        }
    }
    
    function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }
    
}