<?php

  // is_blank('abcd')
  function is_blank($value) {
    // TODO
	return ($value == '' || $value == NULL);
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
	$length = strlen($value);
	if ($length >= $options[0] && $length <= $options[1]) {
		return true;
	}
	return false;
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
    if (strpos($value, '@')) {
		return true;
	} 
	return false;
  }

?>
