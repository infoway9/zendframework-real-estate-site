<?php


class Form_Adminform extends Zend_Form
{
public function init()
{
// initialize form
$this->setAction('')
->setMethod('post');
// create text input for name
$name = new Zend_Form_Element_Text('name');
$name->setLabel('Item name:')
->setOptions(array('size' => '35'))
->setRequired(true)
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');
// create text input for quantity
$qty = new Zend_Form_Element_Text('qty');
$qty->setLabel('Item quantity:');
$qty->setOptions(array('size' => '4'))
->setRequired(true)
->addValidator('NotEmpty', true)
->addValidator('Int', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');
// create submit button
$submit = new Zend_Form_Element_Submit('submit');
$submit->setLabel('Submit')
->setOptions(array('class' => 'submit'));
// attach elements to form
$this->addElement($name)
->addElement($qty)
->addElement($submit);
}
}

?>