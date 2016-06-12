<?php

/**
 * Class BladeOneHtml
 * Copyright (c) 2016 Jorge Patricio Castro Castillo MIT License. Don't delete this comment, its part of the license.
 * Extends the tags of the class BladeOne.  Its optional
 * It adds the next tags
 * <code>
 * select:
 * @ selectonemenu('idCountry'[,$extra])
 * @ selectitem('0','--select a country'[,$extra])
 * @ selectitems($countries,'id','name',$currentCountry[,$extra])
 * @ endselectonemenu()
 * input:
 * @ input('iduser',$currentUser,'text'[,$extra])
 * button:
 * @ commandbutton('idbutton','value','text'[,$extra])
 *
 * </code>
 * Note. The names of the tags are based in Java Server Faces (JSF)
 * @package  BladeOneHtml
 * @version 1.3 2016-06-12
 * @link https://github.com/EFTEC/BladeOne
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 */

namespace eftec\bladeone;

class BladeOneHtml extends BladeOne
{
    //<editor-fold desc="compile function">
    public function compileSelectOneMenu($expression) {
        return $this->phpTag."echo \$this->selectOneMenu{$expression}; ?>";
    }
    public function compileEndSelectOneMenu() {
        return $this->phpTag."echo '</select>'; ?>";
    }
    public function compileSelectItem($expression) {
        return $this->phpTag."echo \$this->selectItem{$expression}; ?>";
    }
    public function compileSelectItems($expression) {
        return $this->phpTag."echo \$this->selectItems{$expression}; ?>";
    }
    public function compileInput($expression) {
        return $this->phpTag."echo \$this->input{$expression}; ?>";
    }
    public function compileCommandButton($expression) {
        return $this->phpTag."echo \$this->commandButton{$expression}; ?>";
    }
    public function compileForm($expression) {
        return $this->phpTag."echo \$this->form{$expression}; ?>";
    }
    public function compileEndForm() {
        return $this->phpTag."echo '</form>'; ?>";
    }
    //</editor-fold>

    //<editor-fold desc="used function">
    public function selectOneMenu($name,$extra='') {
        return "<select id='".static::e($name)."' name='".static::e($name)."' {$this->convertArg($extra)}>\n";
    }
    public function selectItem($id,$text,$extra='') {
        return "<option value='{$id}' {$this->convertArg($extra)}>{$text}</option>";
    }

    /**
     * @param $array [] Array of objects or other array
     * @param $id string Field of the id
     * @param $text string Field of the value visible
     * @param string $selectedItem Item selected (optional)
     * @param string $extra (optional) is used for add additional information for the html object (such as class)
     * @version 1.0
     * @return string
     */
    public function selectItems($array,$id,$text,$selectedItem='',$extra='') {
        if (count($array)==0) {
            return "";
        }
        $t=is_object($array[0]);
        $result='';
        if ($t) {
            foreach($array as $v) {
                $selected=($v->{$id}==$selectedItem)?'selected':'';
                $result.="<option value='".static::e($v->{$id})."' $selected {$this->convertArg($extra)}>".static::e($v->{$text})."</option>\n";
            }
        } else {
            foreach($array as $v) {
                $selected=($v[$id]==$selectedItem)?'selected':'';
                $result.="<option value='".static::e($v[$id])."' $selected {$this->convertArg($extra)}>".static::e($v[$text])."</option>\n";
            }
        }
        return $result;
    }

    public function input($id,$value='',$type='text',$extra='')
    {
        return "<input id='".static::e($id)."' name='".static::e($id)."' type='".$type."' ".$this->convertArg($extra)." value='".static::e($value)."' />\n";
    }
    public function commandButton($id,$value='',$text='Button',$extra='')
    {
        return "<button type='submit' id='".static::e($id)."' name='".static::e($id)."' value='".static::e($value)."' {$this->convertArg($extra)}>{$text}</button>\n";
    }
    public function form($action,$method='post',$extra='') {
        return "<form $action='{$action}' method='{$method}' {$this->convertArg($extra)}>";
    }


    //</editor-fold>
}